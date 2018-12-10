<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we create users.

if (isset($_POST['email'], $_POST['password'], $_POST['username'], $_POST['full_name'])){
    $email = trim($_POST['email']);
    $password = trim(password_hash($_POST['password']));
    $username = trim($_POST['username']);
    $fullname = trim($_POST['full_name']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) &&
        filter_var($password, FILTER_SANITIZE_STRING) &&
        filter_var($fullname, FILTER_SANITIZE_STRING) &&
        filter_var($username, FILTER_SANITIZE_STRING)) {

        $statement = $pdo->query('INSERT INTO users(name, email, password, username) WHERE email = :email AND name = :name AND password = :password AND username = :username');

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        die(var_dump($user));

        // $user_Email = $statement->fetch(PDO::FETCH_ASSOC);
        // $user_Password = $statement->fetch(PDO::FETCH_ASSOC);

        //
        // if ($user['email'] == $email && password_verify($password, $user['password'])) {
        //
        //     $_SESSION['user'] = [
        //         'id' => $user['id'],
        //         'name' => $user['name'],
        //         'email' => $user['email']
        //     ];
        //     redirect('/index.php');
        //
        // }else {
        //     redirect('/login.php');
        // }
    }

}


$email = 'hej';
$password = 'hej';
$username = 'hej';
$fullname = 'hej';

$statement = $pdo->query('INSERT INTO users(email, username) WHERE email = :email AND username = :username');

if (!$statement){
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':email', $email, PDO::PARAM_STR);
// $statement->bindParam(':password', $password, PDO::PARAM_STR);
// $statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
$statement->bindParam(':username', $username, PDO::PARAM_STR);

$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

die(var_dump($user));
