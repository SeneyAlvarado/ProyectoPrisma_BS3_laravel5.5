$(document).ready(function(){
    state();
})


/**Javascrip to fill the dropdown in the create state_user_type form, with the branches of the system*/
function state(){
    $('#dropState').empty();
    $('#dropState').append("<option>Cargando...</option>");
     $.ajax({
    url: '/active_states_drop',
    type: 'GET',
    dataType: "json",
    success:function(datos){ 
    $('#dropState').empty();
    $('#dropState').append("<option value='defecto'>Seleccione Estado</option>");   
    $.each(datos, function()
    {
        $.each(this, function(){
            $('#dropState').append('<option value="' + this.id + '">' + this.name + '</option>');
        }) 
    })

    }, error:function() {
        alert("¡Ha habido un error! Elija correctamente el estado." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}


    