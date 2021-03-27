<?php
// allowing  connection
//contains database info

// constatnt cant change later

define('USERNAME','root');
define('PWRD','');
define ('HOSTNAME','localhost');
define('DBNAME', 'ethicsdatabase');
//for creating tables for application and staff
$conn2= new PDO("mysql:host=localhost;dbname=ethicsdatabase","admin","Team6P@ssw0rd");

// database connection
//@ supresses error that would show the USERNAME
$conn= @mysqli_connect(HOSTNAME,USERNAME,PWRD,DBNAME) or die("could nont connect to database".mysqli_connect_error())
?>
