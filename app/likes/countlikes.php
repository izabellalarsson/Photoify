<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';
    // koden funkar men behöver sätta in ett värde.
    $likes = getInformation(28, $pdo);
    echo json_encode($likes);
// $likes = countPostLikes(getAllPosts($pdo), $pdo);




?>
