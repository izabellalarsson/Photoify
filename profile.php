<?php
require __DIR__.'/views/header.php';

// die(var_dump($_SESSION['user']['avatar']));
// die(var_dump($_SESSION['post']['image']));
// die(var_dump($images['image']));
//
$userPosts = getPostsByUser($_SESSION['user']['id'], $pdo);

// die(var_dump($userPosts));
// die(var_dump('./app/posts/uploaded/'.$_SESSION['user']['id'].'/'.$userPosts));
?>
<?php if (isset($message)) : ?>
    <h1><?= $message ?></h1>
<?php endif; ?>
<img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img">
<h2>About me</h2>
<p><?= $_SESSION['user']['profile_bio'] ?? ' ' ; ?></p>

<form action="./../app/posts/store.php" method="post" enctype="multipart/form-data" class="settings-form">
    <input type="file" accept=".jpg" name="image" class="image">
    <label for="post">Write a description</label>
    <input type="text" name="description" class="description">
    <button type="submit" name="button">Upload post</button>
</form>

<?php foreach ($userPosts as $userPost): ?>
    <article class="posts">
        <img src="<?= './app/posts/uploaded/'.$_SESSION['user']['id'].'/'.$userPost['image'] ?>">
    </article>
<?php endforeach; ?>

<?php
require __DIR__.'/views/footer.php';
?>
