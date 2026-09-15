<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head><title>Login</title>
<style>
body{font-family:Arial;display:flex;height:100vh;align-items:center;justify-content:center;background:#f4f6f8;}
.box{background:#fff;padding:30px;border-radius:8px;box-shadow:0 0 10px rgba(0,0,0,.1);width:320px;}
input{width:100%;padding:8px;margin:6px 0;}
button{width:100%;padding:10px;background:#333;color:#fff;border:none;border-radius:4px;}
</style>
</head>
<body>
<div class="box">
    <h2>Login</h2>
    <?php if (!empty($_SESSION['error'])): ?>
        <p style="color:red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <form method="post" action="<?= base_url('login') ?>">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Log in</button>
    </form>
</div>
</body>
</html>