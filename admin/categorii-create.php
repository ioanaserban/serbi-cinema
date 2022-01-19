<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

//dd($_POST);

$dbManipulator->insertCategory($_POST);
header('Location: /categorii.php');