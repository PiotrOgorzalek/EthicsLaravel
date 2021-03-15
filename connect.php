<?php
// allowing  connection
//contains database info

// constatnt cant change later

define('USERNAME','root');
define('PWRD','');
define ('HOSTNAME','localhost');
define('DBNAME', 'ethicsdatabase');

// database connection
//@ supresses error that would show the USERNAME
$conn= @mysqli_connect(HOSTNAME,USERNAME,PWRD,DBNAME) or die("could nont connect to database".mysqli_connect_error())
?>