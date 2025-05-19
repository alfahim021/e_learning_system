<?php
// database/db.php

require_once __DIR__ . '/../config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_errno) {
    // Connection failed, stop the script and show error
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
