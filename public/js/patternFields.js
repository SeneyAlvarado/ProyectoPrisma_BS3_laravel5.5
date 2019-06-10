$(document).ready(function () {

    if($("#identification").length){//checks if the element exists
        $("#identification").prop("pattern", true);
        $('#identification').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789]{5,25}');

        $("#identification").prop("title", true);
        $('#identification').attr("title", 'Digite una cédula de mínimo 5 caracteres y máximo 35 caracteres');
        //when user has the mouse (pointer) over the identification ("Cédula") field, this message will prompt.

        $("#identification").prop("oninvalid", true);
        $('#identification').attr("oninvalid", 
        "this.setCustomValidity('Digite una cédula de mínimo 5 caracteres y máximo 35 caracteres')");
        //when user fails the pattern this message will appear.
    }

});