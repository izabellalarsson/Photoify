<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we upload a avatar to the user porfile. And get it in the profile

// Updating settings for avatar, bio, name and username.

if (isset($_POST['password'], $_POST['email'])) {
    if ($_POST['email'] == $_SESSION['user']['email']) {
        $password = $_POST['password'];
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

        // getting the right user from the database
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            $fileTime = date("ymd");
            $id = (int) $_SESSION['user']['id'];

            $statement = $pdo->prepare("SELECT * FROM users");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->execute();
            $userAll = $statement->fetchAll(PDO::FETCH_ASSOC);

            for ($i = 0; $i < count($userAll); $i++) {
                if ($userAll[$i]['username'] == $_POST['username']) {
                    $username = $_SESSION['user']['username'];
                    $_SESSION['message'] =  'This username alredy exists';
                    redirect('/settings.php');
                    die;
                } elseif (filter_var($_POST['username'], FILTER_SANITIZE_STRING)) {
                    $_SESSION['message'] =  'Your username has been updated';
                    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));

                    $statement = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");

                    if (!$statement) {
                        die(var_dump($pdo->errorInfo()));
                    }

                    $statement->bindParam(':username', $username, PDO::PARAM_STR);
                    $statement->bindParam(':id', $id, PDO::PARAM_INT);

                    $statement->execute();
                    $updateUsername = $statement->fetch(PDO::FETCH_ASSOC);
                    // die(var_dump($username));

                    $_SESSION['user']['username'] = $username;
                    redirect('/settings.php');
                    die;
                }
            }
            if ($_POST['profile_bio'] == '') {
                $profileBio = $_SESSION['user']['profile_bio'];
            } elseif (filter_var($_POST['profile_bio'], FILTER_SANITIZE_STRING)) {
                $profileBio = trim(filter_var($_POST['profile_bio'], FILTER_SANITIZE_STRING));
                $_SESSION['message'] = 'Your bio has been updated';
            }

            if ($_POST['username'] == '') {
                $changeUsername = $_SESSION['user']['username'];
            } elseif ($_POST['username'] === $_SESSION['user']['username']) {
                $_SESSION['message'] = 'This username alredy exists';
            } else {
                $changeUsername = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
            }

            if (!empty($_FILES['avatar']['size'])) {
                $avatar = $user['avatar'];
                $extention = pathinfo($avatar)['extension'];
                $fileName = pathinfo($avatar)['filename'];
                $username = $_SESSION['user']['username'];
                $avatarName = $id.'-'.$username.'.'.$extention;
                $_SESSION['user']['avatar'] = $avatarName;
            } else {
                $_SESSION['user']['avatar'] = $user['avatar'];
            }

            $statement = $pdo->prepare("UPDATE users SET avatar = :avatar, profile_bio = :profile_bio, name = :name, username = :username WHERE id = :id");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }
            if (!empty($_FILES['avatar']['size'])) {
                $statement->bindParam(':avatar', $avatarName, PDO::PARAM_STR);
            }
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            // $statement->bindParam(':name', $name, PDO::PARAM_STR);
            $statement->bindParam(':profile_bio', $profileBio, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();
            $updateUser = $statement->fetch(PDO::FETCH_ASSOC);

            move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__.'/avatar/'.$avatarName.'');
            $_SESSION['message'] = 'Your changes has been updated';
            $_SESSION['user']['profile_bio'] = $profileBio;
            $_SESSION['user']['username'] = $changeUsername;
            // $_SESSION['user']['name'] = $name;
            redirect('/settings.php');
            die;
        } else {
            $_SESSION['message'] = 'The password does not match';
            redirect('/settings.php');
        }
    } else {
        $_SESSION['message'] = 'This email does not exist';
        redirect('/settings.php');
    }
}
redirect('/');
