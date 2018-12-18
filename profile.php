<?php
require __DIR__.'/views/header.php';

// die(var_dump($_SESSION['user']['avatar']));

?>
<?php if (isset($message)) : ?>
    <h1><?= $message ?></h1>
<?php endif; ?>
<img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img">
<h2>About me</h2>
<p><?= $_SESSION['user']['profile_bio'] ?? ' ' ; ?></p>

<form action="./../app/users/settings-app.php" method="post" enctype="multipart/form-data" class="settings-form">
    <input type="file" accept=".jpg" name="post" class="post">
</form>


<?php
require __DIR__.'/views/footer.php';
?>
