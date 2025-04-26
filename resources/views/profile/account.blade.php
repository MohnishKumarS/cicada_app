@extends('layouts.main')


@section('content')
    <section>
        <div class="ccd-profile">
            <div class="container page--width">
                <h1 class="page--head">Account</h1>
                <!-- Profile  -->
                <div class="profile__wrap">
                    <!-- accordion -->
                    <div class="profile__accordion accordion">
                        <details open>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Orders
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                               
                                @if ($orders->count() > 0)
                                
                                <div class="ccd--orders">
                                    <ul class="order__lists">
                                        @foreach ($orders as $order)
                                        @php
                                            $firstImage =  $order->orderDetails->first()->product->main_img;
                                        @endphp
                                        
                                        <li class="order__list">
                                            <a href="{{ route('view.order',$order->id) }}" class="order__list-link">
                                                <div class="order__list-pic">
                                                    <img src="{{asset('admin-files/products/'.$firstImage)}}" alt="product-image"
                                                        class="img-fluid order__list-img" width="100" height="100"
                                                        loading="lazy">
                                                </div>
                                                <div class="order__list-info">
                                                    <div class="order__list-title">
                                                        OrderID : {{$order->order_id}}
                                                    </div>
                                                    <div class="order__list-date">
                                                        Placed on {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                                                    </div>
                                                    <div class="order__list-status">
                                                        @php
                                                        $statusLabels = [
                                                            '0' => ['class' => 'text-bg-primary', 'label' => 'Pending'],
                                                            '1' => ['class' => 'text-bg-info', 'label' => 'Shipped'],
                                                            '2' => ['class' => 'text-bg-warning', 'label' => 'Out for Delivery'],
                                                            '3' => ['class' => 'text-bg-success', 'label' => 'Delivered'],
                                                            '4' => ['class' => 'text-bg-danger', 'label' => 'Canceled'],
                                                        ];
                                                    @endphp
                                                    
                                                    @if (isset($statusLabels[$order->status]))
                                                        <span class="badge {{ $statusLabels[$order->status]['class'] }}">
                                                            {{ $statusLabels[$order->status]['label'] }}
                                                        </span>
                                                    @endif
                                                       
                                                    </div>
                                                    <div class="order__list-total">
                                                        Rs. {{$order->total_amount}}
                                                    </div>
                                                </div>
                                                <div class="order__list-icon">
                                                    <i class="fa-solid fa-angle-right icon"></i>
                                                </div>
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                        
                                    </ul>
                                </div>
                                @else
                                <p>You haven't placed any orders yet.</p>
                                @endif
                              

                            </div>
                        </details>
                    </div>

                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-user-check"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Profile
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="profile__block">
                                    <div class="row justify-content-center px-3 px-sm-0">
                                        <div class="col-lg-6 col-md-10 col-12">
                                            <div>
                                                <form id="updateProfileForm">

                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="name"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->name }}" required>
                                                        <label for="name">Name</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="email"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->email }}">
                                                        <label for="email">Email address</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="mobile" maxlength="10"
                                                            placeholder="name@example.com"
                                                            value="{{ auth()->user()->mobile }}">
                                                        <label for="mobile">mobile</label>
                                                    </div>

                                                    <div class="custom-acc__btns my-4 text-center">
                                                        <button type="submit" class="btn-main">Update Profile</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </details>
                    </div>

                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-user-lock"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Change Password
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="profile__block">
                                    <div class="row justify-content-center px-3 px-sm-0">
                                        <div class="col-lg-6 col-md-10 col-12">
                                            <div>
                                                <form id="updatePasswordForm">

                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="old_pass"
                                                            placeholder="name@example.com">
                                                        <label for="old_pass">Old Password</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="new_pass"
                                                            placeholder="name@example.com">
                                                        <label for="new_pass">New Password</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="text" class="form-control" id="confirm_pass"
                                                            placeholder="name@example.com">
                                                        <label for="conform_pass">Confirm New Password</label>
                                                    </div>

                                                    <div class="custom-acc__btns my-4 text-center">
                                                        <button type="submit" class="btn-main">Update Password</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </details>
                    </div>


                    <div class="profile__accordion accordion">
                        <details>
                            <summary role="button" aria-expanded="false">
                                <div class="summary__title">
                                    <span class="icon icon-accordion">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </span>
                                    <h2 class="h4 accordion__title inline-richtext">
                                        Track Order
                                    </h2>
                                </div>
                                <svg aria-hidden="true" focusable="false" class="icon icon-caret" viewBox="0 0 10 6">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.354.646a.5.5 0 00-.708 0L5 4.293 1.354.646a.5.5 0 00-.708.708l4 4a.5.5 0 00.708 0l4-4a.5.5 0 000-.708z"
                                        fill="currentColor">
                                    </path>
                                </svg>

                            </summary>
                            <div class="accordion__content">
                                <div class="row justify-content-center px-3 px-sm-0">
                                    <div class="col-lg-6 col-md-10 col-12">
                                        <form action="{{route('order.track')}}" method="post">
                                            @csrf
                                            <div>
                                                <div class="form-floating mb-4">
                                                    <input type="text" class="form-control" id="orderId" name="orderID"
                                                        placeholder="name@example.com" required>
                                                    <label for="orderId">Order ID</label>
                                                </div>
                                                {{-- <div class="form-floating mb-4">
                                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                                        placeholder="name@example.com" >
                                                    <label for="mobile">Mobile Number</label>
                                                </div> --}}
    
                                                <div class="custom-acc__btns my-4 text-center">
                                                    <button class="btn-main" type="submit">Search Order</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>

                            </div>
                        </details>
                    </div>
                    <!-- accordion END -->
                </div>
                <!-- Profile END -->


            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // update user profile
            $('#updateProfileForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission
                let isValid = true;

                // Clear previous error messages
                $('.error-message').text('');

                // Validate name field
                const name = $('#name').val().trim();
                if (name.length < 3 || name.length > 50) {
                    $.Toast("Oops!", "Name must be between 3 and 50 characters", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate email field
                const email = $('#email').val().trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
                if (!emailRegex.test(email)) {
                    $.Toast("Oops!", "Please enter a valid email address", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate mobile field
                const mobile = $('#mobile').val().trim();
                const mobileRegex = /^\d{10}$/; // Exactly 10 digits
                if (!mobileRegex.test(mobile)) {
                    $.Toast("Oops!", "Please enter a valid 10-digit mobile number", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // If all fields are valid, submit the form or proceed with AJAX
                if (isValid) {

                    $.ajax({
                        url: '/update-profile',
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                            name: name,
                            email: email,
                            mobile: mobile,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $.Toast("Hooray!", "Profile updated successfully", "success", {
                                    timeout: 6000,
                                    has_progress: true,
                                });
                                // Optionally update the form dynamically
                                $('#name').val(response.data.name);
                                $('#email').val(response.data.email);
                                $('#mobile').val(response.data.mobile);
                            }
                        },
                        error: function(xhr) {
                            // alert('Error: ' + xhr.responseJSON.message);
                            $.Toast("Oops!", 'something went wrong!', "error", {
                                timeout: 6000,
                                has_progress: true,
                            });
                        },
                    });
                }
            });

            // update user password
            $('#updatePasswordForm').on('submit', function(e) {
                e.preventDefault();

                let isValid = true;

                // Validate old password (not empty)
                const oldPass = $('#old_pass').val().trim();
                
                
                if (!oldPass) {
                  console.log(oldPass);
                    $.Toast("Oops!", "Old password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate new password (minimum 6 characters)
                const newPass = $('#new_pass').val().trim();
                if (!newPass) {
                    $.Toast("Oops!", "New password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                } else if (newPass.length < 6) {
                    $.Toast("Oops!", "New password must be at least 6 characters", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                // Validate confirm password (must match new password)
                const confirmPass = $('#confirm_pass').val().trim();
                if (!confirmPass) {
                    $.Toast("Oops!", "Confirm password cannot be empty", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                } else if (confirmPass !== newPass) {
                    $.Toast("Oops!", "Passwords do not match.", "error", {
                        timeout: 6000,
                        has_progress: true,
                    });
                    isValid = false;
                    return false;
                }

                

                // If all fields are valid, submit the form (e.g., via AJAX)
                if (isValid) {

                    $.ajax({
                        url: '/update-password',
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            oldPass: oldPass,
                            newPass: newPass,
                            confirmPass: confirmPass,
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                $.Toast("Hooray!", response.message, "success", {
                                    timeout: 6000,
                                    has_progress: true,
                                });
                                $('#updatePasswordForm')[0].reset();
    
                            }else{
                              $.Toast("Oops!", response.message, "error", {
                                    timeout: 6000,
                                    has_progress: true,
                                });
                            }
                        },
                        error: function(xhr) {
                            // alert('Error: ' + xhr.responseJSON.message);
                            $.Toast("Oops!", 'something went wrong!', "error", {
                                timeout: 6000,
                                has_progress: true,
                            });
                        },
                    });
                }
            });


        });
    </script>
@endpush
