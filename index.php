<?php
require __DIR__.'/views/header.php';

$allPosts = getAllPosts($pdo);
?>
    <?php if(isset($_SESSION['user'])) : ?>
        <?php foreach ($allPosts as $post) : ?>
            <article class="posts" data-id="post_id">
            <section class="avatar-info">
                <img src="<?= './app/users/avatar/'.$post['avatar']; ?>" class="user-avatar">
                <p><a href=""><?= $post['username']; ?></a></p>
            </section>
            <img src="<?= './app/posts/uploaded/'.$post['user_id'].'/'.$post['image']; ?>">
<article class="information">
    <section class="description">
        <p><a href=""><?= $post['username'];?></a> <?= $post['description']  ?></p>
        <p class="time"><?php $date = explode(' ', $post['created']);
echo $date[0];?></p>
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
            <?php if ($_SESSION['user']['id'] === $post['user_id']): ?>
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
            <?php endif ?>
        </article>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="bg-start">
            <h1><a href="index.php">Photoify</a></h1>
            <p class="welcome-start">the best of the best places to be</p>
            <a class="create-start" href="create.php">Create account</a>
            <a class="login-start" href="login.php">Log in</a>
        </div>
    <?php endif; ?>



<?php
require __DIR__.'/views/footer.php';
?>
