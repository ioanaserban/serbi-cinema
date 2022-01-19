<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

$dbManipulator->deleteMovie($_POST);
header('Location: /filme.php');