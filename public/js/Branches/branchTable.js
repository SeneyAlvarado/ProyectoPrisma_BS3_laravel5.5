$('#tablaDatos').DataTable(
    {
   "language": {
       "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
} ,
dom: 'l<"toolbar">frtip',
initComplete: function(){
   $("div.toolbar")
      .html('&nbsp<button data-toggle="modal" data-target="#myModal" class=" btn btn-secundary btn-sm" style="color:white; background-color:#96183a !important; border-radius: 4px;margin-bottom: 10px;">&nbsp<span class="glyphicon glyphicon-plus"></span> </button>');           
}     ,
stateSave: true,
"ordering": true,    

   } );