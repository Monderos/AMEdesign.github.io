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
<body>-->
<?php
include_once 'navbar.php';
?>

     <section class="signup-form">
     <div class="container signup_form p-1 text-center mx-auto">
     <!-- <div class="bgimg"> 
            <img src="images/background.jpg" class="imgstyle"></img>
</div>-->

          <h2 class="font-rubik white">Sign Up</h2>

          <form autocomplete="off" action="INC/signup.inc.php" method="post">

      <div class="input">
<input autofocus class="input-1 font-rubik dark" type="text" name="name" placeholder="Numele real...">
</div>
<div class="input">
<input class="input-1 font-rubik dark" type="text" name="email" placeholder="Email...">
</div>
<div class="input">
<input class="input-1 font-rubik dark" type="text" name="uid" placeholder="Nume de utilizator...">
</div>
<div class="input">
<input class="input-1 font-rubik dark" type="password" name="pwd" placeholder="Parolă...">
</div>
<div class="input"> 
<input class="input-1 font-rubik dark" type="password" name="pwd_repeat" placeholder="Confirmare parolă...">
</div>
<div class="input">
<button class="input-1 font-rubik" class="rounded-pill py-1 px-2" type="submit" name="submit">Înregistrare</button>
</div>
          </form>
          

<div class="d-flex justify-content-center">
<?php
if(isset($_GET["error"])){
  if($_GET["error"]=="noinput"){
echo "<p class='error'> Completați toate căsuțele... </p>";
  }
else if($_GET["error"]=="invaliduid"){
  echo "<p class='error'> Username incorect... (folosiți doar litere de la a-Z și numere) </p>";
}
else if($_GET["error"]=="invalidemail"){
  echo "<p class='error'> Email incorect... </p>";
}
else if($_GET["error"]=="unmatchedpassword"){
  echo "<p class='error'> Parolele nu sunt la fel.. </p>";
}
else if($_GET["error"]=="usernameoremailtaken"){
  echo "<p class='error'> Username-ul sau email-ul este deja folosit... </p>";
}
else if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="none"){
  echo "<p class='success'> V-ați înregistrat cu succes! </p>";
}
}


?>
</div>
</div>
</section>



</body>
</html>