<?php
session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$cid=$_POST['cid'];
$qty=$_POST['qty'];

$sql="UPDATE cart SET qty='$qty' WHERE cartId='$cid'";
$sql_run=mysqli_query($connection, $sql);
