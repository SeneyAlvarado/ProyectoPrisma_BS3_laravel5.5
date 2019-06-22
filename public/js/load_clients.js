/**Javascrip to fill the list of clients to create a ne order*/
function listClients(){
    $.ajax({
   url: '/fillnames',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#selectList').empty();
   $('#selectList').append("<option value='defecto'  selected='selected'>Seleccione un cliente</option>");  
   var identification; 
   $.each(datos, function()
   {
    
       $.each(this, function(){
           if(this.identification == null) {
                identification = "No posee";
           } else {
                identification = this.identification;
           }
           if (this.type == 1){
            $('#selectList').append('<option value="' + this.id + '">' + this.id + ". " + identification + " " + this.name + " " + this.lastname + " " + this.second_lastname + '</option>');
           } else {
            $('#selectList').append('<option value="' + this.id + '">' + this.id + ". " + identification + " " + this.name + '</option>');
           }
           
       }) 
       
   })

   }, error:function() {
       alert("¡Ha habido un error! Elija correctamente la sucursal." +
       "Si este error persiste por favor comuníquese con el equipo técnico");   
   }
   });
}

function listClients_contact(){
    $.ajax({
   url: '/fillnames',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#selectList_contact').empty();
   $('#selectList_contact').append("<option value='defecto' selected='selected'>Seleccione un cliente</option>");  
   var identification; 
   $.each(datos, function()
   {
    
       $.each(this, function(){
           if(this.identification == null) {
                identification = "No posee";
           } else {
                identification = this.identification;
           }
           if (this.type == 1){
            $('#selectList_contact').append('<option value="' + this.id + '">' + this.id + ". " + identification + " " + this.name + " " + this.lastname + " " + this.second_lastname + '</option>');
           } 
           
       }) 
       
   })

   }, error:function() {
       alert("¡Ha habido un error! Elija correctamente la sucursal." +
       "Si este error persiste por favor comuníquese con el equipo técnico");   
   }
   });
}


$(document).ready(function(){
    //alert("documentknsddsf");
    listClients();
    listClients_contact();
})


    