<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 28px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2563eb;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e3f2fd;
        }

        .price {
            text-align: right;
            font-weight: bold;
            color: #16a085;
        }

        .stock {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Products Report</h1>
        <p>Exported at: {{ date('d F Y, H:i:s') }}</p>
        <p>Total Products: {{ $products->count() }}</p>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->name_product }}</td>
                        <td>{{ $product->desc_product }}</td>
                        <td class="price">Rp {{ number_format($product->harga_product, 2, ',', '.') }}</td>
                        <td class="stock">{{ $product->stock_product }}</td>
                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
