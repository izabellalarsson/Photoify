<?php require __DIR__.'/views/header.php'; ?>
<form action="app/users/login.php" method="post">
    <label for="email">Username</label>
    <input class="form-control" type="text" name="username" placeholder="izzwii" required>
    <small class="form-text text-muted">Please provide the your email address.</small>

    <label for="email">Fullname</label>
    <input class="form-control" type="text" name="full_name" placeholder="Izabella Larsson" required>
    <small class="form-text text-muted">Please provide the your email address.</small>

    <label for="email">Email</label>
    <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
    <small class="form-text text-muted">Please provide the your email address.</small>


    <label for="password">Password</label>
    <input class="form-control" type="password" name="password" required>
    <small class="form-text text-muted">Please provide the your password (passphrase).</small>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php require __DIR__.'/views/footer.php'; ?>
