<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the current authenticated user's level
        $userLevel = Auth::guard('admin')->user()->level;

        // Render the sidebar
        $sidebarData = $this->renderSidebar();

        // Determine which view to return based on the user's level
        if ($userLevel === 'Owner' || $userLevel === 'Manager') {
            // Return the admin home view for Owner and Manager
            return view('admin.home', compact('sidebarData'));
        } else {
            // Return the regular admin home view for Admin, Employee, and Courier
            return view('admin.homeregular', compact('sidebarData'));
        }
    }


    public function getOrderData(Request $request)
    {
        $year = $request->input('year');
        
        // Get data from orders table
        $orderData = DB::table('orders')
            ->select(DB::raw('MONTH(order_date) as month'), DB::raw('SUM(total_amount) as total'))
            ->whereYear('order_date', $year)
            ->groupBy(DB::raw('MONTH(order_date)'))
            ->get();
        
        // Get data from purchase_transactions table
        $purchaseData = DB::table('purchase_transactions')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        return response()->json([
            'orders' => $orderData,
            'purchases' => $purchaseData,
        ]);
    }

    /**
     * Render the sidebar based on user's level.
     */
    private function renderSidebar()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Initialize an empty array to store sidebar items
        $sidebarItems = [];

        // Check if the user is authenticated and has a role property
        if ($user && $user->role) {
            // Determine sidebar items based on user's role
            if ($user->role === 'Admin') {
                $sidebarItems = [
                    'Dashboard-Karyawan',
                    'Deliveries',
                    'Orders',
                    'Order Details',
                    'Discounts',
                    'Products',
                    'Product Categories'
                ];
            } elseif ($user->role === 'Manager') {
                $sidebarItems = [
                    'Dashboard',
                    'Employees',
                    'Suppliers',
                    'Purchase Transactions',
                    'Product Reviews'
                ];
            } elseif ($user->role === 'Owner') {
                $sidebarItems = [
                    'Dashboard',
                    'Employees'
                ];
            } elseif ($user->role === 'Employee') {
                $sidebarItems = [
                    'Orders',
                    'Deliveries'
                ];
            } elseif ($user->role === 'Courier') {
                $sidebarItems = [
                    'Deliveries'
                ];
            }
        }

        // Return the sidebar items
        return ['sidebarItems' => $sidebarItems];
    }
}
