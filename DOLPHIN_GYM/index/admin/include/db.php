<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'gym';

$mysqli = new mysqli($host, $username, $password, $dbname); // configuration connection with database

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}