<?php
require __DIR__.'/views/header.php';

if (!isset($_SESSION['user']['email'])) {
    redirect('/login.php');
}

// die(var_dump($_SESSION['user']['profile_bio']));
?>

<article class="settings">
    <h2>Edit profile</h2>
    <?php if (isset($message)) : ?>
        <h3><?= $message ?></h3>

    <?php endif; ?>
    <form action="./../app/users/settings-app.php" method="post" enctype="multipart/form-data" class="settings-form">
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
        <textarea type="text" name="profile_bio" rows="1" id="profile_bio" placeholder="<?= $_SESSION['user']['profile_bio'] ?? 'Write a bio'; ?>" value="<?= $_SESSION['user']['profile_bio']; ?>"></textarea>
        <div class="confirm">
            <label for="avatar">Confirm your changes</label>
            <input class="form-control" type="email" name="email" placeholder="<?= $_SESSION['user']['email']; ?>" value="<?= $_SESSION['user']['email']; ?>" required>
            <input type="password" name="password" id="password" placeholder="password" required>
            <button type="submit" name="upload">Update</button>
        </div>
    </form>
    <br><hr><br>
    <form action="./../app/users/settings-email-app.php" method="post" class="settings-email">
        <div class="change-email">
            <label for="email">Change your email</label>
            <input type="text" name="email" id="email" class="email-default" placeholder="<?= $_SESSION['user']['email']; ?>">
            <input type="password" name="password-confirm" id="password-confirm" class="confirm-w-password" placeholder="Confirm Password">
        <div class="change-email-button">
            <button type="submit" name="cancel">Cancel</button>
            <button type="submit" name="save">Save</button>
        </div>
        <br>
        </div>
        </form>
        <form action="./../app/users/settings-password-app.php" method="post" class="settings-password">
        <div class="change-password">
            <label for="password-old">Change your password</label>
            <input type="password" name="password-old" id="password-old" class="password-default" placeholder="Change Password">
            <input type="password" name="password-new" id="password-new" class="confirm-new-password" placeholder="New Password">
        <div class="change-password-button">
            <button type="submit" name="cancel">Cancel</button>
            <button type="submit" name="save">Save</button>
        </div>
        </div>

    </form>
</article>

<?php
require __DIR__.'/views/footer.php';
?>
