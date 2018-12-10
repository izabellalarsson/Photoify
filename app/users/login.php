<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

if (isset($_POST['email'], $_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($password, FILTER_SANITIZE_STRING)) {

        $statement = $pdo->query('SELECT * FROM users WHERE email = :email');

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // $user_Email = $statement->fetch(PDO::FETCH_ASSOC);
        // $user_Password = $statement->fetch(PDO::FETCH_ASSOC);


        if ($user['email'] == $email && password_verify($password, $user['password'])) {

            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            redirect('/index.php');

        }else {
            redirect('/login.php');
        }
    }

}
