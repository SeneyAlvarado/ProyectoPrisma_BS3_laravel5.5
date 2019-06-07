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
        $.each(this, function(){//los datos del server vienen en una variable data
    //si quieren ver esos datos pongan en la URL "/recintosCombo" por ejemplo.
        $('#dropBranch').append('<option value="' + this.id + '">' + this.name + '</option>');
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
})

    