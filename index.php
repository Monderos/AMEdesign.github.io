<?php

include_once 'navbar.php';
?>
<?php
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
?>

<br>
<br>
<br>
<br>
<br>
<div class="container d-flex align-items-center justify-content-center carousel-dim">
<div id="carouselExampleDark" class="carousel carousel-dark slide carousel-dim" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="3000">
      <img src="../Licenta/images/carousel_1.1.png" class="d-block w-100" alt="">
      <div class="carousel-caption d-none d-md-block">
        <h5>Tablouri de înaltă calitate</h5>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="3000">
      <img src="../Licenta/images/carousel_2.2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
  
      </div>
    </div>
    <a href="trimitere.php">
    <div class="carousel-item">
      <img src="../Licenta/images/carousel_3.2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
       
       
      </div>
      </a>
    </div>
    
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>
      <section id="main ">

      
      <div class="p-3 container">
   
    <div class="p-3 ">
<span class="black">
<p class="paragraph"> În anul 2003 am adus pe piața românească un unic echipament,
       Durst Lambda. Unic prin calitatea și performanțele de print 
       foto de mari dimensiuni, realizând printuri fotografice de o inegalată calitate.

Am considerat însă că acest lucru nu este suficient și am adăugat o 
valoare acestor performanțe tehnice prin alegerea unei echipe de producție
 dar și de vânzări care să merite același superlativ ca cel al printului de
  foarte bună calitate. Cu ajutorul lor am reușit să furnizăm printuri foto 
  de cea mai bună calitate, doar printuri pe hârtie super mată, printuri pe hârtie
   mată, hârtie lucioasă, hârtie metalică, printuri pe canvas sau film pentru casete
    luminoase (renumitul duratrans) sau finalizate sub formă de tablouri canvas 
    (tip pictură pe canvas). </p>
</br>
     <p class="paragraph">
 
Ne adresăm tuturor fotografilor care-și doresc imaginile transformate în tablouri
foto de calitate, pentru expoziții personale, de grup sau doar pentru a face un 
cadou unor persoane dragi, un tablou personalizat, numai bun de pus pe peretele
 de acasă sau de la serviciu. De asemenea, ne adresăm și celor care doar vor un tablou de pus pe perete, în cameră sau la birou.
 Site-ul nostru are nenumărate imagini, unele de la pictori faimoși, altele de la fotografi extrem de talentați și sunt adăugate săptămânal
 imagini noi! 
</p>
        
</span>
<div style="text-align: center;">
<p style="text-align: justify;">&nbsp;</p>
<!-- <hr style="border-color: #c21b1e !important; border: 2px solid; width: 28%; display: inline-block; box-shadow: 0px 2px 5px -1px #000000; margin: 3px;"><hr style="border-color: #0d9044 !important; border: 2px solid; width: 28%; display: inline-block; box-shadow: 0px 2px 5px -1px #000000; margin: 3px;"><hr style="border-color: #093278 !important; border: 2px solid; width: 28%; display: inline-block; box-shadow: 0px 2px 5px -1px #000000; margin: 3px;"> -->
<p style="text-align: center;"><br><br></p>
</div>
    </div>
      </div>
            
          
        </section>

      <!-- FOOTER -->
      <?php
      include_once 'footer.php';
      ?>
