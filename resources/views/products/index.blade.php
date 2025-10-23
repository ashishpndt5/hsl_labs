<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        form { display: inline; }
        .success { color: green; text-align: center; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Wholesale Inventory Dashboard</h2>
    @if($errors->any())
        <div style="color:red; text-align:center;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif
   

    <table>
        <tr>
            <th>Product</th>
            <th>Current Stock</th>
            <th>Change Quantity</th>
            <th>Price</th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <form method="POST" action="{{ route('products.updateStock') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity_change" placeholder="e.g. +10 or -5">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>${{ number_format($product->price, 2) }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
