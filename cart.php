<?php 

include_once 'navbar.php';

require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';

?>

<section class="margin-top container text-center mx-auto " >

<div class="d-flex flex-column cart_container container text-center p-3 ">
                 
<!-- <form action="index.php" method="post"> -->
                  <?php
$total="total";

if(isset($_GET["error"])){
  if($_GET["error"]=="sql"){
  echo "<p class='position-relative error'> Ceva nu a funcționat! </p>";
 }
 else if($_GET["error"]=="sqldelete"){
  echo "<p class='position-relative success> (sql)Ați făcut comanda cu succes! O să vă contactăm cât mai devreme pentru a stabili metoda de plată! </p>";
}
 else if($_GET["error"]=="none"){
  echo "<p class='position-relative success'> Ați făcut comanda cu succes! O să vă contactăm cât mai devreme pentru a stabili metoda de plată! </p>";
}
}
if(isset($_SESSION['auth']))
{

        $cart=getCart($connection);

        if(mysqli_num_rows($cart)>0)
        {

          ?>
           <div class="">
                    <h1 class="fw-bold mb-0 white position-relative">Tablouri în coș:</h1>
                   
                  </div>
              <?php

            foreach($cart as $obiect){
        ?>
                  <hr class="my-4">
<div class="lista-cart flex-row  pt-3 p-3 text-center mx-auto">
                    <div class="text-center mx-2">
                      <img
                        src="uploads/<?= $obiect['tablouImage'];?>"
                        width="150 px" height="100 px"
                        class="mb-3" alt="<?= $obiect['tablouName'];?>">
                        <h6 class="primary b"><?= $obiect['tablouAutor'];?> - <?= $obiect['tablouName'];?></h6>
                        <hr class="my-4">
                    </div>
                    
                    <span class="white text-center"> Cantitate: </span>
                    
                   
                    <div class="counter text-start">
                      
      <span class="down <?= "d".$obiect['cid'];?>" name="<?= "d".$obiect['cid'];?>">-</span>
      <input class="counter2 <?= "c".$obiect['cid'];?>" type="text" value="<?= $obiect['qty'];?>" readonly>
      <span class="up <?= "u".$obiect['cid'];?>" name="<?= "u".$obiect['cid'];?>">+</span>
    </div>
                  
                    <div class="">
                      <h6 class="white">Material: <span class="b"><?= $obiect['materialName'];?></span></h6>
                      <h6 class="white">Dimensiune: <span class="b"> <?= $obiect['dimensiuneName'];?></span></h6>
                      <h6 class="white">Ramă: <span class="b"><?= $obiect['ramaName'];?></span></h6>
                      <h6 class="white">Preț (lei):</h6>
                      <input readonly class="text-center dark pret_cart a<?= $obiect['cid'];?>" name="a<?= $obiect['cid'];?>" id="<?= $obiect['cid'];?>"
                       value="<?=sprintf('%.0F',($obiect['pret_qty1']*$obiect['qty']))
                       
                      ?>">
                    
                    </input>
                
                     <div class="float-end">
                     <form action="INC/delete_cart.inc.php" method="get">
                     <button type="submit" name="id" value="<?= $obiect['cid'];?>" class="fa fa-trash">
                     </button>
                     </form>
                     </div>
                     <?php




                     echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                     <script type="text/javascript">
                     
                    
                        
                      $(".u'.$obiect['cid'].'").click(function() {
                 

                       var v'.$obiect['cid'].'='.$obiect['pret_qty1'].';
                       var c'.$obiect['cid'].'=$(".c'.$obiect['cid'].'").val();
                             
                       c'.$obiect['cid'].' ++;
                             
                             $(".c'.$obiect['cid'].'").val(c'.$obiect['cid'].');
                             $(".'."a".$obiect['cid'].'").val((v'.$obiect['cid'].'*c'.$obiect['cid'].'));
                             
                             $.ajax({
                              url: "INC/countupdate.inc.php",
                              method: "post",
                              dataType: "json",
                              data: {
                                cid: "'.$obiect['cid'].'",
                                qty: c'.$obiect['cid'].'
                              }
                              
                           })
                          })
                          
                           $(".d'.$obiect['cid'].'").click(function() {
                      

                            var v'.$obiect['cid'].'='.$obiect['pret_qty1'].';
                            var c'.$obiect['cid'].'=$(".c'.$obiect['cid'].'").val();     
                             if (c'.$obiect['cid'].' > 1) {
                              c'.$obiect['cid'].' --;
                              $(".c'.$obiect['cid'].'").val(c'.$obiect['cid'].');
                              $(".'."a".$obiect['cid'].'").val((v'.$obiect['cid'].'*c'.$obiect['cid'].'));
                              
                              $.ajax({
                                url: "INC/countupdate.inc.php",
                                method: "post",
                                dataType: "json",
                                data: {
                                  cid: "'.$obiect['cid'].'",
                                  qty: c'.$obiect['cid'].'
                                }
                                
                             })
                             }
                           })
                           </script>
                       </script>';
    
                     ?>
                      
                    </div>
                    
                    
</div>


                  <?php
            }
       
        ?>
  
  <div class="d-flex justify-content-between mx-3 px-2">

  <div>
  <h2 class="b white position-relative mx-3 ">Preț total:</h2>
  <input readonly class="total position-relative text-center dark" id="" value="0"> </input>
  
  </div>
  <div>
    <a href="INC/comanda.inc.php">
    <button class="mx-3 px-2 text-center position-relative bg-success m-5 rounded-top" type="submit" value="upload"
     name="submit" >Plasează comanda</button>
    </a>
  </div>
  </div>
<!-- </form> -->
  </div>
 
<script type="text/javascript">

$(document).ready(function(){
  var sum = 0;

$('input[name^="a"]').each(function(){
    sum += parseFloat(this.value);
    $(".total").val(sum);
});
});


$('span[name^="d"]').click(function() {
 //update total
 var sum = 0;
 $('input[name^="a"]').each(function(){
  sum += parseFloat(this.value);
 $(".total").val(sum);
});  
})

$('span[name^="u"]').click(function() {
 //update total
 var sum = 0;
 $('input[name^="a"]').each(function(){
  sum += parseFloat(this.value);
 $(".total").val(sum);
});  
})



  </script>
</div>
      
            </div>
            <?php
          }
          else{
            ?>

            <div class="lista-cart flex-row  pt-3 p-3 text-center mx-auto">
              <span class="white"> Niciun tablou în coș</span>
            </div>
              <?php
          }
        }
        else{
          ?>
          <div class="lista-cart flex-row  pt-3 p-3 text-center mx-auto">
              <span class="white"> Înregistrați-vă pentru a utiliza coșul</span>
            </div>
            <?php
        }
        ?>

           
</section>
<?php
include_once 'footer.php';
?>
