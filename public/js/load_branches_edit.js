function branch(){
    var branch_id = $('#branch_id').val();
    //alert(branch_id);
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
        if (this.id == branch_id)  {  
            $('#dropBranch').append('<option selected="true" value="' + this.id + '">' + this.name + '</option>');
        } else {
            $('#dropBranch').append('<option value="' + this.id + '">' + this.name + '</option>');
        }
        }) 
        
    })

    }, error:function() {
        alert("¡Ha habido un error! Elija correctamente la sucursal." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}

$(document).ready(function () {
    branch(); //Calls the branch method
});