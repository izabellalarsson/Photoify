<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Updating settings for email.

if (isset($_POST['email'], $_POST['password-confirm'])) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
        $password = $_POST['password-confirm'];
        $id = (int) $_SESSION['user']['id'];

        $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $user['password'])) {
            if (isset($_SESSION['user']['id'])) {

                $statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->bindParam(':id', $id, PDO::PARAM_INT);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                $_SESSION['message'] = 'Your email has been updated';
                $_SESSION['user']['email'] = $email;
                redirect('/settings.php');
            }
        }
        else {
            $_SESSION['message'] = 'Wrong password';
            redirect('/settings.php');
        }
    }
    else {
        $_SESSION['message'] = 'fill in a new email';
        redirect('/settings.php');
    }
}

redirect('/');
