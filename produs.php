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
        <option disabled selected value>-- ram?? --</option>
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
     Adaug?? ??n co??
        
     </button>

     <div class="d-flex flex-column">
     <span class="b "> Pre?? (lei):</span>
     
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
var text="Alege??i un material pentru a ob??ine o descriere.";
$(".descriere_material").text(text);
$(".material").change(function(){
        var materialId=$('.material option:selected').val();
        //super mata
        if(materialId==1){
            var text="Sunt persoane care iubesc imaginea pur??, nealterat?? nici de cel mai mic reflex al luminii ??n mediul ??n care sunt privite. Indiferent de tipul ??i intensitatea ilumin??rii, pe printul pe aceast?? h??rtie super mat?? nu se va vedea nicio reflexie. Trebuie ??tiut c?? pe h??rtia super mat?? culorile ob??inute nu vor fi foarte saturate ??i nici contrastele nu vor putea fi puternice. Acest tip de h??rtie este foarte bine pus ??n valoare de imagini vechi, sepia sau alb negru, dar ??i de imagini color care se doresc u??or estompate.";
$(".descriere_material").text(text);
//metalica
        }
        else if(materialId==2){
            var text="H??rtia metalic?? fotosensibil?? se prezint?? singur??. Nu doar prin numele ei ci ??i prin aplica??iile care o cer de la sine. Fie c?? este vorba de printarea unor imagini care con??in obiecte metalice (ceasuri, bijuterii, ma??ini, etc) fie c?? sunt chiar peisaje suprarealiste sau asumate ca fiind purt??toare ale unor culori ie??ite din comun, h??rtia metalic?? este perfect??. Obiectele din imagine par a fi chiar din aur, din argint sau pur ??i simplu sunt metalizate ??ntr-un mod des??v??r??it.";
$(".descriere_material").text(text);
        }
        else if(materialId==3){
            var text="Mult?? vreme pictura a dominat vizualul prin infinitele ei posibilit????i de exprimare prin culori, tu??e specifice ??i subiecte abordate. Apari??ia fotografiei a determinat acceptarea unanim?? a coexisten??ei celor dou?? tehnici de imortalizare a unor imagini, peisaje, portrete, imagini abstracte sau de atmosfer??. Pictura a fost de multe ori privit?? ca surs?? de inspira??ie ??n fotografie, deseori imit??ndu-se nu doar aspectul pictural al unor imagini ba chiar ??i suportul folosit de c??tre pictori, p??nza, a??a numitul material canvas. Exist?? ??i ??n tehnologia fotografic?? de printare un material fotosensibil numit canvas. Materialul are un aspect rugos, cu o textur?? ce imit?? p??nza de pictur??. O imagine potrivit??, fie c?? e vorba de un peisaj mirific, pictural sau de o reproducere a unei picturi, este extrem de bine pus?? ??n valoare pe acest material.";
$(".descriere_material").text(text);
        }
        else if(materialId==4){
            var text="Fotografii, ??n general, sunt persoane cump??tate. Activi, energici, dar calcula??i ??n ceea ce prive??te afi??area propriilor fotografii. Nu doresc reflexe ale luminii necontrolate pe imagine, doar ei sunt st??p??nii luminii, vr??jitorii care  au creat acele imagini. H??rtia mat?? este foarte apreciat?? de c??tre fotografi (95% dintre fotografi aleg h??rtia mat?? pentru print) pentru c?? le pune mai pu??ine probleme de expunere a tablourilor ??n lumina existent?? ??i nu ??ntotdeauna foarte potrivit?? din expozi??ii, muzee, holurile de a??teptare din diverse institu??ii sau chiar din sufrageria sau dormitorul de acas??. Printul pe h??rtie mat?? nu face niciun compromis ??n redarea corespunz??toare a imaginii, ofer?? un aspect viu al culorilor, a densit????ilor lor ??i a contrastului necesar.";
$(".descriere_material").text(text);
        }
        else if(materialId==5){
            var text="??n publicitate, mai exact ??n aplica??iile care au rolul de a atrage privirea tuturor, suportul lucios este cel mai potrivit. Mai ales dac?? exist?? ??n imagine culori vii, cu aspect sticlos, contraste puternice, defini??ie bun?? a contururilor ??i a detaliilor, un print de calitate va atrage imediat privirea tuturor. H??rtia lucioas?? printat?? ??n tehnologie fotografic?? este tot ce-i trebuie unui brand, pentru a fi puternic sus??inut vizual.";
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
                alertify.warning("Tablou cu acelea??i detalii deja ??n co??!");
            }
            else if(response==1){
                window.location.hash = '0';  
                alertify.error("Selecta??i o op??iune ??n toate c??mpurile!");
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
    		alertify.success("Tablou ad??ugat ??n co??!");
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
   