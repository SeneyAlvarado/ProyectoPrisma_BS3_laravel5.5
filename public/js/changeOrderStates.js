function changeOrderState(orderID, stateID, stateName) {

    var confirmation = confirm('¿Desea cambiar a "' + stateName + '" el estado de la orden y todos sus trabajos?');
    if (confirmation == false) {//if the user doesn´t want to change state
        return;
    } else {//if the user want to change state
        var actualState = $('#drop' + orderID).val();
        var actualStateName = $('#drop' + orderID).html();
        actualStateName = actualStateName.replace(/\r?\n|\r/g, '');
        actualStateName = actualStateName.trim();
        changeState(orderID, stateID, stateName, actualState, actualStateName);
    }
}

function changeState(orderID, stateID, stateName, oldState, oldStateName) {
    $('#drop' + orderID).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp Cargando');
    $.ajax({
        url: '/changeOrderWorksState/' + orderID + "/" + stateID,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#drop' + orderID).val(stateID);
            $('#drop' + orderID).html(stateName);
            $('#orderState' + orderID + stateID).remove();
            var stateToAppend = '<button class="dropdown-item" id="orderState' + orderID + oldState + '">' + oldStateName + '</button>';
            $("[name='dropOtherStates" + orderID + "']").append(stateToAppend);
            $("#orderState" + orderID + oldState).click(function () { changeOrderState(orderID, oldState, oldStateName); });

            var percentText = "0%";
            var percentWidth = "0%";

            if (stateID == "1") { //if state is "En progreso"
                percentText = "0%";
                percentWidth = "0%";
            } else if (stateID == "2") {//if state is "Finalizado"
                percentText = "100%";
                percentWidth = "100%";
            } else if (stateID == "3") {//if state is "Cancelado"
                percentText = "0%";
                percentWidth = "0%";
            }
            $('#percentText' + orderID).html(percentText);
            $('#percentDiv' + orderID).attr("style", "width: " + percentWidth);

            //alert(datos.message);

        }, error: function () {
            alert("¡Ha habido un error cambiando el estado! " +
                "Si este error persiste por favor comuníquese con el equipo técnico");
            $('#drop' + orderID).val(oldState);
            $('#drop' + orderID).html(oldStateName);
        }
    });
}
