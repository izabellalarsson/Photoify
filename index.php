<?php
require __DIR__.'/views/header.php';
?>

<article>
    <h1>Welcome</h1>
    <?php if(isset($_SESSION['user'])) : ?>
        <p><?= 'Hello, ' . $_SESSION['user']['name'] ?></p>
    <?php else : ?>
        <p>This is the home page.</p>
    <?php endif; ?>

</article>

<?php
require __DIR__.'/views/footer.php';
?>
