<?php
require __DIR__.'/views/header.php';

if (isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $getContent = getUser($pdo, $id);
    $userPosts = getPostsByUser($id, $pdo);
}
else {
    redirect('/');
}
// die(var_dump('./app/posts/uploaded/'.$_SESSION['user']['id'].'/'.$userPosts));
?>
<article class="profile">
    <section class="profile-avatar">
        <img src="<?= './app/users/avatar/'.$getContent['avatar']?>" alt="" class="avatar-img">
    </section>
    <section class="profile-bio">
        <section class="info">
            <h2>
                <?= $getContent['name'] ?>
            </h2>
            <p>
                <?= $getContent['profile_bio'] ?? ' ' ; ?>
            </p>
        </section>
        <?php if ($_SESSION['user']['id'] == $getContent['user_id']) :?>
        <section class="edit">
            <a href="settings.php">Edit profile</a>
            <a href="#" class="upload-btn">Upload Post</a>
        </section>
        <?php endif; ?>
    </section>
</article>
<article class="profile message">
    <?php if (isset($message)) : ?>
    <p>
        <?= $message ?>
    </p>
    <?php endif; ?>
    <?php if ($getContent['image'] === NULL) : ?>
    <p>This user has no posts yet</p>
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
            <img src="<?= './app/users/avatar/'.$getContent['avatar']; ?>" class="user-avatar">
            <form action="<?= '/user.php'; ?>" method="get">
                <button type="submit" name="id" value="<?= $post['user_id']?>">
                    <?= $getContent['username']; ?></button>
            </form>
        </section>
        <?php if ($_SESSION['user']['id'] == $getContent['user_id']) :?>
        <section class="edit-post-button">
            <button type="submit" data-id="<?= $post['id']?>"><i class="fas fa-pencil-alt"></i></button>
        </section>
        <?php endif; ?>
    </section>
    <section class="edit-post hidden" data-id="<?= $post['id']?>">
        <form action="./../app/posts/update.php" method="post" enctype="multipart/form-data" class="description-form">
            <label for="description">Change description</label>
            <input type="text" name="description" placeholder="<?= $post['description']; ?>" value="<?= $post['description']; ?>">
            <input type="hidden" name="page" value="<?='/profile.php';?>">
            <button type="submit" name="id" value="<?= $post['id']; ?>">Update</button>
        </form>
        <form action="./../app/posts/delete.php" method="get" enctype="multipart/form-data" class="delete-form">
            <input type="hidden" name="page" value="<?='/profile.php';?>">
            <button type="submit" name="delete" value="<?= $post['id']; ?>"><i class="fas fa-trash-alt"></i></button>
        </form>
    </section>
    <img src="<?= './app/posts/uploaded/'.$getContent['user_id'].'/'.$post['image'] ?>">
    <article class="information">
        <section class="description">
            <p><a href="">
                    <?= $getContent['username'];?></a>
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
</article>
<?php endforeach; ?>

<?php
require __DIR__.'/views/footer.php';
?>
