<?php 
include_once 'navbar.php';
?>
<?php 
require_once '../Licenta/INC/dbh.inc.php';
require_once '../Licenta/INC/functions.inc.php';



?>

<div class="container wrapper_produs">
    
<?php
$id=$_GET["tablou"];
$tablou=getTabelWhereId($connection, "tablou","tablouId", $id); 
$obiect = mysqli_fetch_array($tablou);
$adaos =  $obiect['tablouAdaos'];

?>

<div class="titlu position-relative pb-3 pt-3">
<h1 class="text-center "><?= $obiect['tablouName'];?></h1>
</div>

<div class=" d-flex flex-row bd-highlight mb-3 position-relative">

    <div class="imagine position-relative">

    <img class="imagine_principala" src ="../Licenta/uploads/<?= $obiect['tablouImage']; ?>"
                />
    </div>

        <div class="d-flex flex-column bd-highlight">

     

        <div class="detaliu text-center">
          <span class="b "> Alege:</span>
        <select class="list-group-input material text-center" type="text" name="material">
        <option disabled selected value >-- material --</option>
        <?php
$material=getAll($connection, "tablou_material");

foreach($material as $obiectmaterial){

        echo '<option value="'.
        $obiectmaterial['materialId'].'"data-value="'.$obiectmaterial['materialPrice'].'">' . $obiectmaterial['materialName'] . '</option>';
        $materialPrice=$_POST['material'];
}
?>
</select>
        </div>
 
  
        <div class=" detaliu text-center">
            <br>

        <select class="list-group-input dimensiune text-center" type="text" name="dimensiune">
        <option disabled selected value>-- dimensiune--</option>
        <?php
$dimensiune=getAll($connection, "tablou_dimensiune");

foreach($dimensiune as $obiectdimensiune){
        echo '<option value="'. $obiectdimensiune['dimensiuneId'].'" data-value="'.$obiectdimensiune['dimensiuneIncrement'].'">' . $obiectdimensiune['dimensiuneName'] . '</option>';
}

?> 
</select>
        </div>
    
        <div class="detaliu text-center">
       <br>
        <select class="list-group-input rama text-center" type="text" name="rama">
        <option disabled selected value>-- ramă --</option>
        <?php
$rama=getAll($connection, "tablou_rama");

foreach($rama as $obiectrama){
        echo '<option value="'. $obiectrama['ramaId'].'">' . $obiectrama['ramaName'] . '</option>';
}
?>

</select>

<div class="counter">
      <span class="down" onClick='decreaseCount(event, this)'>-</span>
      <input class="counter" type="text" value="1" readonly>
      <span class="up" onClick='increaseCount(event, this)'>+</span>
    </div>
<!-- <div class="conuter d-flex d-row">
    <i class="fa fa-minus"></i>
    <input type="text" name="quantity" value="0" readonly/>
    <i class=" fa fa-plus"></i> -->
  


</div>

<br>


<div class="descriere2 position-relative border border-primary border-3 rounded overflow-auto px-3">
&emsp;
<span class="font-roboto font-size-14 overflow-auto"><?= $obiect['tablouDesc']; ?></span>




</div>

        <div class="text-center pret d-flex justify-content-between flex-row">


<button class="fa fa-shopping-cart cart" value="<?php echo ($id);?>">   
     Adaugă în coș
        
     </button>

     <div class="d-flex flex-column">
     <span class="b "> Preț (lei):</span>
     
<input class="pret_final text-center dark" placeholder="0" readonly></input>
     
     </div>


     </div>
     </div>   
     </div>





     <div class=" p-3 position-relative">
    <img class="zoom" src ="../Licenta/uploads/<?= $obiect['tablouImage2']; ?>"
                width="100 px" height="100 px"/>
                
                <img class="zoom" src ="../Licenta/uploads/<?= $obiect['tablouImage3']; ?>"
                width="100 px" height="100 px"/>
                <img class="zoom" src ="../Licenta/uploads/<?= $obiect['tablouImage4']; ?>"
                width="100 px" height="100 px"/>
                <img class="zoom" src ="../Licenta/uploads/<?= $obiect['tablouImage5']; ?>"
                width="100 px" height="100 px"/>
                <img class="zoom" src ="../Licenta/uploads/<?= $obiect['tablouImage6']; ?>"
                width="100 px" height="100 px"/>

    </div>

