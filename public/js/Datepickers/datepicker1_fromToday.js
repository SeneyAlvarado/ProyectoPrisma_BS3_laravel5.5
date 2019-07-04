$(function () {
    momentoInicioDia = new Date();
    momentoInicioDia.setHours(0, 0, 0, 0);
    $("#datepicker1_fromToday").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: momentoInicioDia,
        showOn: "button",
        buttonImage: "/Imagenes/glyph_calendar.png",
        buttonText: "Seleccionar Fecha",
        showAnim: "fadeIn",
    });
})
