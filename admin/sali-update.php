<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

$dbManipulator->updateMovieRoom($_POST);
header('Location: /sali.php');