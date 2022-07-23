<?php

if($_SERVER['SERVER_NAME']=='evento-apis.herokuapp.com'){
    $dbServername = "brsraa3qybidohuky0fg-mysql.services.clever-cloud.com";
    $dbUsername = "uezoprczfgvgbfe9";
    $dbPassword = "ueBaZglJuFR20eDqiLJ8" ;
    $dbName ="brsraa3qybidohuky0fg";
    $conn = mysqli_connect($dbServername, $dbUsername,$dbPassword,$dbName);
    
}
else {
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "" ;
$dbName ="eventbackend";
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
