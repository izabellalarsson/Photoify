<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
//
if (isset($_POST['post'])) {
    $posts = $_POST['post'];

    if ($posts['size'] > 2000000){
            $_SESSION['message'] = 'The uploaded file exceeded the file size limit.';
        }
        elseif ($posts['type'] != 'image/jpg') {
            $_SESSION['message'] = 'The image file type is not allowed.';
        }
        elseif (filter_var($posts['name'], FILTER_SANITIZE_STRING)) {
            if (isset($_SESSION['user']['id'])) {
                $id = $_SESSION['user']['id'];
                $statement = $pdo->prepare("UPDATE posts SET avatar = :avatar, profile_bio = :profile_bio WHERE id = :id");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
                $statement->bindParam(':profile_bio', $profileBio, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__.'/avatar/'.$avatarName.'');
                $_SESSION['message'] = 'Your changes has been updated';
                $_SESSION['user']['avatar'] = $avatarName;
                $_SESSION['user']['profile_bio'] = $profileBio;
                redirect('/settings.php');
                die;
            }

}

redirect('/');
