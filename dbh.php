<?php

if($_SERVER['SERVER_NAME']=='ordaley.herokuapp.com'){
    $dbServername = "ba1aqmwbfbm7wpxcgmml-mysql.services.clever-cloud.com";
    $dbUsername = "uddluf3qkicdaamn";
    $dbPassword = "iJG3BTYXiXCN7LMYqRwA" ;
    $dbName ="ba1aqmwbfbm7wpxcgmml";
    $conn = mysqli_connect($dbServername, $dbUsername,$dbPassword,$dbName);
    
}
else {
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "" ;
$dbName ="ordaley";
$conn = mysqli_connect($dbServername, $dbUsername,$dbPassword,$dbName);
}
/*
if(!$conn) {
echo "Error";
} 
else {
echo "successful";
} */
?>
