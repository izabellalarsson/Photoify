<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if ($_SESSION['user']['id']) {
    $id = $_SESSION['user']['id'];
    $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $id, PDO::PARAM_STR);

    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);


    $_SESSION['userpost'] = $posts;
}

redirect('/');
