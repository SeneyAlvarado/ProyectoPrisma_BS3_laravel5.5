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

        $("#identification").prop("onchange", true);
        $('#identification').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)

        
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

        $("#name").prop("onchange", true);
        $('#name').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
    }

    if($("#lastname").length){//checks if the element exists

        $("#lastname").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#lastname').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789 ]{2,30}');

        $("#lastname").prop("title", true);
        $('#lastname').attr("title", 'Digite un primer apellido de mínimo 2 caracteres y máximo 30 caracteres');

        //when user has the mouse (pointer) over the lastname ("Primer Apellido") field, this message will prompt.

        $("#lastname").prop("oninvalid", true);
        $('#lastname').attr("oninvalid", 
        "this.setCustomValidity('Digite un primer apellido de mínimo 2 caracteres y máximo 30 caracteres')");
        //when user fails the pattern this message will appear.

        $("#lastname").prop("onchange", true);
        $('#lastname').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
        
    }

    if($("#second_lastname").length){//checks if the element exists

        $("#second_lastname").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#second_lastname').attr("pattern", '[a-zA-Z-ñÑáéíóúÁÉÍÓÚ0123456789 ]{2,30}');

        $("#second_lastname").prop("title", true);
        $('#second_lastname').attr("title", 'Digite un segundo apellido de mínimo 2 caracteres y máximo 30 caracteres');
        //when user has the mouse (pointer) over the second_lastname ("Segundo Apellido") field, this message will prompt.

        $("#second_lastname").prop("oninvalid", true);
        $('#second_lastname').attr("oninvalid", 
        "this.setCustomValidity('Digite un segundo apellido de mínimo 2 caracteres y máximo 30 caracteres')");
        //when user fails the pattern this message will appear.

        $("#second_lastname").prop("onchange", true);
        $('#second_lastname').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
    }

    if($("#number").length){//checks if the element exists

        $("#number").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#number').attr("pattern", '[0123456789]{4,15}');

        $("#number").prop("title", true);
        $('#number').attr("title", 'Digite un teléfono de mínimo 4 dígitos y máximo 15 dígitos (sin espacios ni guiones)');
        //when user has the mouse (pointer) over the PHONE ("TELÉFONO") field, this message will prompt.

        $("#number").prop("oninvalid", true);
        $('#number').attr("oninvalid", 
        "this.setCustomValidity('Digite un teléfono de mínimo 4 dígitos y máximo 15 dígitos (sin espacios ni guiones)");
        //when user fails the pattern this message will appear.

        $("#number").prop("onchange", true);
        $('#number').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
    }

    if($("#email").length){//checks if the element exists

        //AT THE TIME WE DONT HAVE AN EMAIL PATTERN
        /*$("#email").prop("pattern", true);//adds the below pattern to HTML to validate info
        $('#email').attr("pattern", '[123456789]{4,15}');*/

        $("#email").prop("title", true);
        $('#email').attr("title", 'Digite un correo electrónico válido');
        //when user has the mouse (pointer) over the email ("Correo electrónico") field, this message will prompt.

        $("#email").prop("oninvalid", true);
        $('#email').attr("oninvalid", 
        "this.setCustomValidity('Digite un correo electrónico válido");
        //when user fails the pattern this message will appear.

        $("#email").prop("onchange", true);
        $('#email').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
    }

    if($("#address").length){//checks if the element exists

        $("#address").prop("title", true);
        $('#address').attr("title", 'Digite una dirección de máximo 250 caracteres');
        //when user has the mouse (pointer) over the address ("Dirección") field, this message will prompt.

        $("#address").prop("oninvalid", true);
        $('#address').attr("oninvalid", 
        "this.setCustomValidity('Digite una dirección de máximo 250 caracteres");
        //when user fails the pattern this message will appear.

        $("#address").prop("maxlength", true);
        $('#address').attr("maxlength", "250");
        //sets max length of address textarea (text field) at 250 characters

        $("#address").prop("onchange", true);
        $('#address').attr("onchange", 
        "try{setCustomValidity('')}catch(e){}");//this makes the validator check again the user input 
        //(if not added, once the user input is wrong, would always be wrong)
    }


});