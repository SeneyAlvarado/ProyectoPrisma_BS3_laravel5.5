function loadMaterials(){
    $.ajax({
   url: '/fillmaterials',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#origen').empty();
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


function loadMaterialsSelected(materials){
    $.ajax({
   url: '/fillmaterials',
   type: 'GET',
   dataType: "json",
   success:function(datos){ 
   $('#origen_edit').empty();
   $.each(datos, function()
   {
       $.each(this, function(){
           if(materials.includes(this.id)) {
            $('#destino_edit').append('<option value="' + this.id + '">' + this.id + ". " + this.name  + '</option>'); 
           } else {
            $('#origen_edit').append('<option value="' + this.id + '">' + this.id + ". " + this.name  + '</option>'); 
           }
       })  
   })

   }, error:function() {
       alert("¡Ha habido un error al cargar los materiales!");   
   }
   });
}