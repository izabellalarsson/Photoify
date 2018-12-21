<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.
if (isset($_GET['delete'])){
    $post_id = $_GET['delete'];
    $user_id = (int) $_SESSION['user']['id'];
    $userFolder = $user_id;
    $userPosts = getPostsByUser($user_id, $pdo);

        foreach ($userPosts as $userPost){
            if ($post_id == $userPost['id']){
                $imageName = $userPost['image'];
                $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id AND image = :image");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':id', $post_id, PDO::PARAM_STR);
                $statement->bindParam(':image', $imageName, PDO::PARAM_STR);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                // delete the file from the filesytem
                unlink(__DIR__.'/uploaded/'.$userFolder.'/'.$imageName.'');
                // tar bort den senaste hela tiden. måste fixa.
                $_SESSION['message'] = 'Your post has been deleted';
                redirect('/profile.php');

            }
        }


// hämta post id från databasen.
// kolla så att samma id
        // for ($i = 0; $i < count($userPosts); ++$i){
        //     $id = $userPosts[$i]['id'];
        //     $post_id = $userPosts[$i]['id'];
        //     $imageName = $userPosts[$i]['image'];
        //     die(var_dump($imageName));
        //     $image = file_get_contents('./uploaded/'.$userFolder.'/'.$userPosts[$i]['image']);



                // die(var_dump($image));
                // $statement = $pdo->prepare("DELETE FROM posts WHERE id = :id AND image = :image");
                //
                // if (!$statement){
                //     die(var_dump($pdo->errorInfo()));
                // }
                //
                // $statement->bindParam(':id', $post_id, PDO::PARAM_STR);
                // $statement->bindParam(':image', $imageName, PDO::PARAM_STR);
                //
                // $statement->execute();
                // $user = $statement->fetch(PDO::FETCH_ASSOC);
                //
                // // delete the file from the filesytem
                // unlink(__DIR__.'/uploaded/'.$userFolder.'/'.$imageName.'');
                // // tar bort den senaste hela tiden. måste fixa.
                // $_SESSION['message'] = 'Your post has been deleted';
                // redirect('/profile.php');

        }





redirect('/');
