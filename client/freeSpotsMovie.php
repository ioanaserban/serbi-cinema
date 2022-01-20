<?php
require(__DIR__ . '/../core/core.php');
require(__DIR__ . '/../middleware/auth.php');

$freeSpots = $dbManipulator->getFreeSpotsByMovieIdDateTime($_GET['movieId'], $_GET['date'], $_GET['time']);

echo json_encode($freeSpots);