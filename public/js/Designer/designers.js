function changeDesigner(work_id, designerID, designerName) {

    var confirmation = confirm('¿Desea asignar a "' + designerName + '" al trabajo?');
    if (confirmation == false) {//if the user doesn´t want to change state
        return;
    } else {//if the user want to change state
        var actualState = $('#drop' + work_id).val();
        var actualdesignerName = $('#drop' + work_id).html();
        actualdesignerName = actualdesignerName.replace(/\r?\n|\r/g, '');
        actualdesignerName = actualdesignerName.trim();
        changeDesigner(work_id, designerID, designerName, actualState, actualdesignerName);
    }
}

function changeDesigner(work_id, designerID, designerName, oldState, olddesignerName) {
    $('#drop' + work_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp Cargando');
    $.ajax({
        url: '/changeDesigner/' + work_id + "/" + designerID,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#drop' + work_id).val(designerID);
            $('#drop' + work_id).html(designerName);
            $('#workDesigner' + work_id + designerID).remove();
            var stateToAppend = '<button class="dropdown-item" id="workDesigner' + work_id + oldState + '">' + olddesignerName + '</button>';
            $("[name='dropOtherDesigners" + work_id + "']").append(stateToAppend);
            $("#orderState" + work_id + oldState).click(function () { changeOrderState(work_id, oldState, olddesignerName); });
            //alert(datos.message);

        }, error: function () {
            alert("¡Ha habido un error cambiando el estado! " +
                "Si este error persiste por favor comuníquese con el equipo técnico");
            $('#drop' + work_id).val(oldState);
            $('#drop' + work_id).html(olddesignerName);
        }
    });
}
