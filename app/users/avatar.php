<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a avatar to the user porfile. And get it in the profile

if (isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $extention = pathinfo($avatar['name'])['extension'];
    $fileName = pathinfo($avatar['name'])['filename'];
    $id = (int) $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];
    $fileTime = date("ymd");

    $avatarName = $id.'-'.$username.'.'.$extention;


    if ($avatar['size'] > 2000000) {
        $_SESSION['message'] = 'The uploaded file exceeded the file size limit.';
    } elseif ($avatar['type'] !== 'image/png') {
        $_SESSION['message'] = 'The image file type is not allowed.';
    } elseif (filter_var($avatar['name'], FILTER_SANITIZE_STRING)) {
        if (isset($_SESSION['user']['id'])) {
            $statement = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
            $statement->bindParam(':profile_bio', $profileBio, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            move_uploaded_file($avatar['tmp_name'], __DIR__.'/avatar/'.$avatarName.'');
            $_SESSION['message'] = 'Succes your avatar hase been uploaded';
            $_SESSION['user']['avatar'] = $avatarName;
            redirect('/profile.php');
        }
    }
}

redirect('/');
