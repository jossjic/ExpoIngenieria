<?php


$dbhost = "Localhost";
$dbuser = "TC2005B_401_5";
$dbpass = "b#-ap+E4ru97?STi";
$dbname = "TC2005B_401_5";


$conn= mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (!$conn)
{
   die("NO hay conexión: ".mysqli_connect_error());
}



?>
