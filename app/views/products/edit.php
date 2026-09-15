<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head><title>Edit Product</title>
<style>body{font-family:Arial;margin:40px;}.container{max-width:500px;margin:auto;}input,textarea{width:100%;padding:8px;margin:6px 0;}</style>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form method="post" action="<?= base_url('products/update/'.$product['id']) ?>">
        <label>Product Name</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        <label>Description</label>
        <textarea name="description" rows="3"><?= htmlspecialchars($product['description']) ?></textarea>
        <label>Price</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>
        <label>Quantity</label>
        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required>
        <br><br>
        <button type="submit">Update</button>
        <a href="<?= base_url('products') ?>">Cancel</a>
    </form>
</div>
</body>
</html>