<div class="desc-mat  px-3">

    <h3 class="b position-relative">Descriere material: </h3>
    &emsp;
<span class="descriere_material position-relative"></span>

</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">


//script counter
var adaos=<?php echo $adaos; ?>;
   counter=1;
function increaseCount(a, b) {
        var input = b.previousElementSibling;
        var value = parseInt(input.value, 10);
        value = isNaN(value)? 0 : value;
        value ++;
        input.value = value;
        counter=value;
        $('.pret_final').val(((adaos + (window.materialPret  *  window.dimensiuneIncrement)).toFixed()*counter));
      }
      function decreaseCount(a, b) {
        var input = b.nextElementSibling;
        var value = parseInt(input.value, 10);
        if (value > 1) {
          value = isNaN(value)? 0 : value;
          value --;
          input.value = value;
          counter=value;
          $('.pret_final').val(((adaos + (window.materialPret  *  window.dimensiuneIncrement)).toFixed()*counter)); 
        }
      }


$(document).ready(function() {


   
    
//script pentru ID material

    $(".material").change(function(){
        var materialId=$('.material option:selected').val();
        var materialPret=$('option:selected',this).data("value");
        window.materialPret=materialPret;
        window.materialId=materialId;
 
        //script pentru calcularea pretului
        
//de adaugat un if


$('.pret_final').val(((adaos + (window.materialPret  *  window.dimensiuneIncrement)).toFixed()*counter));

    });

    //script pentru ID dimensiune
    $(".dimensiune").change(function(){
        var dimensiuneId=$('.dimensiune option:selected').val();
        var dimensiuneIncrement=$('option:selected',this).data("value");
        window.dimensiuneIncrement=dimensiuneIncrement;
        window.dimensiuneId=dimensiuneId;
        //script pentru calcularea pretului
        
$('.pret_final').val(((adaos + (window.materialPret  *  window.dimensiuneIncrement)).toFixed()*counter));    
    });

//script schimbare counter pret



//script pentru ID rama
    $(".rama").change(function(){
        var ramaId=$('.rama option:selected').val();
        

    });

//script schimbare text
var text="Alegeți un material pentru a obține o descriere.";
$(".descriere_material").text(text);
$(".material").change(function(){
        var materialId=$('.material option:selected').val();
        //super mata
        if(materialId==1){
            var text="Sunt persoane care iubesc imaginea pură, nealterată nici de cel mai mic reflex al luminii în mediul în care sunt privite. Indiferent de tipul și intensitatea iluminării, pe printul pe această hârtie super mată nu se va vedea nicio reflexie. Trebuie știut că pe hârtia super mată culorile obținute nu vor fi foarte saturate și nici contrastele nu vor putea fi puternice. Acest tip de hârtie este foarte bine pus în valoare de imagini vechi, sepia sau alb negru, dar și de imagini color care se doresc ușor estompate.";
$(".descriere_material").text(text);
//metalica
        }
        else if(materialId==2){
            var text="Hârtia metalică fotosensibilă se prezintă singură. Nu doar prin numele ei ci și prin aplicațiile care o cer de la sine. Fie că este vorba de printarea unor imagini care conțin obiecte metalice (ceasuri, bijuterii, mașini, etc) fie că sunt chiar peisaje suprarealiste sau asumate ca fiind purtătoare ale unor culori ieșite din comun, hârtia metalică este perfectă. Obiectele din imagine par a fi chiar din aur, din argint sau pur și simplu sunt metalizate într-un mod desăvârșit.";
$(".descriere_material").text(text);
        }
        else if(materialId==3){
            var text="Multă vreme pictura a dominat vizualul prin infinitele ei posibilități de exprimare prin culori, tușe specifice și subiecte abordate. Apariția fotografiei a determinat acceptarea unanimă a coexistenței celor două tehnici de imortalizare a unor imagini, peisaje, portrete, imagini abstracte sau de atmosferă. Pictura a fost de multe ori privită ca sursă de inspirație în fotografie, deseori imitându-se nu doar aspectul pictural al unor imagini ba chiar și suportul folosit de către pictori, pânza, așa numitul material canvas. Există și în tehnologia fotografică de printare un material fotosensibil numit canvas. Materialul are un aspect rugos, cu o textură ce imită pânza de pictură. O imagine potrivită, fie că e vorba de un peisaj mirific, pictural sau de o reproducere a unei picturi, este extrem de bine pusă în valoare pe acest material.";
$(".descriere_material").text(text);
        }
        else if(materialId==4){
            var text="Fotografii, în general, sunt persoane cumpătate. Activi, energici, dar calculați în ceea ce privește afișarea propriilor fotografii. Nu doresc reflexe ale luminii necontrolate pe imagine, doar ei sunt stăpânii luminii, vrăjitorii care  au creat acele imagini. Hârtia mată este foarte apreciată de către fotografi (95% dintre fotografi aleg hârtia mată pentru print) pentru că le pune mai puține probleme de expunere a tablourilor în lumina existentă și nu întotdeauna foarte potrivită din expoziții, muzee, holurile de așteptare din diverse instituții sau chiar din sufrageria sau dormitorul de acasă. Printul pe hârtie mată nu face niciun compromis în redarea corespunzătoare a imaginii, oferă un aspect viu al culorilor, a densităților lor și a contrastului necesar.";
$(".descriere_material").text(text);
        }
        else if(materialId==5){
            var text="În publicitate, mai exact în aplicațiile care au rolul de a atrage privirea tuturor, suportul lucios este cel mai potrivit. Mai ales dacă există în imagine culori vii, cu aspect sticlos, contraste puternice, definiție bună a contururilor și a detaliilor, un print de calitate va atrage imediat privirea tuturor. Hârtia lucioasă printată în tehnologie fotografică este tot ce-i trebuie unui brand, pentru a fi puternic susținut vizual.";
$(".descriere_material").text(text);
        }
     
        
    });

    
});

