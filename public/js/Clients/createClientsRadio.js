$(document).ready(function () {


    if ($(this).attr("value") == 2) {//juridical client
        $(".Box").hide('slow');
        $('#lastname').removeAttr("required");
        $('#second_lastname').removeAttr("required");
    }
    if ($(this).attr("value") == 1) {//physical client
        $(".Box").show('slow');
        $("#lastname").prop("required", true);
        $('#lastname').attr("required");
        $("#second_lastname").prop("required", true);
        $('#second_lastname').attr("required");
    }

    $('input[type="radio"]').click(function () {
        if ($(this).attr("value") == 2) {//juridical client
            $(".Box").hide('slow');
            $('#lastname').removeAttr("required");
            $('#second_lastname').removeAttr("required");
        }
        if ($(this).attr("value") == 1) {//physical client
            $(".Box").show('slow');
            $("#lastname").prop("required", true);
            $('#lastname').attr("required");
            $("#second_lastname").prop("required", true);
            $('#second_lastname').attr("required");
        }
    });

    $('input[type="radio"]').trigger('click');  // trigger the event
});