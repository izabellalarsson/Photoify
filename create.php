<?php
require __DIR__.'/views/header.php';
?>

<div class="bg-start">
    <h1><a href="index.php">Photoify</a></h1>
    <section class="create-form">
        <?php if (isset($message)) : ?>
            <p><?= $message ?></p>
        <?php endif; ?>
        <form class="create-account" action="app/users/create.php" method="post">
            <input class="form-control first" type="text" name="fullname" placeholder="Name" >
            <input class="form-control" type="text" name="username" placeholder="Username" >
            <input class="form-control" type="email" name="email" placeholder="Email" >
            <input class="form-control" type="password" name="password" placeholder="Password" >
            <input class="form-control last" type="password" name="password2" placeholder="Repeate password" >
        </section>
            <button type="submit" name="button" class="create-start">Create account</button>
        </form>
</div>
<?php require __DIR__.'/views/footer.php'; ?>
