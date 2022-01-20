<?php
require __DIR__."/../core/core.php";

if ($dbManipulator->verifyEmailInDb($_POST['email'])) {
    $message = 'Email-ul exista deja';
    header('Location: /register.php?errorMsg='.$message);
    die();
} else {
    $dbManipulator->insertUser($_POST);

    $user = new User();

    $sessionUser = $user->login($_POST['email'], $_POST['password']);

    if ($sessionUser) {
        $_SESSION['user'] = $sessionUser;
    }

    header('Location: /');
}