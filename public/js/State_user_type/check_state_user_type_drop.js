
//This function validates the create submit at state_user_types before sending it to server
function check_state_user_type_drop(form) {
    var dropState = form.dropState.value;
    var dropRol = form.dropRol.value;

    //if either state or user_type ar the default values, alert the error to the user 
    //and don´t do the submit (doesn´t go to the server)
    if(dropRol == 'defecto'){
        alert('Elija correctamente el puesto');
        return false;
    }
    if(dropState == 'defecto'){
        alert('Elija correctamente el estado');
        return false;
    }
    return true;
}