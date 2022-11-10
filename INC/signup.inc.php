<?php
//verificare daca datele au fost prin butonul submit
if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $username=$_POST["uid"];
    $pwd=$_POST["pwd"];
    $pwdRepeat=$_POST["pwd_repeat"];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';



//verificare daca toate casutele sunt completate
if(emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !==false){
    header("location: ../signup.php?error=noinput");
    exit();
}
//verificare username pentru caractere interzise
if(invalidUid($username) !==false){
    header("location: ../signup.php?error=invaliduid");
    exit();
}
//verificare email
if(invalidEmail($email) !==false){
    header("location: ../signup.php?error=invalidemail");
    exit();
}
//verificare pwd=pwdRepeat
if(pwdMatch($pwd, $pwdRepeat) !==false){
    header("location: ../signup.php?error=unmatchedpassword");
    exit();
}
//verificare valabilitate username si email
if(uidExists($connection, $username, $email) !==false){
    header("location: ../signup.php?error=usernameoremailtaken");
    exit();
}

createUser($connection, $name, $email, $username, $pwd);
}

//trimitere inapoi daca userul nu a intrat prin butonul din form
else{
    header("location: ../signup.php");
    exit();
}