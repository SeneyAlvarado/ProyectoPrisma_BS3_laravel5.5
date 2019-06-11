$(document).ready(function () {

    if($("#identification").length){//checks if the element exists

        $("#identification").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#identification').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789]{5,35}');

        $("#identification").prop("title", true);
        $('#identification').attr("title", 'Digite una cédula de mínimo 5 caracteres y máximo 35 caracteres (sin espacios)');
        //when user has the mouse (pointer) over the identification ("Cédula") field, this message will prompt.

        $("#identification").prop("oninvalid", true);
        $('#identification').attr("oninvalid", 
        "this.setCustomValidity('Digite una cédula de mínimo 5 caracteres y máximo 35 caracteres (sin espacios)')");
        //when user fails the pattern this message will appear.
    }

    if($("#name").length){//checks if the element exists

        $("#name").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#name').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789 ]{2,45}');

        $("#name").prop("title", true);
        $('#name').attr("title", 'Digite un nombre de mínimo 2 caracteres y máximo 45 caracteres');
        //when user has the mouse (pointer) over the name ("Nombre") field, this message will prompt.

        $("#name").prop("oninvalid", true);
        $('#name').attr("oninvalid", 
        "this.setCustomValidity('Digite un nombre de mínimo 2 caracteres y máximo 45 caracteres')");
        //when user fails the pattern this message will appear.
    }

    if($("#lastname").length){//checks if the element exists

        $("#lastname").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#lastname').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789 ]{2,30}');

        $("#lastname").prop("title", true);
        $('#lastname').attr("title", 'Digite una cédula de mínimo 5 caracteres y máximo 30 caracteres');
        //when user has the mouse (pointer) over the name ("Nombre") field, this message will prompt.

        $("#lastname").prop("oninvalid", true);
        $('#lastname').attr("oninvalid", 
        "this.setCustomValidity('Digite una cédula de mínimo 5 caracteres y máximo 30 caracteres')");
        //when user fails the pattern this message will appear.
    }

});