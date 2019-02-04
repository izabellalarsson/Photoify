<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.

if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $user_id = (int) $_SESSION['user']['id'];
    $userFolder = $user_id;
    $userPosts = getPostsByUser($user_id, $pdo);
    $redirect = $_GET['page'];

    foreach ($userPosts as $userPost) {
        if ($post_id == $userPost['id']) {
            $imageName = $userPost['image'];
            $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id AND image = :image");

            if (!$statement) {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':id', $post_id, PDO::PARAM_INT);
            $statement->bindParam(':image', $imageName, PDO::PARAM_STR);

            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            // delete the file from the filesytem
            unlink(__DIR__.'/uploaded/'.$userFolder.'/'.$imageName.'');

            $_SESSION['message'] = 'Your post has been deleted';
            redirect($redirect);
        }
    }
}

redirect('/');
