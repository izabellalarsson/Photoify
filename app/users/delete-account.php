<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_GET['delete-acc'])) {
    $id = (int) $_GET['delete-acc'];

    $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);



    // sending the user back to login page
    unset($_SESSION['user']);
    $_SESSION['message'] = 'Your account has been deleted';
    redirect('/');
}

if (isset($_GET['delete-acc-no'])) {
    $_SESSION['message'] = 'No changes has been made';
    redirect('/settings.php');
}
