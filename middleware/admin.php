<?php
require __DIR__ . '/../core/User.php';
session_start();

if (!User::isAdmin()) {
    header('Location: /');
}