<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';
    // koden funkar men behöver sätta in ett värde.
    $likes = getInformation(29, $pdo);

    echo json_encode($likes);

?>
