//This function validates the create submit at state_user_types before sending it to server
function check_clients_branch_select(form) {
    var dropBranch = form.dropBranch.value;
    var selectClient = form.selectList.value;
    var selectContact = form.selectList_contact.value;
    var date = form.date.value;
    if(dropBranch == 'defecto'){
        alert('Elija correctamente la sucursal');
        return false;
    }
    if(selectClient == 'defecto'){
        alert('Debe seleccionar un cliente propietario de la orden');
        return false;
    }
    if(selectContact == 'defecto'){
        alert('Debe seleccionar un cliente de contacto para la orden');
        return false;
    }
    if(date == ''){
        alert('Elija correctamente la fecha de entrega');
        return false;
    }
    return true;
}