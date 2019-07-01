$(function () {
    momentoInicioDia = new Date();
    momentoInicioDia.setHours(0,0,0,0);
    $('#datetimepicker4').datetimepicker({
        format: 'DD/MM/YYYY',
    });
    
});