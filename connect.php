<?php
// allowing  connection
//contains database info

// constatnt cant change later

define('USERNAME','admin');
define('PWRD','Team6P@ssw0rd');
define ('HOSTNAME','localhost');
define('DBNAME', 'ethicsdatabase');
$conn2= new PDO("mysql:host=localhost;dbname=ethicsdatabase","admin","Team6P@ssw0rd");
// database connection
//@ supresses error that would show the USERNAME
$conn= @mysqli_connect(HOSTNAME,USERNAME,PWRD,DBNAME) or die("could nont connect to database".mysqli_connect_error())
?>