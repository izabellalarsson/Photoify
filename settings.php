<?php
require __DIR__.'/views/header.php';

if (!isset($_SESSION['user']['email'])) {
    redirect('/login.php');
}
?>

<?php if (isset($message)) : ?>
    <h1><?= $message ?></h1>

<?php endif; ?>


<h2>Edit profile</h2>


<img src="<?= './app/users/avatar/'.$_SESSION['user']['avatar']?>" alt="" class="avatar-img-settings">

<form action="./../app/users/settings-app.php" method="post" enctype="multipart/form-data" class="settings">
    <div>
        <label for="avatar">Choose a avatar to upload</label>
        <input type="file" accept=".jpg" name="avatar" id="avatar">
    </div>
    <label for="avatar">Name</label>
    <input type="text" name="name" id="name" placeholder="<?= $_SESSION['user']['name']; ?>">
    <label for="avatar">Username</label>
    <input type="text" name="username" id="username" placeholder="<?= $_SESSION['user']['username']; ?>">
    <label for="avatar">Bio</label>
    <!-- if isset shorthand -->
    <textarea type="text" name="profile_bio" id="profile_bio" placeholder="<?= $_SESSION['user']['profile_bio'] ?? ' ' ; ?>">
</textarea>
<label for="avatar">Confirm your changes</label>
<label for="email">Email</label>
<input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
<input type="password" name="password" id="password" required>
    <button type="submit" name="upload">Upload</button>

</form>

<?php
require __DIR__.'/views/footer.php';
?>
