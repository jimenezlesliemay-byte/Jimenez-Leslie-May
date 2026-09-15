<!-- Destination: app/views/dbcrud/edit.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 40px; background: #f4f6f9; }
        .container { max-width: 400px; margin: auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,.1); }
        input { width: 100%; padding: 10px; margin: 8px 0; box-sizing: border-box; }
        button { padding: 10px 20px; background: #3498db; color: #fff; border: none; border-radius: 5px; cursor: pointer; }
        .msg { padding: 10px; border-radius: 5px; margin-bottom: 10px; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Record</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="msg error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('users/update/'.$record['id']); ?>">
        <label>Username</label>
        <input type="text" name="username" value="<?= $record['username']; ?>" required>

        <label>Password <small>(iwan lang blangko kung ayaw palitan)</small></label>
        <input type="password" name="password" placeholder="••••••••">

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="••••••••">

        <button type="submit">Update</button>
    </form>
    <p><a href="<?= base_url('users'); ?>">Back to list</a></p>
</div>
</body>
</html>