<?php
require __DIR__.'/views/header.php';

$allPosts = getAllPosts($pdo);

?>

<?php if(isset($_SESSION['user'])) : ?>
<?php foreach ($allPosts as $post) : ?>
<article class="posts">
    <section class="header-info">
        <section class="avatar-info">
            <img src="./app/users/avatar/<?=$post['avatar']; ?>" class="user-avatar">
            <form action="<?= '/user.php'; ?>" method="get">
                <button type="submit" name="id" value="<?= $post['user_id']?>">
                    <?= $post['username']; ?></button>
            </form>
        </section>
        <?php if ($_SESSION['user']['id'] === $post['user_id']): ?>
        <section class="edit-post-button"">
                        <button type=" submit" data-id="<?= $post['id']?>"><i
                class="fas fa-pencil-alt"></i></button>
        </section>
    </section>
    <section class="edit-post hidden" data-id="<?= $post['id']?>">
        <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="description-form">
            <label for="description">Change description</label>
            <input type="text" name="description" placeholder="<?= $post['description']; ?>" value="<?= $post['description']; ?>">
            <input type="hidden" name="page" value="<?= '/';?>">
            <button type="submit" name="id" value="<?= $post['id']; ?>">Update</button>
        </form>
        <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="delete-form">
            <input type="hidden" name="page" value="<?='/';?>">
            <button type="submit" name="delete" value="<?= $post['id']; ?>"><i class="fas fa-trash-alt"></i></button>
        </form>
        <?php endif; ?>
    </section>
    <img src="./app/posts/uploaded/<?=$post['user_id'].'/'.$post['image']; ?>">
    <article class="information">
        <section class="description">
            <p><a href="">
                    <?= $post['username'];?></a>
                <?= $post['description']  ?>
            </p>
            <p class="time">
                <?php $date = explode(' ', $post['created']); ?>
                <?= $date[0];?>
            </p>
        </section>
        <section class="likes">
            <!-- <form class="like" action="./../app/likes/likes.php" method="post" target="hiddenFrame"> -->
            <form class="like" action="./../app/likes/likes.php" method="post">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <p>
                    <?= (countPostLikes($post['id'], $pdo ) > 0) ? countPostLikes($post['id'], $pdo) : ''; ?>
                </p>
                <button type="submit" name="likes" value="3">
                    <i class="<?= (checkLikedPost($post['id'], $_SESSION['user']['id'], $pdo)) ? 'fas fa-heart show' : 'far fa-heart';?>"></i>
                </button>
            </form>
            <!-- <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe> -->
        </section>
    </article>
</article>
<?php endforeach; ?>
<?php else : ?>
<div class="bg-start">
    <h1><a href="index.php">Photoify</a></h1>
    <p class="welcome-start">the best of the best places to be</p>
    <?php if (isset($message)) : ?>
    <p class="welcome-start">
        <?= $message ?>
    </p>
    <?php endif; ?>
    <a class="create-start" href="create.php">Create account</a>
    <a class="login-start" href="login.php">Log in</a>
</div>
<?php endif; ?>

<?php require __DIR__.'/views/footer.php'; ?>
