/**Javascrip to fill the list of clients to create a ne order*/
function listClients(){
    $.ajax({
   url: '/fillnames',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#selectList').empty();
  //alert(JSON.stringify(datos));
   var identification; 
   $.each(datos, function()
   {
       $.each(this, function(){
            $('#selectList').append('<option value="' + this.id + '">' + this.id + ". " + this.identification + " " + this.name + this.phone + " " + this.email + '</option>');  
       }) 
       
   })

   }, error:function() {
       alert("¡Ha habido un error! al cargar el cliente." +
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
   
   $.each(datos, function()
   {
       $.each(this, function(){  
            $('#selectList_contact').append('<option value="' + this.id + '">' + this.id + ". " + this.identification + " " + this.name  + '</option>'); 
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



/**Javascrip to fill the list of clients to create a ne order*/
function listClientsTable(){
    
    $.ajax({
   url: '/fillnames',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 

   var table = $('#tableClients').DataTable();
   table.clear().draw();
   $.each(datos, function()
   {
       $.each(this, function(){
        selectbtn = 
        '<a onClick="fillDataOwnerClient(\'' + this.id + '\',\'' + this.name + '\',\'' + this.identification + '\',\'' + this.phone + '\',\'' + this.email + '\')"  class="btn btn-warning style-btn-edit btn-sm" style="width:95px;">Seleccionar</a>';
        table.rows.add(
            [[this.id, this.identification, this.name, this.phone, selectbtn]]
        ).draw();
           
       }) 
       
   })

   }, error:function() {
       alert("¡Ha habido un error! al cargar la lista de clientes en la tabla");   
   }
   });
   $("#table-clients").modal('show');
}


function fillDataOwnerClient(id, name, identification, phone, email){
    $("#client_name").empty();
    $("#identification").empty();
    $("#phone").empty();
    $("#email").empty();
    $("#client_name").append(name);
    $("#identification").append(identification);
    $("#phone").append(phone);
    $("#email").append(email);
    document.getElementById("hideId").style.display = "block";
    document.getElementById("hidePhone").style.display = "block";
    document.getElementById("hideEmail").style.display = "block";
    document.getElementById("hide_quotation").style.display = "block";
    document.getElementById("hide_money").style.display = "block";
    document.getElementById("hide_money").style.marginLeft = "1px";
    document.getElementById("hide_advancement").style.display = "block";
    document.getElementById("hide_total").style.display = "block";
    $("#table-clients").modal('hide');
}


    