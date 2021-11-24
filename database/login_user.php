<?php
require __DIR__."/../core/core.php";

$user = new User();

$sessionUser = $user->login($_POST['email'], $_POST['password']);

if (!$sessionUser) {
    $message = 'Date incorecte';

    header('Location: /login.php?errorMsg='.$message);
}

if ($sessionUser) {
    $_SESSION['user'] = $sessionUser;
}

header('Location: /');