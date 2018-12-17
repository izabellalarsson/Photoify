<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a avatar to the user porfile. And get it in the profile
// die(var_dump(pathinfo($_FILES['avatar']['name'])));
// print_r(pathinfo($_FILES['avatar']['name']));
// die(var_dump(redirect('/assets')));

if (isset($_POST['password'], $_POST['email'])){
    if ($_POST['email'] == $_SESSION['user']['email']) {

        $password = $_POST['password'];
        $email = $_POST['email'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])){
            $avatar = $user['avatar'];
            $extention = pathinfo($avatar)['extension'];
            $fileName = pathinfo($avatar)['filename'];
            $id = (int) $_SESSION['user']['id'];
            $username = $_SESSION['user']['username'];
            $fileTime = date("ymd");
            $avatarName = $id.'-'.$username.'.'.$extention;

            if (isset($_POST['profile_bio'])){
                        $profileBio = trim(filter_var($_POST['profile_bio'], FILTER_SANITIZE_STRING));
                        echo $profileBio;
                }else {
                    die(var_dump());
                    $profileBio = $_SESSION['user']['profile_bio'];
                    echo $profileBio;
                }

            if (isset($_SESSION['user']['id'])) {

                $statement = $pdo->prepare("UPDATE users SET avatar = :avatar, profile_bio = :profile_bio WHERE id = :id");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
                $statement->bindParam(':profile_bio', $profileBio, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__.'/avatar/'.$avatarName.'');
                $_SESSION['message'] = 'Succes your avatar hase been uploaded';
                $_SESSION['user']['avatar'] = $avatarName;
                $_SESSION['user']['profile_bio'] = $profileBio;
    }

            // if (isset($_FILES['avatar'])){
            //     die(var_dump($_FILES['avatar']));
            //     $avatar = $_FILES['avatar'];
            //     $extention = pathinfo($avatar['name'])['extension'];
            //     $fileName = pathinfo($avatar['name'])['filename'];
            //     $id = (int) $_SESSION['user']['id'];
            //     $username = $_SESSION['user']['username'];
            //     $fileTime = date("ymd");
            //     $avatarName = $id.'-'.$username.'.'.$extention;
            //
            //     if ($avatar['size'] > 2000000){
            //         $_SESSION['message'] = 'The uploaded file exceeded the file size limit.';
            //     }
            //     elseif ($avatar['type'] != 'image/jpg') {
            //         $_SESSION['message'] = 'The image file type is not allowed.';
            //     }
            //     elseif (filter_var($avatar['name'], FILTER_SANITIZE_STRING)) {
            //         if (isset($_SESSION['user']['id'])) {
            //
            //             $statement = $pdo->prepare("UPDATE users SET avatar = :avatar, profile_bio = :profile_bio WHERE id = :id");
            //
            //             if (!$statement){
            //                 die(var_dump($pdo->errorInfo()));
            //             }
            //
            //             $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
            //             $statement->bindParam(':profile_bio', $profileBio, PDO::PARAM_STR);
            //             $statement->bindParam(':id', $id, PDO::PARAM_INT);
            //
            //             $statement->execute();
            //             $user = $statement->fetch(PDO::FETCH_ASSOC);
            //
            //             move_uploaded_file($avatar['tmp_name'], __DIR__.'/avatar/'.$avatarName.'');
            //             $_SESSION['message'] = 'Succes your avatar hase been uploaded';
            //             $_SESSION['user']['avatar'] = $avatarName;
            //             $_SESSION['user']['profile_bio'] = $profileBio;
            // }

    //         if (isset($_POST['profile_bio'])){
    //             $profileBio = trim(filter_var($_POST['profile_bio'], FILTER_SANITIZE_STRING));
    //             echo $profileBio;
    //         }
    //
    //
    //
    //                 redirect('/profile.php');
    //
    //                 $_SESSION['message'] = 'yaaah';
    //                 redirect('/settings.php');
    //         }
    //     }
    // }else {
    //         $_SESSION['message'] = 'naaah';
    //         redirect('/settings.php');
    //     }
    // }else {
    //     $_SESSION['message'] = 'you have to confirm';
    //     redirect('/settings.php');
    // }
}
}
}

    //
    // die(var_dump(123));
    // $avatar = $_FILES['avatar'];
    // $extention = pathinfo($avatar['name'])['extension'];
    // $fileName = pathinfo($avatar['name'])['filename'];
    // $id = (int) $_SESSION['user']['id'];
    // $username = $_SESSION['user']['username'];
    // $fileTime = date("ymd");
    // $avatarName = $id.'-'.$username.'.'.$extention;
    //
    // $password = $_POST['password'];
    // $profileBio = trim(filter_var($_POST['profile_bio'], FILTER_SANITIZE_STRING));
