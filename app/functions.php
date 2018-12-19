<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

// die(var_dump(file_exists(__DIR__.'/uploaded/'.'2'.'/'.'2-181219:09:47-vanessa2.jpg')));

function getPostsByUser(int $id, $pdo){
      $fileName = '/uploaded/'.$id;

      // die(var_dump(file_exists($fileName)));

      $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id");

      if (!$statement){
          die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $id, PDO::PARAM_STR);

      $statement->execute();
      $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

// die(var_dump($userPosts));

        for ($i = 0; $i < count($userPosts); ++$i){
            if (file_exists($fileName.'/'.$userPosts[$i]['image'])) {

                return $userPosts[$i]['image'];

            }
        }
        return $userPosts;
}



// function sortUserPosts(array $a, array $b){
//      return $a > $b;
// }
