<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a avatar to the user porfile. And get it in the profile
// print_r(pathinfo($_FILES['avatar']['name']));

if (isset($_FILES['avatar'])){
  $avatar = $_FILES['avatar'];

  $extention = pathinfo($avatar['name'])['extension'];
  $fileName = pathinfo($avatar['name'])['filename'];
  $id = (int) $_SESSION['user']['id'];

  $fileTime = date("ymd");
  $avatarName = $fileTime.'-'.$fileName.'.'.$extention;


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

      $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
      $statement->bindParam(':id', $id, PDO::PARAM_INT);

      $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);
        }
  }
}
