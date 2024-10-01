<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
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
            height: 20px; /* Ubah ukuran sesuai kebutuhan */
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
        <h1 style="text-align: center;">Report product from {{ $startDate->format('d-m-Y') }} to {{ $endDate->format('d-m-Y') }}</h1>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Times Purchased</th>
                <th>Quantity terbeli</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['times_purchased'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>Rp {{ number_format($item['total_revenue'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">Total Revenue</td>
                <td style="font-weight: bold;">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
