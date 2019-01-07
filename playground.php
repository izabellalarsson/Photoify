<?php

declare(strict_types=1);


require __DIR__.'/app/autoload.php';

// $user = (int) $_SESSION['user']['id'];
// $id = 2;
// $post = 5;
//
// $statement = $pdo->prepare("INSERT INTO likes(id, user_id, post_id) VALUES(:id, :user_id, :post_id)");
//
// if (!$statement){
//     die(var_dump($pdo->errorInfo()));
// }
//
// $statement->bindParam(':id', $id, PDO::PARAM_INT);
// $statement->bindParam(':user_id', $user, PDO::PARAM_INT);
// $statement->bindParam(':post_id', $post, PDO::PARAM_INT);
//
// $statement->execute();
//
// $likes = $statement->fetch(PDO::FETCH_ASSOC);


$user = (int) $_SESSION['user']['id'];
$id = 2;
$post = 5;

$statement = $pdo->prepare("DELETE FROM likes WHERE post_id = :post_id");

if (!$statement){
    die(var_dump($pdo->errorInfo()));
}

$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':user_id', $user, PDO::PARAM_INT);
$statement->bindParam(':post_id', $post, PDO::PARAM_INT);

$statement->execute();

$likes = $statement->fetch(PDO::FETCH_ASSOC);


die(var_dump($likes));
