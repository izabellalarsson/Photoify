<?php
require __DIR__.'/views/header.php';
?>

<?php if (isset($message)) : ?>
    <?= $message ?>
<?php endif; ?>
<form action="app/users/create.php" method="post">
    <label for="email">Username</label>
    <input class="form-control" type="text" name="username" placeholder="izzwii" required>

    <label for="email">Fullname</label>
    <input class="form-control" type="text" name="full_name" placeholder="Izabella Larsson" required>

    <label for="email">Email</label>
    <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>


    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" required>
    <small class="form-text text-muted">Please provide the your password (passphrase).</small>
    <label for="password">Repeate Password</label>
    <input class="form-control" type="password" name="password2" required>

    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php require __DIR__.'/views/footer.php'; ?>
