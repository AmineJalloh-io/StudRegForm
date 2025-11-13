<?php
$DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = ''; // default password for XAMPP
$DB_NAME = 'lecturer_presence_db';

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($mysqli->connect_errno) {
    die("Database connection failed: " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
?>