<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.
if (isset($_POST['delete'])){
    $delete = $_POST['delete'];
    $user_id = (int) $_SESSION['user']['id'];
    $userPosts = getPostsByUser($user_id, $pdo);
    $userFolder = $user_id;

    foreach ($userPosts as $userPost) {
        $post_id = $userPost['id'];
        $imageName = $userPost['image'];
        die(var_dump($post_id));
        $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id");

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':id', $post_id, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // delete the file from the filesytem
        unlink(__DIR__.'/uploaded/'.$userFolder.'/'.$imageName.'');
        // tar bort den senaste hela tiden. måste fixa.
        $_SESSION['message'] = 'Your post has been deleted';
        redirect('/profile.php');
        // die;
    }
}

redirect('/');
