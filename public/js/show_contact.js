/**This method is in charge to fill the contact information of one order
 *the param id is the identification of the client to be serach in the BD
 *this ajax use the controller ClientController and the method ajax_contact 
*/
function infoContact(id){
    var name = "";
    var address = "";
    var identification = ""; 
    var email = "";
    var phone = "";
    $.ajax({
        url: '/contact.show/' + id,
        type: 'GET',
        dataType: "json",
        success:function(datos){
            var myJSON = JSON.stringify(datos);
            $.each(datos, function()
            {
                if(this.type == 1){
                    name = this.name + " " + this.lastname + " " + this.second_lastname;
                } else {
                    name = this.name; 
                }
                address = this.address;
                identification = this.identification;
                phone = this.phone;
                email = this.email;
                $("input[name=identification]").val(identification);
                $("input[name=name]").val(name);
                $("input[name=phone]").val(phone);
                $("input[name=email]").val(email);
                $("textarea[name=address]").val(address);
                $("#modalContact").modal('show'); 
            })
        }, error:function() {
            alert("¡Ha habido un error al cargar la información del cliente!" +
            "Si este error persiste por favor comuníquese con el equipo técnico");   
        }
        }); 
         
} 