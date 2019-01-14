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


function getAllPosts($pdo){
    $statement = $pdo->query("SELECT
                            posts.id,
                            posts.image,
                            users.id as user_id,
                            users.username,
                            users.avatar,
                            posts.description,
                            posts.created
                            from posts
                            join users on posts.user_id = users.id
                            ORDER BY created DESC");
    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $allPosts = $statement->fetchAll(PDO::FETCH_ASSOC);


    return $allPosts;
}


function userLikesPost($post, $user, $pdo) {

    $statement = $pdo->prepare("INSERT INTO likes(user_id, post_id) VALUES(:user_id, :post_id)");

    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':user_id', $user, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $post, PDO::PARAM_INT);

    $statement->execute();

    $likes = $statement->fetch(PDO::FETCH_ASSOC);
}

function userDislikesPost($post, $user, $pdo){
    $statement = $pdo->prepare("DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id");

    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':post_id', $post, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

}

function checkLikedPost($post, $user, $pdo) {
    $statement = $pdo->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");

    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':post_id', $post, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function getUser($pdo, int $id) {

    $statement = $pdo->prepare("SELECT
                            posts.id,
                            posts.image,
                            users.id as user_id,
                            users.username,
                            users.name,
                            users.profile_bio,
                            users.avatar,
                            posts.description,
                            posts.created
                            from users
                            left join posts on users.id = posts.user_id
                            WHERE users.id = :id");
    if (!$statement){
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

// function checkAvatar($id, $pdo) {
//     $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
//
//     if (!$statement){
//         die(var_dump($pdo->errorInfo()));
//     }
//
//     $statement->bindParam(':id', $id, PDO::PARAM_INT);
//
//     $statement->execute();
//     $id = $statement->fetch(PDO::FETCH_ASSOC);
//
//     return $id;
// }




// function sortUserPosts(array $a, array $b){
//      return $a > $b;
// }
