<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
</head>
<body>
    <h2>Product: {{ $product->name }} (₹{{ $product->price }})</h2>
    <form method="POST" action="{{ route('place.order') }}">
        @csrf
        Quantity: <input type="number" name="quantity" min="1" required>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
