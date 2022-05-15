<?php
$_ENV["dbhost"] = "localhost";
$_ENV['dbuser'] = "root";
$_ENV['dbpass'] = "";
$_ENV['dbname'] = "2022_sijual";
$koneksi = mysqli_connect($_ENV['dbhost'],$_ENV['dbuser'],$_ENV['dbpass'],$_ENV['dbname']);

// Check connection
if (!$koneksi) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>