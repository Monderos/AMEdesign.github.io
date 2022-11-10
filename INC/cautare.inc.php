<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if($_POST['cauta']!=""){
    $cauta=$_POST['cauta'];
    header("location: ../tablouri.php?name=$cauta");
exit();

}
else{
    header("location: ../tablouri.php");
    exit();
}





