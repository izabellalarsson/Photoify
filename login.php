<?php require __DIR__.'/views/header.php'; ?>

    <div class="bg-start">
        <h1><a href="index.php">Photoify</a></h1>
        <section class="create-form">
        <?php if (isset($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form class="create-account" action="app/users/login.php" method="post">
            <input class="form-control first" type="text" name="username" placeholder="Username" required>
            <input class="form-control last" type="password" name="password" placeholder="Password" required>
        </section>
            <button type="submit" name="button" class="login-start">Login</button>
        </form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
