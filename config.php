<?php
// MySQL database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "genericlaptop";

$con = mysqli_connect($hostname, $username, $password, $dbname)
or die("Kan niet verbinden met de database!");
mysqli_set_charset($con, 'utf8');
?>