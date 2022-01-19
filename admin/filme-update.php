<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

$dbManipulator->updateMovie($_POST);
header('Location: /filme.php');