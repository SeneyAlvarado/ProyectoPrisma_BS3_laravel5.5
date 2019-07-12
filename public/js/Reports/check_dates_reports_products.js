//This function validates the create submit at check_dates_reports before sending it to server
function check_dates_reports_products(form) {
    
    var startDate = form.startDate.value;
    var endDate = form.endDate.value;
    //if either date is null, alert the error to the user 
    //and don´t do the submit (doesn´t go to the server)
    if(startDate == ""){
        alert('Elija correctamente una fecha de inicio para el reporte');
        return false;
    }
    if(endDate == ""){
        alert('Elija correctamente una fecha de fin para el reporte');
        return false;
    }
    return true;
}