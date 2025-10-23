<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container">
        <h2>Place Order</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="mb-3">
                <label for="provider_id" class="form-label">Select Provider</label>
                <select name="provider_id" id="provider_id" class="form-control" required>
                    <option value="">-- choose --</option>
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="patient_id" class="form-label">Select Patient</label>
                <select name="patient_id" id="patient_id" class="form-control" required>
                    <option value="">-- choose --</option>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>

            <h4>Products</h4>
            @foreach($products as $product)
                <div class="row mb-2">
                    <div class="col-md-6">
                        {{ $product->name }} (Stock: {{ $product->stock }})
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" name="items[{{ $loop->index }}][product_id]" value="{{ $product->id }}">
                        <input type="number" name="items[{{ $loop->index }}][quantity]" class="form-control" placeholder="Quantity" min="0">
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary mt-3">Submit Order</button>
        </form>
    </div>
</body>
</html>
