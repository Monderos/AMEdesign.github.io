


//script stergere tablou
$(document).ready(function () {
    $('.trash_categorie').click(function (e) { 
        e.preventDefault();

        var categId=$(this).val();
        var categNume = this.getAttribute("data-value");
        
        //sweet alert 
        swal({
            title: "Sigur vrei să ștregi categoria '"+categNume+"' cu id-ul '"+categId+"'?",
            text: "Odată șters acesta nu poate fi recuperat!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
             $.ajax({
                 method: "POST",
                 url: "INC/stergere.inc.php",
                 data: {
                     'categId':categId,
                    'trash_categorie':true
                 },
                 success: function (response) {
                     
                     location.reload();

                 }
             });
            } 




          });
    });
});