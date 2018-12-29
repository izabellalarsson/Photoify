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

/**
 * Get the posts form the user id.
 *
 * @param int $id and $pdo
 *
 * @return $userPost
 */

function getPostsByUser(int $id, $pdo){
      $fileName = '/uploaded/'.$id;

      $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created DESC");

      if (!$statement){
          die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $id, PDO::PARAM_STR);

      $statement->execute();
      $userPosts = $statement->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($userPosts); ++$i){
            if (file_exists($fileName.'/'.$userPosts[$i]['image'])) {

                return $userPosts[$i]['image'];

            }
        }
        return $userPosts;
}
// gör en funktion där den kollar om id är satt


//get all the posts from every user.
function getAllPosts($pdo){
$statement = $pdo->query("SELECT * FROM posts ORDER BY created DESC");
if (!$statement){
    die(var_dump($pdo->errorInfo()));
}

$allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);


    return $allPosts;
}


// function sortUserPosts(array $a, array $b){
//      return $a > $b;
// }
