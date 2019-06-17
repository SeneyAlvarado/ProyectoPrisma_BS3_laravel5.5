$(document).ready(function(){
    getUserNotifications();
});

function markReadNotifications() {
    if($('#numberNotification').text() == 0){
        noNotificationsAvailable();
    } else {
    $('#numberNotification').text("0");
    $.get('/markReadNotifications');
    }
}

function noNotificationsAvailable() {
    $('#numberNotification').text("0");
    $('#dropmenu-notifications').empty();
    $('#dropmenu-notifications').append(' <a id="noNotifications" class="dropdown-item"'
    + 'href="#">Sin notificaciones</a>');

}

function getUserNotifications(){
    
    noNotificationsAvailable();
    $('#dropmenu-notifications').empty();

     $.ajax({
        url: '/getUserNotifications',
        type: 'GET',
        dataType: "json",
        success:function(datos){ 
            var notificationCount = 0;
            //alert(datos.length);
            $.each(datos, function()
            {
                //alert(this);
                //alert(this.length);
              
                $.each(this, function(){//los datos del server vienen en una variable data
                    notificationCount = notificationCount +1;
                    $('#dropmenu-notifications').append(' <a class="dropdown-item" href="#">' + this.data.message + " " + this.data.notificationHour + '</a>');
                })        
            })
            
            $('#numberNotification').text(notificationCount);
            if(notificationCount == 0) {
                noNotificationsAvailable();
            }

        }, error:function() {
            noNotificationsAvailable();
            alert("¡Ha habido un error con las notificaciones!");
        }
    });
}