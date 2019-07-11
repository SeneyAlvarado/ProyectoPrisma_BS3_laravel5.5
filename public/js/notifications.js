$(document).ready(function () {
    getUserNotifications();
    window.setInterval(function () {
        getUserNotifications();
    }, 300000/*5000*/);//300000 means the notifications will be checked automatically every 5 minutes
});

function markReadNotifications() {
    //no borrar
}

function noNotificationsAvailable() {//empty and sets 0 to both non responsive and responsive notfications
    $('#numberNotification').text("0");
    $('#numberNotificationResponsive').text("0");
    $('#dropmenu-notifications').empty();
    $('#dropResponsiveNotifications').empty();
    $('#dropmenu-notifications').append(' <a id="noNotifications" class="dropdown-item"'
        + 'href="#">Sin notificaciones</a>');
    $('#dropResponsiveNotifications').append(' <a id="noNotificationsResponsive" class="dropdown-item n"'
        + 'href="#" style="color:white">Sin notificaciones</a>');

}

function getUserNotifications() {

    noNotificationsAvailable();
    $('#dropmenu-notifications').empty();
    $('#dropResponsiveNotifications').empty();

    $.ajax({
        url: '/getUserNotifications',
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            var notificationCount = 0;
            //alert(datos.length);
            $.each(datos, function () {
                //alert(this);
                //alert(this.length);

                $.each(this, function () {//los datos del server vienen en una variable data
                    notificationCount = notificationCount + 1;
                    var notifAppend = '<a id="' + this.id + '" class="dropdown-item"' +
                        ' onclick="readNotification(\'' + this.id + '\'' + "," + this.data.work_id + ')">'
                        + this.data.message + " " + this.data.notificationHour + '</a>';
                    var notifAppendResponsive = '<a class="dropdown-item n col-md-4 responsiveNotificationBorder" style="color:white"' +
                        ' onclick="readNotification(\'' + this.id + '\'' + "," + this.data.work_id + ')">'
                        + this.data.message + " " + this.data.notificationHour + '</a>';
                    //alert(notifAppend);
                    $('#dropmenu-notifications').append(notifAppend);
                    $('#dropResponsiveNotifications').append(notifAppendResponsive);
                })
            })

            $('#numberNotification').text(notificationCount);
            $('#numberNotificationResponsive').text(notificationCount);
            if (notificationCount == 0) {
                noNotificationsAvailable();
            } else {
                var audio = new Audio('/audio/notification.mp3');
                audio.play();
                var thrashCanGlyph = '<span class="glyphicon glyphicon-trash deleteNotif"></span>';
                var thrashCanGlyphResponsive = '<span class="glyphicon glyphicon-trash deleteNotifResponsive"></span>';
                var deleteText = "Eliminar notificaciones"
                var deleteAllNotifications = '<a class="dropdown-item deleteNotif"' +
                    ' onclick="deleteNotifications()">'
                    + deleteText + "&nbsp" + thrashCanGlyph + '</a>';
                var deleteAllNotificationsResponsive = '<a class="dropdown-item n responsiveNotificationBorder deleteNotifResponsive" style="color:white"' +
                    ' onclick="deleteNotifications()">'
                    + deleteText + "&nbsp" + thrashCanGlyphResponsive + '</a>';
                $('#dropmenu-notifications').append(deleteAllNotifications);
                $('#dropResponsiveNotifications').append(deleteAllNotificationsResponsive);
            }

        }, error: function () {
            noNotificationsAvailable();
            alert("¡Ha habido un error con las notificaciones!");
        }
    });
}

function readNotification(notification_id, work_id) {
    //noNotificationsAvailable();
    //$('#dropmenu-notifications').empty();
    $.ajax({
        url: '/readNotification/' + notification_id + "/" + work_id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            window.location.replace("/orders.edit/" + datos.order_id);
        }, error: function (e) {
            console.log(e);
            alert("¡Ha habido un error marcando la notificación como leída!");
        }
    });
}

function deleteNotifications() {
    var idArray = getNotificationsID();
    idArray = JSON.stringify(idArray);
    noNotificationsAvailable();
    $.ajax({
        url: '/deleteNotifications/' + idArray,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            //alert(datos.success);
        }, error: function (e) {
            console.log(e);
            alert("¡Ha habido un error eliminando las notificaciones!");
            getUserNotifications();
        }
    });
}

function getNotificationsID() {//gets all notifications id at an array, returns that array
    var idArray = [];
    var elms = document.getElementById("dropmenu-notifications").getElementsByTagName("a");
    for (var i = 0; i < elms.length - 1; i++) {
        idArray.push(elms[i].id);
    }
    return idArray;
}