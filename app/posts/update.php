<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['description'], $_POST['id'])) {

    $post_id = $_POST['id'];
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
    $user_id = (int) $_SESSION['user']['id'];
    $userFolder = $user_id;
    $userPosts = getPostsByUser($user_id, $pdo);
    $redirect = $_POST['page'];

    foreach ($userPosts as $userPost) {
        if (filter_var($description, FILTER_SANITIZE_STRING)) {

            $statement = $pdo->prepare("UPDATE posts SET description = :description WHERE id = :id");

            if (!$statement){
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':description', $description, PDO::PARAM_STR);
            $statement->bindParam(':id', $post_id, PDO::PARAM_INT);

            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            $_SESSION['message'] = 'Your changes has been updated';

            redirect($redirect);
        }

        die;
    }
}

// updates the description on all. check the delete.php file and change so it will be right

redirect('/');
