function loadMaterials(){
    $.ajax({
   url: '/fillmaterials',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#origen').empty();
   $('#origen').append("<option value='defecto' selected='selected'>Seleccione un material</option>");  
   $.each(datos, function()
   {
       $.each(this, function(){
            $('#origen').append('<option value="' + this.id + '">' + this.id + ". " + this.name  + '</option>'); 
       })  
   })

   }, error:function() {
       alert("¡Ha habido un error al cargar los materiales!");   
   }
   });
}