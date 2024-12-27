<?php

//versi buat docker
// db_connect.php
$hostname = "dbserver";
$username = "root";  // sesuaikan dengan username database Anda
$password = "rootpassword";      // sesuaikan dengan password database Anda
$database_name = "ecoshopper"; // nama database Anda

$db = mysqli_connect($hostname, $username, $password, $database_name);

if ($db->connect_error) {
    echo "koneksi database rusak";
}

//versi xampp
//$hostname = "localhost"
//$username = "root";  // sesuaikan dengan username database Anda
//$password = "";      // sesuaikan dengan password database Anda
//$database_name = "ecoshopper"; // nama database Anda

//$db = mysqli_connect($hostname, $username, $password, $database_name);

//if ($db->connect_error) {
//    echo "koneksi database rusak";
//}



?>

