<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.


if (isset($_POST['username'], $_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $statement = $pdo->prepare("SELECT * FROM users WHERE username = :username");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] == $username && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'avatar' => $user['avatar'],
            'username' => $user['username'],
            'profile_bio' => $user['profile_bio']
        ];

        redirect('/index.php');
    } elseif (!$user['username']) {
        $_SESSION['message'] = 'This username does not exist';
        redirect('/login.php');
    } elseif (!password_verify($password, $user['password'])) {
        $_SESSION['message'] = 'Wrong password';
        redirect('/login.php');
    }
}

redirect('/');
