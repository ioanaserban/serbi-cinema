<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

$dbManipulator->deleteCategory($_POST);
header('Location: /categorii.php');