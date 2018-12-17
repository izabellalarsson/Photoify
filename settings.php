<?php
require __DIR__.'/views/header.php';

if (!isset($_SESSION['user']['email'])) {
    redirect('/login.php');
}

// die(var_dump($_SESSION['user']['profile_bio']));
?>

<section class="settings">
    <h2>Edit profile</h2>
    <?php if (isset($message)) : ?>
        <h3><?= $message ?></h3>

    <?php endif; ?>
    <form action="./../app/users/settings-app.php" method="post" enctype="multipart/form-data" class="settings">
        <div class="avatar-show">
            <div class="avatar-picture">
                <img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img-settings">
            </div>
            <label for="avatar">Change Profile Photo</label>
            <div class="avatar-upload">
                <!-- <label for="avatar">
                    <i class="fas fa-arrow-up"></i> choose a file
                </label> -->
                <input type="file" accept=".jpg" name="avatar" class="avatar">
            </div>
        </div>

        <label for="avatar">Name</label>
        <input type="text" name="name" id="name" placeholder="<?= $_SESSION['user']['name']; ?>">
        <label for="avatar">Username</label>
        <input type="text" name="username" id="username" placeholder="<?= $_SESSION['user']['username']; ?>">
        <label for="avatar">Bio</label>
        <!-- if isset shorthand -->
        <textarea type="text" name="profile_bio" id="profile_bio" placeholder="<?= $_SESSION['user']['profile_bio'] ?? 'Write a bio'; ?>" value="<?= $_SESSION['user']['profile_bio']; ?>"></textarea>
        <label for="avatar">Confirm your changes</label>
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email" placeholder="<?= $_SESSION['user']['email']; ?>" required>
        <input type="password" name="password" id="password" placeholder="password" required>
        <button type="submit" name="upload">Upload</button>

    </form>
</section>

<?php
require __DIR__.'/views/footer.php';
?>
