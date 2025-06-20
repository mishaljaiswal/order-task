<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .modal-content {
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">OrderApp</a>
  </div>
</nav>

<!-- Page content -->
<main class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card glass-card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Order Product</h4>
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: ₹{{ $product->price }}</p>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#orderModal">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('place.order') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Enter Quantity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Place Order</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Toast Notification -->
@if(session('success') || session('error'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div class="toast align-items-center text-bg-{{ session('success') ? 'success' : 'danger' }} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        {{ session('success') ?? session('error') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif

<!-- Footer -->
<footer class="bg-white text-center text-muted py-3 mt-auto shadow-sm">
  <div>© {{ date('Y') }} OrderApp. All rights reserved.</div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>