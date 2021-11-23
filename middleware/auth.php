<?php
require __DIR__ . '/../core/User.php';
session_start();

if (!User::isLoggedIn()) {
    header('Location: /index.php');
}