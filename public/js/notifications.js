function markReadNotifications() {
    $.get('/markReadNotifications');
    $('#numberNotification').text("0");
}