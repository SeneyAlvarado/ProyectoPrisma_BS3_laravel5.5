function changingDesigner(work_id, designerID, designerName) {

    var confirmation = confirm('¿Desea asignar a "' + designerName + '" al trabajo?');
    if (confirmation == false) {//if the user doesn´t want to change state
        return;
    } else {//if the user want to change state
        var actualState = $('#dropDesigner' + work_id).val();
        var actualdesignerName = $('#dropDesigner' + work_id).html();
        actualdesignerName = actualdesignerName.replace(/\r?\n|\r/g, '');
        actualdesignerName = actualdesignerName.trim();
//        alert(oldState);
        changeDesigner(work_id, designerID, designerName, actualState, actualdesignerName);
    }
}

function changeDesigner(work_id, designerID, designerName, oldState, olddesignerName) {
    $('#dropDesigner' + work_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp Cargando');
    $.ajax({
        url: '/changeDesigner/' + work_id + "/" + designerID,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            
            $('#dropDesigner' + work_id).val(designerID);
            $('#dropDesigner' + work_id).html(designerName);
            $('#workDesigner' + work_id + designerID).remove();
            var stateToAppend = '<button class="dropdown-item" id="workDesigner' + work_id + oldState + '">' + olddesignerName + '</button>';
            $("[name='dropOtherDesigners" + work_id + "']").append(stateToAppend);
            $("#workDesigner" + work_id + oldState).click(function () { changeOrderState(work_id, oldState, olddesignerName); });
            //alert(datos.message);

        }, error: function () {
            alert("¡Ha habido un error cambiando el estado! " +
                "Si este error persiste por favor comuníquese con el equipo técnico");
            $('#dropdropDesigner' + work_id).val(oldState);
            $('#dropdropDesigner' + work_id).html(olddesignerName);
        }
    });
}
