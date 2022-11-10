<?php
include_once('../INC/dbh.inc.php');
include_once('../INC/functions.inc.php');

if(isset($_POST['submit_filter'])){

if(isset($_POST['isFinalized']))
{

   
}
if(($_POST['Name']))
    {
        $Name=$_POST['Name'];
        $name=true;
      
    }



if($name){
    header("location: ../raport_users.php?&name=$Name");
    exit();
}

else{
    header("location: ../raport_users.php");
exit();
}

}




else
{
header("location: ../index.php");
exit();
}