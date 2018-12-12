<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>
    <?php if (isset($message)) : ?>
        <?= $message ?>
    <?php endif; ?>
    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="text">Username</label>
            <input class="form-control" type="text" name="username" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <h4>If you don't have an account, klick here:</h4><a href="./create.php">create</a>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
