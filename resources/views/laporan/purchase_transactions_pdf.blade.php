<!DOCTYPE html>
<html>
<head>
    <title>Report Pengeluaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            background-color: #f0f0f0;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }
        .header img {
            width: 20px; /* Ubah ukuran sesuai kebutuhan */
            height: 20px; /*Ubah ukuran sesuai kebutuhan*/
            margin: 10px auto; /* Memusatkan logo */
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.5)); /* Tambahkan bayangan */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            background-color: #f0f0f0;
            padding: 10px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('img/logoGreenmart.png') }}" alt="Company Logo">
        <h1 style="text-align: center;">Pengeluaran dari {{ $startDate->format('d-m-Y') }} sampai {{ $endDate->format('d-m-Y') }}</h1>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Tanggal Transaksi</th>
                <th>Total Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($purchaseTransactions as $purchaseTransaction)
                <tr>
                    <td>{{ $purchaseTransaction->product->product_name }}</td>
                    <td>{{ $purchaseTransaction->supplier->name }}</td>
                    <td>{{ $purchaseTransaction->quantity }}</td>
                    <td>{{ \Carbon\Carbon::parse($purchaseTransaction->transactions_date)->format('d/m/Y') }}</td>
                    <td>Rp {{ number_format($purchaseTransaction->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold;">Total Pengeluaran</td>
                <td style="font-weight: bold;">Rp {{ number_format($totalExpense, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
