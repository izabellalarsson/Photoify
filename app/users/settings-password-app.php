<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Updating settings for password.

if (isset($_POST['password-old'], $_POST['password-new'])) {
    $passwordOld = $_POST['password-old'];
    $passwordNew = trim(password_hash($_POST['password-new'], PASSWORD_DEFAULT));
    $id = (int) $_SESSION['user']['id'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");

    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($passwordOld, $user['password'])) {
        if (password_verify($passwordOld, $passwordNew)) {
            $_SESSION['message'] = 'You have to chooese a new password';
            redirect('/settings.php');
        }
        else {
            if (isset($_SESSION['user']['id'])) {

                $statement = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':password', $passwordNew, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                $_SESSION['message'] = 'Your password has been updated';
                $_SESSION['user']['password'] = $passwordNew;
                redirect('/settings.php');
            }
        }
    }
    else {
        $_SESSION['message'] = 'Wrong password';
        redirect('/settings.php');
    }
}

        redirect('/');
