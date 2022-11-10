<?php

$serverName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="amedesign";

$connection = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if(!$connection){
    die("Connection failed: ".mysqli_connect_error());
}