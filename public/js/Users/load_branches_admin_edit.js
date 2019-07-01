/**Javascrip to fill the dropdown in the edit account form, with the branches of the sistem*/
function branch(branch_id){
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

function rol(user_type){
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
        if (this.id == user_type)  {  
            $('#dropRol').append('<option selected="true" value="' + this.id + '">' + this.name + '</option>');
        } else {
            $('#dropRol').append('<option value="' + this.id + '">' + this.name + '</option>');
        }
        }) 
        
    })

    }, error:function() {
        alert("¡Ha habido un error! Elija correctamente la sucursal." +
        "Si este error persiste por favor comuníquese con el equipo técnico");   
    }
    });
}


    