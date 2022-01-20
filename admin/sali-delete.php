<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

$dbManipulator->deleteMovieRoom($_POST);
header('Location: /sali.php');