<?php
include_once "navbar.php";
if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}
?>

<?php

?>


<section class="_profile">
<div class="d-flex justify-content-center profile">



<form autocomplete="off" action="INC/profile_update.inc.php" method="post" class="list-group">
    
<div class="d-flex justify-content-center">
<?php
if(isset($_GET["error"])){
 if($_GET["error"]=="invaliduid"){
  echo "<p class='error'> Username incorect... (folosiți doar litere de la a-Z și numere) </p>";
}
 if($_GET["error"]=="invalidphonenumber"){
  echo "<p class='error'> Număr de telefon incorect...</p>";
}
else if($_GET["error"]=="invalidemail"){
  echo "<p class='error'> Email incorect... </p>";
}
else if($_GET["error"]=="unmatchedpassword"){
  echo "<p class='error'> Parolele nu sunt la fel.. </p>";
}
else if($_GET["error"]=="emailtaken"){
  echo "<p class='error'> Email-ul este deja folosit... </p>";
}
else if($_GET["error"]=="usernametaken"){
    echo "<p class='error'> Username-ul este deja folosit... </p>";
  }
else if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="toolong"){
  echo "<p class='error'> Introduceți date valide... </p>";
}
else if($_GET["error"]=="emptyData"){
  echo "<p class='error'> Intodueți-vă toate datele pentru a putea comanda! </p>";
}
else if($_GET["error"]=="none"){
  echo "<p class='success'> Schimbările au fost realizate cu succes! </p>";
}
}
?>
    </div>
    <div style="border-radius: 5px;">
<div class="font-rubik b list-group-item">
Numele: 
<input class="list-group-input" type="text" name="name" placeholder="<?php echo $_SESSION["username"]; ?>">
</div>


<div class="font-rubik b list-group-item">
Username:
<input class="list-group-input" type="text" name="uid" placeholder="<?php echo $_SESSION["useruid"]; ?>">
</div>

<div class="font-rubik b list-group-item">
Email:
  <input class="list-group-input" type="text" name="email" placeholder="<?php echo $_SESSION["useremail"]; ?>">
</div>

<div class="font-rubik b list-group-item">
    Telefon:
  <input class="list-group-input" type="text" name="phone" placeholder="<?php echo $_SESSION["userphone"]; ?>">
</div>

<div class="font-rubik b list-group-item">
Oraș/Sector:
<select class="list-group-input" type="text" name="city">
<option value="" disabled selected><?php echo $_SESSION["usercity"]; ?></option>
<option value ="Bucuresti">Bucuresti 
</option>
<option value ="Cluj-Napoca">Cluj-Napoca
</option>
<option value ="Timisoara">Timisoara
</option>
<option value ="Iasi">Iasi
</option>
<option value ="Constanta">Constanta
</option>
<option value ="Craiova">Craiova
</option>
<option value ="Brasov">Brasov
</option>
<option value ="Galati">Galati
</option>
<option value ="Ploiesti">Ploiesti
</option>
<option value ="Oradea">Oradea
</option>
<option value ="Braila">Braila
</option>
<option value ="Arad">Arad
</option>
<option value ="Pitesti">Pitesti
</option>
<option value ="Sibiu">Sibiu
</option>
<option value ="Bacau">Bacau
</option>


</select>
</div>

<div class="font-rubik b list-group-item">
Adresă:
  <input class="list-group-input" type="text" name="address" placeholder="<?php echo $_SESSION["useraddress"]; ?>">
</div>

<div class="font-rubik b list-group-item">
Parolă nouă:
  <input class="list-group-input" type="password" name="pwd"placeholder="*******">
</div>

<div class="font-rubik b list-group-item">
Confirmare parolă nouă:
  <input class="list-group-input" type="password" name="pwd_repeat" placeholder="*******">
</div>

  <li class="list-group-item d-flex" >
  <a href="profile.php">
  <button type=button action="profile.php" class="fa fa-arrow-left">
  </button>
</a>  


    <button class="fa fa-save lm" type="submit" name="submit">   
     
        
    </button>
    
</li>
        
    </div>
    </form>
  
</div>
    
   
</section>

<?php
include_once 'footer.php';
?>

