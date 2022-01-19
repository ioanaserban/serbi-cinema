<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

//dd($_POST);

$dbManipulator->insertMovie($_POST);
header('Location: /filme.php');