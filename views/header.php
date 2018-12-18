<?php
// Always start by loading the default application setup.
require __DIR__.'/../app/autoload.php';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
// kan göra till en array med olika levels som error varning, welcome.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $config['title']; ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="https://csstools.github.io/sanitize.css/latest/sanitize.css">
    <link rel="stylesheet" href="/assets/styles/main.css">
    <link rel="stylesheet" href="/assets/styles/forms.css">
</head>
<body>
    <?php require __DIR__.'/navigation.php'; ?>

<div class="wrapper">
