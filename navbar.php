<?php
if(!isset($_SESSION["userid"])){
  session_start();
  require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amedesign</title>
    <link rel="stylesheet" href="assets/css/Style_25/style.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/css/alertify.min.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.12.0/build/alertify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="bg-img" style="background-image: url('images/background3.jpg');">
    
    <!-- SECȚIUNE NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark menu shadow fixed-top">
        <div class="container">
          <a class="image" href="index.php">
               <img src="images/logo_2.png" width="180" height="56.7" alt="logo"></a>

               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link a" href="tablouri.php" aria-expanded="false">
                        <span class="font-rubik"> TABLOURI <i class="fa fa-camera-retro"></i></span>
                    </a>
        
                  </li>
                  <li class="nav-item">
                    <a class="nav-link a" href="trimitere.php"><span class="font-rubik">TRIMITERE FIȘIER <i class="fa fa-upload"></i></span></a>
                </li>  
                
                <li class="nav-item">
                    <a class="nav-link a" href="contact.php"><span class="font-rubik">CONTACT <i class="fa fa-phone"></span></i></a>
                    
                  </li>
                  <li class="nav-item">
                    <a class="nav-link a" href="info.php"><span class="font-rubik">DESPRE NOI <i class="fa fa-book" aria-hidden="true"></span></i></a>
                  </li>
              </li>
              <li>
                <form autocomplete="off" enctype="multipart/form-data" action="INC/cautare.inc.php" method="post" class="d-flex">
                  <input class="cautare me-2 dark" name="cauta" id="cauta" type="text" placeholder="Caută tablou.." >
</input>
<a href=""></a>
                  <button class="btn btn-outline-light" name="submit" value="Upload" type="submit">Caută</button>
                </form>
              </li>
              <?php
if(isset($_SESSION["useruid"])){

    include_once 'session_collapse.php';
}
else {
    include_once 'no_session_collapse.php';
}
              ?>
           

              
<?php

$count=countCart($connection);

    foreach($count as $obiectcount){
      $qty=$obiectcount['qty'];
      if($qty==NULL){
        $qty=0;
      }
    }
  
   
?>
 <div class="font-size-12 dark rounded-pill">
               
               <a href="cart.php" class="rounded-pill a">
                 <span class="font-size-16 px-2 text-white"><i class="fa fa-shopping-cart"></i></span>
                 <span class="px-3 py-2 rounded-pill text-white bg-dark count_cart"><?php echo $qty ?></span>
               </a>
         
</div>
            </div>
            
          </div>
          
        </div>
      </nav>