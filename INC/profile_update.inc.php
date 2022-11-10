
<?php
session_start();

//verificare daca datele au fost prin butonul submit
if(isset($_POST["submit"])){
     $name=$_POST["name"];
     $email=$_POST["email"];
     $username=$_POST["uid"];
     $pwd=$_POST["pwd"];
     $pwdRepeat=$_POST["pwd_repeat"];
     $phone=$_POST["phone"];
     $city=$_POST["city"];
     $address=$_POST["address"];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

//atribuire nume
if($name!=NULL){
    if(tooLong($name) !==false){
        header("location: ../profile_update.php?error=toolong");
        exit();
    }
    $name=$_POST["name"];
    $_SESSION["username"]=$name;
}
else{
    $name=$_SESSION["username"];
}

//atribuire email
if($email!=NULL){
    if(tooLong($email) !==false){
        header("location: ../profile_update.php?error=toolong");
        exit();
    }
    if(invalidEmail($email) !==false){
        header("location: ../profile_update.php?error=invalidemail");
        exit();
    }
    if(emailExistsUpdate($connection, $email) !==false){
        header("location: ../profile_update.php?error=emailtaken");
        exit();
    }
    $email=$_POST["email"];
    $_SESSION["useremail"]=$email;
}
else{
    $email=$_SESSION["useremail"];
}



if($username!=NULL){
    if(tooLong($username) !==false){
        header("location: ../profile_update.php?error=toolong");
        exit();
    }
    if(invalidUid($username) !==false){
        header("location: ../profile_update.php?error=invaliduid");
        exit();
    }
    if(uidExistsUpdate($connection, $username) !==false){
        header("location: ../profile_update.php?error=usernametaken");
        exit();
    }
    $username=$_POST["uid"];
    $_SESSION["useruid"]=$username;
}
else{
    $username=$_SESSION["useruid"];
}

if($pwd!=NULL){
    if(tooLong($name) !==false){
        header("location: ../profile_update.php?error=toolong");
        exit();
    }
    if($pwdRepeat!=NULL){
        if(pwdMatch($pwd,$pwdRepeat) !==false){
                  
            header("location: ../profile_update.php?error=unmatchedpassword");
            exit();
        }
        
    }
    else{
        header("location: ../profile_update.php?error=unmatchedpassword");
        exit();
    }   
    $pwd=$_POST["pwd"];
    $pwd=password_hash($pwd, PASSWORD_DEFAULT,);
}
else{
    $pwd=$_SESSION["userpwd"];
}

if($phone!=NULL){
    if(invalidPhone($phone)!==false){
        header("location: ../profile_update.php?error=invalidphonenumber");
        exit();
    }
    $phone=$_POST["phone"];
    $_SESSION["userphone"]=$phone;
}
else{
    $phone=$_SESSION["phone"];
    
    
}
if($city!=NULL){
    $city=$_POST["city"];
    $_SESSION["usercity"]=$city;
}
else{
    $city=$_SESSION["usercity"];
}

if($address!=NULL){
    $address=$_POST["address"];
    $_SESSION["useraddress"]=$address;
}
else{
    $address=$_SESSION["useraddress"];
}

updateUser($connection,$name,$email,$username,$pwd,$phone,$city,$address);

//updateUid($connection,$username);
}
else{
    header("location: ../index.php");
    exit();
}