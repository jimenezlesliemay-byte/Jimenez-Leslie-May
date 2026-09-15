<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<style>
body{font-family:Arial,sans-serif;margin:40px;background:#f4f6f8;}
.container{max-width:900px;margin:auto;background:#fff;padding:25px;border-radius:8px;box-shadow:0 0 10px rgba(0,0,0,.1);}
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{padding:10px;border:1px solid #ddd;text-align:left;}
th{background:#333;color:#fff;}
a.btn{padding:6px 12px;border-radius:4px;text-decoration:none;color:#fff;font-size:13px;}
.btn-add{background:#28a745;} .btn-edit{background:#ffc107;color:#000;} .btn-delete{background:#dc3545;}
.flash{padding:10px;border-radius:4px;margin-bottom:15px;}
.success{background:#d4edda;color:#155724;} .error{background:#f8d7da;color:#721c24;}
.topbar{display:flex;justify-content:space-between;align-items:center;}
</style>
</head>
<body>
<div class="container">
    <div class="topbar">
        <h2>Product List</h2>
        <div>
            Logged in as <strong><?= htmlspecialchars($_SESSION['username'] ?? '') ?></strong>
            | <a href="<?= base_url('logout') ?>">Logout</a>
        </div>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="flash success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="flash error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <a class="btn btn-add" href="<?= base_url('products/create') ?>">+ Add Product</a>

    <table>
        <tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Qty</th><th>Created</th><th>Actions</th></tr>
        <?php if (!empty($products)): foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= htmlspecialchars($product['product_name']) ?></td>
            <td><?= htmlspecialchars($product['description']) ?></td>
            <td><?= number_format($product['price'], 2) ?></td>
            <td><?= $product['quantity'] ?></td>
            <td><?= $product['created_at'] ?></td>
            <td>
                <a class="btn btn-edit" href="<?= base_url('products/edit/'.$product['id']) ?>">Edit</a>
                <a class="btn btn-delete" href="<?= base_url('products/delete/'.$product['id']) ?>"
                   onclick="return confirm('Delete this product?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="7">No products yet.</td></tr>
        <?php endif; ?>
    </table>
</div>
</body>
</html>