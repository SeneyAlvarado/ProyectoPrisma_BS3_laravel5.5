$(document).ready(function () {
    getUserNotifications();
});

function markReadNotifications() {
    //no borrar
}

function noNotificationsAvailable() {
    $('#numberNotification').text("0");
    $('#dropmenu-notifications').empty();
    $('#dropmenu-notifications').append(' <a id="noNotifications" class="dropdown-item"'
        + 'href="#">Sin notificaciones</a>');

}

function getUserNotifications() {

    noNotificationsAvailable();
    $('#dropmenu-notifications').empty();

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
                    var notifAppend = '<a class="dropdown-item"' + 
                    ' onclick="readNotification(\'' + this.id + '\'' + ","  + this.data.work_id + ')">'
                     + this.data.message + " " + this.data.notificationHour + '</a>';
                     //alert(notifAppend);
                    $('#dropmenu-notifications').append(notifAppend);

                })
            })

            $('#numberNotification').text(notificationCount);
            if (notificationCount == 0) {
                noNotificationsAvailable();
            } else {
                var audio = new Audio('/audio/notification.mp3');
                audio.play();
            }   

        }, error: function () {
            noNotificationsAvailable();
            //alert("¡Ha habido un error con las notificaciones!");
        }
    });
}

function readNotification(notification_id, work_id){
    //noNotificationsAvailable();
    //$('#dropmenu-notifications').empty();
    $.ajax({
        url: '/readNotification/' +  notification_id + "/" + work_id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            window.location.replace("/orders.edit/" + datos.order_id);
            //alert("yay" + datos.order_id);
            //alert(datos.length);
            /*$('#numberNotification').text(notificationCount);
            if (notificationCount == 0) {
                noNotificationsAvailable();
            } else {
                var audio = new Audio('/audio/notification.mp3');
                audio.play();
            }   */

        }, error: function (e) {
            console.log(e);
            alert("error");
            //alert("¡Ha habido un error con las notificaciones!");
        }
    });
}