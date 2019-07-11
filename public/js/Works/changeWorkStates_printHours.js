function changeWorkState(workID, stateID, stateName) {
    var confirmation = confirm('¿Desea cambiar a "' + stateName + '" el estado del trabajo?');
    if (confirmation == false) {//if the user doesn´t want to change state
        return;
    } else {//if the user want to change state

        if (stateID == 6) {//if the state is "Post-Produccion"
            $('#dry_hours').val(0);
            $('#work_id').val(workID);
            $('#state_id').val(stateID);
            $('#state_name').val(stateName);
            $('#modalHours').modal('show');
        } else {
            callChangeStateAjax(workID, stateID, stateName);
        }
    }
}

function callChangeStateAjax(workID, stateID, stateName) {
    var actualState = $('#drop' + workID).val();
    var actualStateName = $('#drop' + workID).html();
    actualStateName = actualStateName.replace(/\r?\n|\r/g, '');
    actualStateName = actualStateName.trim();
    changeState(workID, stateID, stateName, actualState, actualStateName);
}

function changeState(workID, stateID, stateName, oldState, oldStateName) {
    $('#drop' + workID).html('<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp Cargando');
    $.ajax({
        url: '/changeWorkState/' + workID + "/" + stateID,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#drop' + workID).val(stateID);
            $('#drop' + workID).html(stateName);
            $('#workState' + workID + stateID).remove();
            var stateToAppend = '<button class="dropdown-item" id="workState' + workID + oldState + '">' + oldStateName + '</button>';
            $("[name='dropOtherStates" + workID + "']").append(stateToAppend);
            $("#workState" + workID + oldState).click(function () { changeWorkState(workID, oldState, oldStateName); });

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

            $('#percentText' + workID).html(percentText);
            $('#percentDiv' + workID).attr("style", "width: " + percentWidth);

            //alert(datos.message);

        }, error: function () {
            alert("¡Ha habido un error cambiando el estado! " +
                "Si este error persiste por favor comuníquese con el equipo técnico");
            $('#drop' + workID).val(oldState);
            $('#drop' + workID).html(oldStateName);
        }
    });
}

function changeDryingHours(workID, stateID, stateName) {
    var drying_hours = $('#dry_hours').val();
    $.ajax({
        url: '/changeDryingHours/' + workID + "/" + drying_hours,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#modalHours').modal('hide');
            callChangeStateAjax(workID, stateID, stateName);
            //alert(datos.success);
        }, error: function () {
            alert("¡Ha habido un error actualizando las horas de secado del trabajo! " +
                "Si este error persiste por favor comuníquese con el equipo técnico");
        }
    });
}

function checkDryingHours() {
    var drying_hours = $('#dry_hours').val();
    if (isNaN(drying_hours) || isEmptyOrSpaces(drying_hours)
        || drying_hours < 0 || (drying_hours % 1 != 0)) {//if ít´s not a number or negative
        alert("Las horas de secado deben ser un número entero válido, con un mínimo de 0 horas")
        return false;
    } else {
        return true;
    }
}

function isEmptyOrSpaces(str) {
    return str === null || str.match(/^ *$/) !== null;
}

function checkDryingHoursModal() {
    //return alert(checkDryingHours());
    if (checkDryingHours()) {
        var workID = $('#work_id').val();
        var stateID = $('#state_id').val();
        var stateName = $('#state_name').val();
        changeDryingHours(workID, stateID, stateName);
    } else {
        return; //do nothing;
    }
}