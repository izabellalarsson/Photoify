<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
//
if (isset($_POST['description'], $_FILES['image'])) {
    $description = $_POST['description'];
    $image = $_FILES['image'];


    if ($image['size'] > 2000000){
            $_SESSION['message'] = 'The uploaded file exceeded the file size limit.';
            echo 'too big';
        }
        elseif ($image['type'] != 'image/jpeg') {
            $_SESSION['message'] = 'The image file type is not allowed.';
            echo 'wrong type';
        }
        elseif (filter_var($image['name'], FILTER_SANITIZE_STRING)) {
            if (isset($_SESSION['user']['id'])) {
                $id = (int) $_SESSION['user']['id'];
                $extention = pathinfo($image['name'])['extension'];
                $fileName = pathinfo($image['name'])['filename'];
                $username = $_SESSION['user']['username'];
                $fileTime = date("ymd:H:i:s");
                $userFolder = $id;
                $imageName = $id.'-'.$fileTime.'.'.$extention;
                // $imageName = $id.'.'.$extention;
                // die(var_dump($imageName));

                $statement = $pdo->prepare("INSERT INTO posts(image, description, user_id) VALUES(:image, :description, :user_id)");

                if (!$statement){
                    die(var_dump($pdo->errorInfo()));
                }

                $statement->bindParam(':image', $imageName, PDO::PARAM_STR);
                $statement->bindParam(':description', $description, PDO::PARAM_STR);
                $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if (!is_dir(__DIR__."/uploaded/$userFolder")) {
                    mkdir(__DIR__."/uploaded/$userFolder");
                };


                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/uploaded/'.$userFolder.'/'.$imageName.'');
                $_SESSION['message'] = 'Your post has been uploaded';
                redirect('/profile.php');
                die;
            }

}
}


// redirect('/');
