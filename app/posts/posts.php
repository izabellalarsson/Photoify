<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if ($_SESSION['user']['id']) {
  $id = $_SESSION['user']['id'];
  $statement = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id");

  if (!$statement){
      die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':user_id', $id, PDO::PARAM_STR);

  $statement->execute();
  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

// die(var_dump($posts));
// för att få ut värderna från min fetch all.$
die(var_dump($posts));
;

$_SESSION['userpost'] = $posts;
// for($i = 0; $i < count($posts); ++$i){
// echo $posts[$i]['image'];
// }
// foreach ($posts as $post) {
//   die(var_dump($post['image']));
// }

// $_SESSION['posts'] = $posts;
  // $_SESSION['post'] = [
  //   'image' => $posts['image'],
  //   'description' => $posts['description'],
  //   'created' => $posts['created'],
  // ];

  // $images = $_SESSION['post']['image'];
}
