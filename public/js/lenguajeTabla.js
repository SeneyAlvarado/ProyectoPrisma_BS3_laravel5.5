$('#tablaDatos').DataTable(
    {
   "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
} ,
dom: 'l<"toolbar">frtip',
initComplete: function(){
   $("div.toolbar")
      .html('&nbsp<button id="hrefCreate" onclick="redirectCreate();" class=" btn btn-secundary btn-sm" style="color:white; background-color:#96183a !important; border-radius: 4px;margin-bottom: 10px;">&nbsp<span class="glyphicon glyphicon-plus"></span> </button>');           
}     ,
stateSave: true,
"ordering": true,    

   } );

   //No borrar, prueba cambio colores
   /*$('#tablaDatos').DataTable(
    {
   "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
} ,
stateSave: true,
"ordering": false,    
"rowCallback": function( row, data, index ) {
    //alert(data[2]);
        if ( data[2] == "Especialista" )
   {
       $('td', row).css('background-color', 'Red');
       //formatStyle('Correo',  color = 'red', backgroundColor = 'orange', fontWeight = 'bold');
   }
   else if ( data[2] == "4" )
   {
       $('td', row).css('background-color', 'Orange');
   }
   }} );*/