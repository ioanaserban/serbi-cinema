<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/auth.php');

$dbManipulator->insertReservation($_SESSION['user']['id'], $_POST['movieId'], $_POST['date'], $_POST['hour'], $_POST['spot']);

$data = [];
$data['id'] = $_SESSION['user']['id'];
$data['movieId'] = $_POST['movieId'];
$data['date'] = $_POST['date'];
$data['hour'] = $_POST['hour'];
$data['spot'] = $_POST['spot'];

header('Location: /filme.php?msg=success&data=' . json_encode($data));