<?php

include_once 'navbar.php';

require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
?>

<div class="page p-3 container">

<p class="paragraph">Pentru a primii o ofertă de preț pentru un tablou a unei imagini personale,
atașați imaginea și detalii (dimensiunea, tipul materialului, ramă...) în formularul de mai jos.
În cel mai scurt timp o să fiți contactați de un reprezentat AME design pentru a stabili detaliile.
Dacă aveți mai multe imagini, contactați-ne direct prin secțiunea "CONTACT". </p>
</div>

<section class="_insert">
<div class="d-flex justify-content-center insert2">

<form autocomplete="off" action="INC/trimitere.inc.php" method="post" enctype="multipart/form-data" class="list-group">
    
<div class="d-flex justify-content-center">


    </div>
    <div style="border-radius: 5px;">
    <div class="d-flex justify-content-center">
    <?php
if(isset($_GET["error"])){
if($_GET["error"]=="noinputfile"){
  echo "<p class='error'> Trebuie să introduceți un fișier! </p>";
}
else if($_GET["error"]=="noinputdetalii"){
  echo "<p class='error'> Nu lăsasați câmpul cu detalii gol! </p>";
}
else if($_GET["error"]=="none"){
  echo "<p class='success'> Ați trimis cu succes fișierul! O să fiți contactat în cel mai scurt timp! </p>";
}
else if($_GET["error"]=="nouser"){
  echo "<p class='error'> Înregistrați-vă cu un cont mai întâi! </p>";
}

}
?>
 </div>

<div class="font-rubik b list-group-item">
Imagine:
  <input class="list-group-input" type="file" name="file" placeholder="...">
</div>
<div class="font-rubik b list-group-item">
Detalii (max 250 caractere):
<textarea class="descriere" type="text" name="detalii" maxlength="250"></textarea>
</div>
  <li class="list-group-item d-flex" >
  
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
