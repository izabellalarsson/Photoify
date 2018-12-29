<?php
require __DIR__.'/views/header.php';

$userPosts = getPostsByUser($_SESSION['user']['id'], $pdo);

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
        <section class="likes">
            <i class="far fa-heart unfilled"></i>
            <i class="fas fa-heart filled"></i>
        </section>
        <section class="description">
            <p><a href=""><?= $_SESSION['user']['username'];?></a> <?= $userPost['description']  ?></p>
        </section>
        <section class="edit-post-button">
            <a href="">edit</a>
        </section>
        <section class="edit-post">
            <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="settings-form">
                <label for="description">Change description</label>
                <input type="text" name="description" placeholder="<?= $userPost['description']; ?>" value="<?= $userPost['description']; ?>">
                <button type="submit" name="id" value="<?= $userPost['id']; ?>">update</button>
            </form>
        </section>
        <section class="delete-post-button">
            <a href="">delete</a>
        </section>
        <section class="delete-post">
            <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="settings-form">
                <button type="submit" name="delete" value="<?= $userPost['id']; ?>">delete post</button>
            </form>
        </section>
    </article>
<?php endforeach; ?>

<?php
require __DIR__.'/views/footer.php';
?>
