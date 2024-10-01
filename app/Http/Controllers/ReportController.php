<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Orders;
use App\Models\OrderDetails;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index()
    {
        return view('laporan.report');
    }

    public function generatePDF(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $orders = Orders::with(['orderDetails.product'])
                        ->whereBetween('order_date', [$startDate, $endDate])
                        ->get();

        $data = [];
        $totalRevenue = 0; // Initialize total revenue
        
        foreach ($orders as $order) {
            foreach ($order->orderDetails as $detail) {
                $product = $detail->product;
                if (!isset($data[$product->id])) {
                    $data[$product->id] = [
                        'product_name' => $product->product_name,
                        'quantity' => 0,
                        'total_revenue' => 0,
                        'times_purchased' => 0
                    ];
                }
                $data[$product->id]['quantity'] += $detail->quantity;
                $data[$product->id]['total_revenue'] += $detail->subtotal;
                $data[$product->id]['times_purchased'] += 1;
                $totalRevenue += $detail->subtotal; // Add to total revenue
            }
        }

        $pdf = PDF::loadView('laporan.report_pdf', compact('data', 'startDate', 'endDate', 'totalRevenue'));

        return $pdf->download('report.pdf');
    }

}
