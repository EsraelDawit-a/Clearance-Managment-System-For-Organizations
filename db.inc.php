<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "clearance";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo 'Could not Connect MySql Server:';

}



function validate($data){
     
	$data = trim($data);
	$data = htmlspecialchars($data);

	return $data;
}
