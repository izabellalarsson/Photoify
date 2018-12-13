<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a avatar to the user porfile.

if (isset($_FILES['avatar'])){
  $avatar = $_FILES['avatar'];
  $id = (int) $_SESSION['user']['id'];
  $tmp_name = $avatar['tmp_name'];
  $filePlace = __DIR__.'/uploads/';
  $fileTime = date("ymd");
  // tar in ett unikt id till varje bild som laddas in.
  $fileTimeSpecific = uniqid();

  if ($avatar['size'] > 2000000){
    echo 'The uploaded file exceeded the file size limit.';
  }
  elseif ($avatar['type'] != 'image/png') {
    echo 'The image file type is not allowed.';
  }
  else {
      if (isset($_SESSION['user']['id'])) {

      $statement = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");

      if (!$statement){
          die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':avatar', $avatar['name'], PDO::PARAM_STR);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);

      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);
    // move_uploaded_file($tmp_name, $filePlace.$fileTime.'-'.$avatar['name']);
        }
  }
}
