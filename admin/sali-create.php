<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/admin.php');

//dd($_POST);

$dbManipulator->insertMovieRoom($_POST);
header('Location: /sali.php');