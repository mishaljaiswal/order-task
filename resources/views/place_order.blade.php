<!DOCTYPE html>
<html>
<head>
    <title>Place Order</title>
</head>
<body>
    <h1>Place New Order</h1>
    <form method="POST" action="/place-order">
        @csrf
        <label>User ID:</label>
        <input type="number" name="user_id" required><br><br>

        <label>Total Amount:</label>
        <input type="text" name="total_amount" required><br><br>

        <h3>Items</h3>
        <div id="items">
            <div class="item">
                <label>Product ID:</label>
                <input type="number" name="items[0][product_id]" required>
                <label>Quantity:</label>
                <input type="number" name="items[0][quantity]" required>
                <label>Price:</label>
                <input type="text" name="items[0][price]" required>
            </div>
        </div>

        <br>
        <button type="button" onclick="addItem()">Add Another Item</button>
        <br><br>
        <button type="submit">Place Order</button>
    </form>

    <script>
        let itemCount = 1;
        function addItem() {
            const div = document.createElement('div');
            div.classList.add('item');
            div.innerHTML = `
                <label>Product ID:</label>
                <input type="number" name="items[${itemCount}][product_id]" required>
                <label>Quantity:</label>
                <input type="number" name="items[${itemCount}][quantity]" required>
                <label>Price:</label>
                <input type="text" name="items[${itemCount}][price]" required>
            `;
            document.getElementById('items').appendChild(div);
            itemCount++;
        }
    </script>
</body>
</html>
