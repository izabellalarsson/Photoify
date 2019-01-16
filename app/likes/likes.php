<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['post_id'])){
    if (filter_var($_POST['post_id'], FILTER_VALIDATE_INT)){
        $user = $_SESSION['user']['id'];
        $postId = $_POST['post_id'];

        $statement = $pdo->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $user, PDO::PARAM_INT);
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);

        $statement->execute();
        $likes = $statement->fetch(PDO::FETCH_ASSOC);

        if ($likes) {
            userDislikesPost($postId, $user, $pdo);
            redirect('/index.php');
        }
        else {
            userLikesPost($postId, $user, $pdo);
            redirect('/index.php');
        }
    }
}







    // die(var_dump($likes));
    // $posts = getAllPosts($pdo);
    //
    //     $likes = setLikes($id, $_SESSION['user']['id'], $pdo);
    // die(var_dump(123));
