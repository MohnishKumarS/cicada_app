<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
  public function submitOrder(Request $request)
  {
    // return $request->all();

    $validated = $request->validate([
      'fullname' => 'required|string|max:20',
      'email' => 'required|email',
      'address' => 'required|string|max:300',
      'city' => 'required|string|max:50',
      'pincode' => 'required|digits:6',
      'state' => 'required|string|max:50',
      'mobile' => 'required|digits:10',
      'message' => 'nullable|max:300'
    ]);

    // Retrieve cart items from the cookie
    $cart = $request->cookie('cart');
    $cartItems = $cart ? json_decode($cart, true) : [];

    $grandTotal = array_sum(array_map(function ($item) {
      return $item['product_price'] * $item['quantity'];
    }, $cartItems));

    // get user device
    $ua = strtolower($_SERVER["HTTP_USER_AGENT"]);
    if (strpos($ua, 'mobile') !== false && strpos($ua, 'ipad') !== false) {
      $ua = str_replace('mobile', '', $ua);
    }
    $isMobile = is_numeric(strpos($ua, "mobile"));
    $isDesktop = !$isMobile;
    $userDevice = $isMobile ? 'Mobile' : 'Desktop';

    if ($request->pay_method == "cod") {
      // Create a new order
      $order = Order::create([
        'user_id' => $request->user()->id,
        'order_id' => Order::generateOrderId(),
        'full_name' => $validated['fullname'],
        'email' => $validated['email'],
        'address' => $validated['address'],
        'city' => $validated['city'],
        'pincode' => $validated['pincode'],
        'state' => $validated['state'],
        'mobile' => $validated['mobile'],
        'message' => $validated['message'],
        'payment_method' => $request['pay_method'],
        'total_amount' => $grandTotal,
        'user_device' => $userDevice
      ]);

      if ($order) {
        // Save order details
        foreach ($cartItems as $item) {
          Orderdetail::create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'size' => $item['size'],
            'color' => $item['color'],
            'product_price' => $item['product_price'],
            'product_image' => $item['product_image'],
            'quantity' => $item['quantity'],
          ]);
        }
        // Clear the cart
        Cookie::queue(Cookie::forget('cart'));
        return view('payment.success')->with([
          'toast' => 'Hooray!',
          'type' => 'success',
          'text' => 'Order placed successfully!'
        ]);
      } else {
        return redirect()->route('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Failed to place order! - contact support');
      }
    } else if ($request->pay_method == "online") {
      // Store order details in session for online payment
      session([
        'order_data' => $validated,
        'cart_items' => $cartItems,
        'grand_total' => $grandTotal,
        'user_device' => $userDevice
      ]);
      return redirect()->route('phonepe.payment');
    }
  }

  public function makePhonePePayment(Request $request)
  {
    try {
      // Retrieve order details from session
      $orderData = session('order_data');
      $cartItems = session('cart_items');
      // return $orderData;
      if (!$orderData || !$cartItems) {
        return redirect('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Session expired. Please try again.');
      }

      $saltIndex = 1;
      $merchantId = "PGTESTPAYUAT101";
      $grandTotal = session('grand_total');
      $merchantTransactionId = uniqid();
      $saltKey = '4c1eba6b-c8a8-44d3-9f8b-fe6402f037f3';

      $user = Auth::user(); // Assuming Laravel authentication is used
        $merchantUserId = $user ? 'USER_' .$user->id : 'GUEST_' . uniqid(); 
        $mobileNumber = $user ? $user->mobile : '6384044807'; 

      $paymentData = array(
        'merchantId' => $merchantId,
        'merchantTransactionId' =>  $merchantTransactionId,
        'merchantUserId' => (string) $merchantUserId,
        'amount' => (int) 1 * 100,
        'redirectUrl' => route('phonepe.payment.callback'),
        'redirectMode' => 'POST',
        'callbackUrl' => route('phonepe.payment.callback'),
        'mobileNumber' => (string) $mobileNumber,
        'paymentInstrument' =>
        array(
          'type' => 'PAY_PAGE',
        ),
      );

      $payload = base64_encode(json_encode($paymentData));
      $checkSum = hash('sha256', $payload . "/pg/v1/pay" . $saltKey) . '###' . $saltIndex;


      $request = curl_init("https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay");
      curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($request, CURLOPT_POST, true);
      curl_setopt($request, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "X-VERIFY: $checkSum",
        "X-MERCHANT-ID: $merchantId"
      ]);
      curl_setopt($request, CURLOPT_POSTFIELDS, json_encode(["request" => $payload]));
      $response = curl_exec($request);
      $err = curl_error($request);
      curl_close($request);

      if ($err) {
        Log::error('cURL Error:', ['error' => $err]);
        return redirect('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'invalid response from the payment gateway');
      }

      $responseData = json_decode($response);
      if ($responseData->success) {
        return redirect()->to($responseData->data->instrumentResponse->redirectInfo->url);
      }
      return redirect('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Payment initiation failed. Please try again.');
    } catch (\Exception $th) {
      return redirect('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'An error occurred: ' . $th->getMessage());
    }
  }

  public function phonePeCallback(Request $request)
  {

    $input = $request->all();
    // return $input;
    if (!Auth::check()) {
      // Redirect to login if not authenticated
      return redirect()->route('login')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Please login again.');
    }

    if (isset($input['code']) && $input['code'] == "PAYMENT_SUCCESS") {
      try {
        $saltKey = '4c1eba6b-c8a8-44d3-9f8b-fe6402f037f3';
        $saltIndex = 1;

        $finalXHeader = hash('sha256', '/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId'] . $saltKey) . '###' . $saltIndex;

        $request = curl_init("https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/{$input['merchantId']}/{$input['transactionId']}");
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_HTTPGET, true); // Use HTTP GET method
        curl_setopt($request, CURLOPT_HTTPHEADER, [
          "Content-Type: application/json",
          "Accept: application/json",
          "X-VERIFY: $finalXHeader",
          "X-MERCHANT-ID: {$input['merchantId']}" // Ensure merchant ID is used correctly
        ]);

        $response = curl_exec($request);
        $err = curl_error($request);
        curl_close($request);

        // Handle errors
        if ($err) {
          Log::error('PhonePe API Error:', ['error' => $err]);
          return redirect()->route('checkout')->with([
            'toast' => 'Oops!',
            'type'  => 'error',
            'text'  => 'Error occurred while checking payment status.'
          ]);
        }

        // Decode and return response
        $responseData = json_decode($response, true);
        // return $responseData;
        if (!$responseData || !isset($responseData['success']) || !$responseData['success']) {
          Log::error('PhonePe Payment Status Error:', ['response' => $responseData]);
          return redirect()->route('checkout')->with([
            'toast' => 'Oops!',
            'type'  => 'error',
            'text'  => 'Payment verification failed. Please try again.'
          ]);
        }
        // ## Payment is successful
        if (isset($responseData['success']) &&  $responseData['success']) {
          // Retrieve stored order details
          $orderData = session('order_data');
          $cartItems = session('cart_items');
          $grandTotal = session('grand_total');
          $userDevice = session('user_device');

          $paymentMethod = $responseData['data']['paymentInstrument']['type'] ?? 'Unknown';
          // Store order in database
          $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => Order::generateOrderId(),
            'full_name' => $orderData['fullname'],
            'email' => $orderData['email'],
            'address' => $orderData['address'],
            'city' => $orderData['city'],
            'pincode' => $orderData['pincode'],
            'state' => $orderData['state'],
            'mobile' => $orderData['mobile'],
            'message' => $orderData['message'],
            'payment_method' => $paymentMethod,
            'payment_id' =>  $response,
            'total_amount' => $grandTotal,
            'user_device' => $userDevice
          ]);

          foreach ($cartItems as $item) {
            Orderdetail::create([
              'order_id' => $order->id,
              'product_id' => $item['product_id'],
              'size' => $item['size'],
              'color' => $item['color'],
              'product_price' => $item['product_price'],
              'product_image' => $item['product_image'],
              'quantity' => $item['quantity'],
            ]);
          }
          // **Clear session data after order is placed**
          session()->forget(['order_data', 'cart_items', 'grand_total','user_device']);

          // **Clear the cart
          Cookie::queue(Cookie::forget('cart'));

          return redirect()->route('payment.success')->with([
            'toast' => 'Hooray!',
            'type' => 'success',
            'text' => 'Order placed successfully!'
          ]);
        }
        // Fallback - Something went wrong
        Log::error('Unexpected issue in PhonePe payment handling.');
        return redirect()->route('checkout')->with([
          'toast' => 'Oops!',
          'type'  => 'error',
          'text'  => 'Something went wrong. Please contact support.'
        ]);
      } catch (\Exception $th) {
        return redirect()->route('checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'An error occurred: ' . $th->getMessage());
      }
    }
    return redirect('/checkout')->with('toast', 'Oops!')->with('type', 'error')->with('text', 'Payment failed. Please try again.');
  }

  // Refund API from api
  public function phonePeRefundAPI(Request $req)
  {
    //  return $req->input('trans_Id');  
    $tra_id = $req->trans_Id;

    $payload = [
      'merchantId' => 'PGTESTPAYUAT101',
      'merchantUserId' => 'MUID123',
      'merchantTransactionId' => ($tra_id),
      'originalTransactionId' => strrev($tra_id),
      'amount' => 1 * 100,
      'callbackUrl' => route('phonepe.payment.refund'),
    ];

    $encode = base64_encode(json_encode($payload));

    $saltKey = '4c1eba6b-c8a8-44d3-9f8b-fe6402f037f3';
    $saltIndex = 1;

    $string = $encode . '/pg/v1/refund' . $saltKey;
    $sha256 = hash('sha256', $string);

    $finalXHeader = $sha256 . '###' . $saltIndex;


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/refund',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'X-VERIFY: ' . $finalXHeader
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $rData = json_decode($response);

    // return $rData;

    $finalXHeader1 = hash('sha256', '/pg/v1/status/' . 'PGTESTPAYUAT101' . '/' . $tra_id . $saltKey) . '###' . $saltIndex;


    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/status/' . 'PGTESTPAYUAT101' . '/' . $tra_id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => false,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'accept: application/json',
        'X-VERIFY: ' . $finalXHeader1,
        'X-MERCHANT-ID: ' . $tra_id
      ),
    ));

    $responsestatus = curl_exec($curl);
    $success_data = json_decode($responsestatus);
    curl_close($curl);

    // return $success_data;
    dd(json_decode($response), $success_data, $success_data->data->transactionId);
    // dd($rData);
  }

  public function paymentSuccess()
  {
    return view('payment.success');
  }
}
