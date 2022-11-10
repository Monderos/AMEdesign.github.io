<!-- <!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amedesign</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
-->
<?php
include_once 'navbar.php';
?>
     <section class="login-form">
     <div class="container signup_form p-1 text-center mx-auto">
     <!-- <div class="bgimg"> 
            <img src="images/background.jpg" class="imgstyle"></img>
</div>-->

          <h2 class="font-rubik white">Log In</h2>

          <form autocomplete="off" action="INC/login.inc.php" method="post">
          

<div class="input ">
<input autofocus class="input-1 dark" type="text" name="uid" placeholder="Nume utilizator/Email...">
</div>

<div class="input ">
<input class="input-1 dark" type="password" name="pwd" placeholder="Parolă...">
</div>

<div class="input">
<button class="input-1" type="submit" name="submit">Conectare</button>
</div>
          </form>
          
          <div class="d-flex justify-content-center">
<?php
if(isset($_GET["error"])){
  if($_GET["error"]=="noinput"){
echo "<p class='error'> Completați toate căsuțele... </p>";
  }
else if($_GET["error"]=="incorrectUser"){
  echo "<p class='error'> Username/Email inexistent... </p>";
}
else if($_GET["error"]=="incorrectPwd"){
  echo "<p class='error'> Parolă incorectă... </p>";
}

}
?>
</div>

</div>
</section>


</body>

</html>