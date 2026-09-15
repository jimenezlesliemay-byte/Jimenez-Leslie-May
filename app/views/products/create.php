<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head><title>Add Product</title>
<style>body{font-family:Arial;margin:40px;}.container{max-width:500px;margin:auto;}input,textarea{width:100%;padding:8px;margin:6px 0;}</style>
</head>
<body>
<div class="container">
    <h2>Add Product</h2>
    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <form method="post" action="<?= base_url('products/store') ?>">
        <label>Product Name</label>
        <input type="text" name="product_name" required>
        <label>Description</label>
        <textarea name="description" rows="3"></textarea>
        <label>Price</label>
        <input type="number" step="0.01" name="price" required>
        <label>Quantity</label>
        <input type="number" name="quantity" required>
        <br><br>
        <button type="submit">Save</button>
        <a href="<?= base_url('products') ?>">Cancel</a>
    </form>
</div>
</body>
</html>