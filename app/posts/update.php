<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['description'])){
    $description = trim($_POST['description']);
    $id = (int) $_SESSION['user']['id'];
// updates the description on all. check the delete.php file and change so it will be right
    if (filter_var($description, FILTER_SANITIZE_STRING)){

        $statement = $pdo->prepare("UPDATE posts SET description = :description WHERE user_id = :user_id");

        if (!$statement){
            die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $_SESSION['message'] = 'Your changes has been updated';
        redirect('/profile.php');
        die;
    }

}

redirect('/');