$('.cart').click(function (e) { 
    e.preventDefault();
   var material= $(".material").val();
   var dimensiune= $(".dimensiune").val();
   var rama=$(".rama").val();
   var qty=counter;
   var pret_qty1=(adaos+(window.materialPret *  window.dimensiuneIncrement)).toFixed();

    var id=$(this).val();
   
    $.ajax({
        method: "POST",
        url: "INC/cart.inc.php",
        data: {
"pret_qty1":pret_qty1,
            "tablouId": id,
            "materialId":material,
            "dimensiuneId": dimensiune,
            "ramaId": rama,
             "qty": qty,
             "scope":"add"
        },
        success: function (response) {
            if(response==3){
           
                        
                window.location.hash = 'reload';          
                location.reload(true);     
                    
            }
            else if(response==2){
                window.location.hash = '0';  
                alertify.warning("Tablou cu aceleași detalii deja în coș!");
            }
            else if(response==1){
                window.location.hash = '0';  
                alertify.error("Selectați o opțiune în toate câmpurile!");
            }
            else if(response==0){
                window.location.hash = '0';  
                window.location.href='signup.php';
                
            }
        }
    });
  
    
});

document.addEventListener("DOMContentLoaded", function(event) { 
    	if(window.location.hash == "#reload"){
    		alertify.success("Tablou adăugat în coș!");
            window.location.hash = '0';  
    	}
    });









//     $(document).on('change', '.material', function(){



//         console.log("material changed");

//         var mat_id=$(this).val();
//         console.log("mat_id");
//     })
//   });


    </script>
   

<?php 
include_once 'footer.php';
   