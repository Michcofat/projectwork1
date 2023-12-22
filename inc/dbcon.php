<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "projectwork";  // the name use in creating the data base in mysqli.

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {

    die("Connection Failed: " . mysqli_connect_error());
}
?>