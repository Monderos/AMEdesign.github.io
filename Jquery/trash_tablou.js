//script stergere tablou
$(document).ready(function () {
    $('.trash_tablou').click(function (e) { 
        e.preventDefault();


        var tablouId=$(this).val();
        var tablouNume=this.getAttribute("data-value");
        //sweet alert 
        swal({
            title: "Sigur vrei să ștregi tabloul '"+tablouNume+"' cu id-ul '"+tablouId+"'?",
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
                     'tablouId':tablouId,
                    'trash_tablou':true
                 },
                 success: function (response) {
                     
                     location.reload();

                 }
             });
            } 




          });
    });
});