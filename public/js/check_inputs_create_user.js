
//This function validates the create submit at check_inputs_create_user before sending it to server
function check_inputs_create_user(form) {
    var dropBranch = form.dropBranch.value;
    var dropRol = form.dropRol.value;

    //if either state or user_type ar the default values, alert the error to the user 
    //and don´t do the submit (doesn´t go to the server)
    if(dropBranch == 'defecto'){
        alert('Elija correctamente la sucursal');
        return false;
    }
    if(dropRol == 'defecto'){
        alert('Elija correctamente el puesto del funcionario');
        return false;
    }
    return true;
}