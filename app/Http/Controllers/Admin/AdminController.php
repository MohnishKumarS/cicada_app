<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Brands;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function adminIndex()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalContacts = Contact::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalBrands = Brands::count();
        $totalCategories = Category::count();

        $usersPerMonth = User::where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
        $userMonthlyCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $userMonthlyCounts[] = $usersPerMonth->get($i, 0);
        }

        // Get orders grouped by year-month for last 12 months
        $ordersPerMonth = Order::where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $ordersMonthlyCounts = [];
        $ordersLabels = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m');
            $ordersLabels[] = Carbon::now()->subMonths($i)->format('M y');
            $ordersMonthlyCounts[] = $ordersPerMonth->get($month, 0);
        }
        // return $ordersPerMonth;
        return view('admin.dashboard', compact('userMonthlyCounts', 'ordersMonthlyCounts', 'ordersLabels', 'totalUsers', 'totalContacts', 'totalOrders', 'totalProducts', 'totalBrands', 'totalCategories'));
    }

    public function contactView()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.view', compact('contacts'));
    }

    public function userView()
    {
        $users = User::withCount('orders')->where('role', '!=', 'admin')->latest()->get();
        return view('admin.contact.user', compact('users'));
    }


}
