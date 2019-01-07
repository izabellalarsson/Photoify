<?php
require __DIR__.'/views/header.php';

$allPosts = getAllPosts($pdo);

?>

    <h1>Welcome</h1>
    <?php if(isset($_SESSION['user'])) : ?>
        <p><?= 'Hello, ' . $_SESSION['user']['name'] ?></p>
        <?php foreach ($allPosts as $post) : ?>
            <article class="posts">
            <img src="<?= './app/posts/uploaded/'.$post['user_id'].'/'.$post['image'] ?>">
            <section class="likes">
                <form class="like" action="./../app/likes/likes.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <button type="submit" name="likes">
                        <i class="far fa-heart unfilled"></i>
                    </button>
                    <i class="fas fa-heart filled"></i>

                </form>
            </section>
            <section class="description">
                <p><a href=""><?= $post['username'];?></a> <?= $post['description']  ?></p>
            </section>
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
        <p>This is the home page.</p>
    <?php endif; ?>



<?php
require __DIR__.'/views/footer.php';
?>
