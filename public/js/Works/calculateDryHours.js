$(document).ready(function () {//cleans the modals when page is accesed/reloaded
    var workCounter = $("#workCounter").val();
    //alert(workCounter);
    var i;
    for (i = 0; i <= workCounter; i++) {
        if ($("#miliTime" + i).length) {
            var miliDate = $("#miliTime" + i).attr('val');
            //alert(i  + "date: " + miliDate);
            aux2 = i;
            if (miliDate != 0) {
                //alert(miliDate);
                var aux = i;
                //the database time +6 hours (don´t know why +6 is needed)
                var countDownDate = new Date(parseInt(miliDate) + 6 * 3600 * 1000);
                changeTime(countDownDate, aux);

            } else {
                $("#miliTime" + aux2).html("Sin asignar")
            }
        }
    }
});

// Update the count down every 1 second
function changeTime(countDownDate, aux) {
    var x = setInterval(function () {
        //alert(aux);

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        //alert("i:" + aux + " distance: " + distance);

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var auxHours = days * 24
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        hours = hours + auxHours;
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("miliTime" + aux).innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";
        //$("#miliTime" + i).html("Sin tiempo de secado XD" + seconds);/* = days + "d " + hours + "h "
        //    + minutes + "m " + seconds + "s ";*/

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("miliTime" + aux).innerHTML = "Listo";
        }
    }, 1000);
}
