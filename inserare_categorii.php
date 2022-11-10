<?php 
include_once 'navbar_admin.php';
?>

<?php 
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
?>


<section class="_insert">
<div class="d-flex justify-content-center insert">

<form autocomplete="off" action="INC/insert.inc.php" method="post" enctype="multipart/form-data" class="list-group">
    
<div class="d-flex justify-content-center">

<?php
if(isset($_GET["error"])){
if($_GET["error"]=="failure"){
  echo "<p class='error'> Ceva nu a funcționat... Încercați din nou.. </p>";
}
else if($_GET["error"]=="noinput"){
  echo "<p class='error'> Inserați o categorie! </p>";
}
else if($_GET["error"]=="categorietaken"){
    echo "<p class='error'> Categoria există deja! </p>";
  }

else if($_GET["error"]=="none"){
  echo "<p class='success'> Ați adăugat cu succes categoria! </p>";
}
}
?>
    </div>
    <div style="border-radius: 5px;">
<div class="font-rubik b list-group-item ">
Inserare:
<select class="list-group-input" type="text" name="tip" onchange="window.location=this.value">

<option value ="inserare_categorii.php">Categorie 
</option>

<option value ="inserare_tablouri.php">Tablou 
</option>





</select>
</div>

<div class="font-rubik b list-group-item">
Categorie nouă:
  <input class="list-group-input" type="text" name="categorie" placeholder="...">
</div>

  <li class="list-group-item d-flex" >
  <a href="admin_index.php">
  <button type=button action="admin_index.php" class="fa fa-arrow-left">
  </button>
</a>  


    <button class="fa fa-upload lm" type="submit" name="submit" value="Upload">   
     
        
    </button>
    
</li>
        
    </div>
    </form>
  
</div>
    
   
</section>



<?php

include_once 'footer.php';
?>



