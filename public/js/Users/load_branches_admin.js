/**Javascrip to fill the dropdown in the crate user form, with the branches of the sistem*/
function branch(){
    $('#dropBranch').empty();
    $('#dropBranch').append("<option>Cargando...</option>");
     $.ajax({
    url: '/branchDrop',
    type: 'GET',
    dataType: "json",
    success:function(datos){ 
    $('#dropBranch').empty();
    $('#dropBranch').append("<option value='defecto'>Seleccione Sucursal</option>");   
    $.each(datos, function()
    {
        $.each(this, function(){
        $('#dropBranch').append('<option value="' + this.id + '">' + this.name + '</option>');
        })        
    })

    }, error:function() {
        alert("¡Ha habido un error! Elija correctamente la sucursal." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}

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
        alert("¡Ha habido un error! Elija correctamente la sucursal." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}
$(document).ready(function(){
    branch();
    rol();
})

    