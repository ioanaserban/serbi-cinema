<?php

if (!User::isLoggedIn()) {
    header('Location: /index.php');
}