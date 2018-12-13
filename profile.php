<?php
require __DIR__.'/views/header.php';
?>


<form action="app/users/avatar.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="avatar">Choose a avatar to upload</label>
        <input type="file" accept=".png" name="avatar" id="avatar" required>
    </div>

    <button type="submit" name="upload">Upload</button>

</form>

<?php
require __DIR__.'/views/footer.php';
?>
