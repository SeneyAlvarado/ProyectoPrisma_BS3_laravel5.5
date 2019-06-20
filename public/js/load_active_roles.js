$(document).ready(function(){
    rol();
})

function rol(){
    $('#dropRol').empty();
    $('#dropRol').append("<option>Cargando...</option>");
     $.ajax({
    url: '/dropRol',
    type: 'GET',
    dataType: "json",
    success:function(datos){ 
    $('#dropRol').empty();
    $('#dropRol').append("<option value='defecto'>Seleccione Puesto</option>");   
    $.each(datos, function()
    {
        $.each(this, function(){
        $('#dropRol').append('<option value="' + this.id + '">' + this.name + '</option>');
        })        
    })

    }, error:function() {
        alert("¡Ha habido un error! Elija correctamente el rol." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}