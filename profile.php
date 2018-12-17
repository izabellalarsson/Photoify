<?php
require __DIR__.'/views/header.php';

// die(var_dump($_SESSION['user']['avatar']));

?>
<?php if (isset($message)) : ?>
    <h1><?= $message ?></h1>
<?php endif; ?>
<img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img">

<?php
require __DIR__.'/views/footer.php';
?>
