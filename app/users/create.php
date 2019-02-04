<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we create users.

if (isset($_POST['email'], $_POST['password'], $_POST['password2'], $_POST['username'], $_POST['fullname'])) {
    if ($_POST['email'] == '' || $_POST['password'] == '' || $_POST['password2']== '' || $_POST['username']== '' || $_POST['fullname']== '') {
        $_SESSION['message'] = 'Please fill in all the felds';
        redirect('/create.php');
    } elseif ($_POST['password'] !== $_POST['password2']) {
        $_SESSION['message'] = "The passwords dosen't match";
        redirect('/create.php');
    } else {
        $email = trim($_POST['email']);
        $password = trim(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $username = trim($_POST['username']);
        $fullname = trim($_POST['fullname']);

        $statement = $pdo->prepare("SELECT email, username
                                    FROM users
                                    WHERE username = :username
                                    OR email = :email");

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user['email'] == $email) {
            $_SESSION['message'] = 'The email is alredy exists';
            redirect('/create.php');
        } elseif ($user['username'] == $username) {
            $_SESSION['message'] = 'The username is taken';
            redirect('/create.php');
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)  &&
            filter_var($fullname, FILTER_SANITIZE_STRING) &&
            filter_var($username, FILTER_SANITIZE_STRING)) {
            $statement = $pdo->prepare("INSERT INTO users(name, email, password, username) VALUES(:fullname, :email, :password, :username)");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':password', $password, PDO::PARAM_STR);
            $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);

            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $_SESSION['message'] = 'Log in on your new accont';
            redirect('/login.php');
        } else {
            $_SESSION['message'] = 'This is not a email';
            redirect('/create.php');
        }
    }
}

redirect('/');
