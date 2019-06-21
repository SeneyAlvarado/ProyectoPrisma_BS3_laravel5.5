$(function () {
    momentoInicioDia = new Date();
    momentoInicioDia.setHours(0,0,0,0);
    $('#datetimepicker4').datetimepicker({
        minDate: momentoInicioDia, //Muestra el calendario desde el dia actual y no desde antes
        format: 'DD/MM/YYYY',
    });
});