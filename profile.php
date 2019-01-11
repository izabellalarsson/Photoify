<?php
require __DIR__.'/views/header.php';

$userPosts = getPostsByUser($_SESSION['user']['id'], $pdo);

// die(var_dump('./app/posts/uploaded/'.$_SESSION['user']['id'].'/'.$userPosts));
?>
<article class="profile">
    <section class="profile-avatar">
        <img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img">
    </section>
    <section class="profile-bio">
        <section class="info">
            <h2>
                <?= $_SESSION['user']['name'] ?>
            </h2>
            <p>
                <?= $_SESSION['user']['profile_bio'] ?? ' ' ; ?>
            </p>
        </section>
        <section class="edit">
            <a href="settings.php">Edit profile</a>
            <a href="#" class="upload-btn">Upload Post</a>
        </section>
    </section>
</article>
<article class="profile message">
    <?php if (isset($message)) : ?>
    <p>
        <?= $message ?>
    </p>
    <?php endif; ?>
</article>
<article class="profile upload">
    <section class="upload-post">
        <form action="./../app/posts/store.php" method="post" enctype="multipart/form-data" class="settings-form">
            <input type="file" accept=".jpg" name="image" class="image">
            <input type="text" name="description" class="description" placeholder="Description">
            <button type="submit" name="button">Upload post</button>
        </form>
    </section>
</article>


<?php foreach ($userPosts as $post): ?>
<article class="posts">
    <section class="header-info">
        <section class="avatar-info">
            <img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']; ?>" class="user-avatar">
            <p><a href="">
                    <?= $_SESSION['user']['username']; ?></a></p>
        </section>
        <section class="edit-post-button">
            <a href="">Edit post</a>
        </section>
    </section>
    <img src="<?= './app/posts/uploaded/'.$_SESSION['user']['id'].'/'.$post['image'] ?>">
    <article class="information">
        <section class="description">
            <p><a href="">
                    <?= $_SESSION['user']['username'];?></a>
                <?= $post['description']  ?>
            </p>
            <p class="time">
                <?php $date = explode(' ', $post['created']);
        echo $date[0];?>
            </p>
        </section>
        <section class="likes">
            <form class="like" action="./../app/likes/likes.php" method="post">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <button type="submit" name="likes">
                    <i class="<?= (checkLikedPost($post['id'], $_SESSION['user']['id'], $pdo)) ? 'fas fa-heart show' : 'far fa-heart';?>"></i>
                </button>

            </form>
        </section>
    </article>
    <section class="edit-post-button">
        <a href="">edit</a>
    </section>
    <section class="edit-post">
        <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="settings-form">
            <label for="description">Change description</label>
            <input type="text" name="description" placeholder="<?= $post['description']; ?>" value="<?= $post['description']; ?>">
            <button type="submit" name="id" value="<?= $post['id']; ?>">update</button>
        </form>
    </section>
    <section class="delete-post-button">
        <a href="">delete</a>
    </section>
    <section class="delete-post">
        <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="settings-form">
            <button type="submit" name="delete" value="<?= $post['id']; ?>">delete post</button>
        </form>
    </section>
</article>
<?php endforeach; ?>

<?php
require __DIR__.'/views/footer.php';
?>
