/**This method is in charge to fill the contact information of one order
 *the param id is the identification of the client to be serach in the BD
 *this ajax use the controller ClientController and the method ajax_contact 
*/
function workDetails(id){
    $("#order_id").empty();
    $("#work_id").empty();
    $("#work_ids").empty();
    $("#priority").empty();
    $("#payment").empty();
    $("#entry_date").empty();
    $("#delivery_date").empty();
    $("#product").empty();
    $("#designer").empty();
    $("#print").empty();
    $("#post_production").empty();
    $("#dry").empty();
    $.ajax({
        url: '/work.show/' + id,
        type: 'GET',
        dataType: "json",
        success:function(datos){
            var myJSON = JSON.stringify(datos);
            $.each(datos, function()
            {
                $("#order_id").append(this.order_id);
                $("#work_id").append(this.id);
                $("#work_ids").append(this.id);
                if(this.priority == 0){
                    $("#priority").append("No");
                } else {
                    $("#priority").append("Sí");
                }
                if(this.advance_payment == 0){
                    $("#payment").append("No");
                } else {
                    $("#payment").append("Sí");
                }
                var date = this.entry_date.split("-");
                var year = date[0];
                var month = date[1];
                var day = date[2];
                var new_day_without_time = day.split(" "); 
                var day = new_day_without_time[0];
                var entry_date = day + "/" + month + "/"  + year;

                var date = this.approximate_date.split("-");
                var year = date[0];
                var month = date[1];
                var day = date[2];
                var new_day_without_time = day.split(" "); 
                var day = new_day_without_time[0];
                var approximate_date = day + "/" + month + "/"  + year;

                $("#entry_date").append(entry_date);
                $("#delivery_date").append(approximate_date);
                $("#product").append(this.product_name);
                
                if(this.designer_date == null) {
                    $("#designer").append("No posee");
                } else {
                    var date = this.designer_date.split("-");
                    var year = date[0];
                    var month = date[1];
                    var day = date[2];
                    var new_day_without_time = day.split(" "); 
                    var day = new_day_without_time[0];
                    var designer_date = day + "/" + month + "/"  + year;
                    $("#designer").append(designer_date);
                }
                if(this.print_date == null) {
                    $("#print").append("No posee");
                }  else {
                    var date = this.print_date.split("-");
                    var year = date[0];
                    var month = date[1];
                    var day = date[2];
                    var new_day_without_time = day.split(" "); 
                    var day = new_day_without_time[0];
                    var print_date = day + "/" + month + "/"  + year;
                    $("#print").append(print_date);
                }
               
                if(this.post_production_date == null) {
                    $("#post_production").append("No posee");
                }
                if(this.drying_hours == null) {
                    $("#dry").append("No posee");
                }

                $("textarea[name=observation]").val(this.observation);
                
                $("#editModal").modal('show'); 
                
                //alert(datos);
            })
        }, error:function() {
            alert("¡Ha habido un error al cargar la información del trabajo!" +
            "Si este error persiste por favor comuníquese con el equipo técnico");   
        }
        }); 
         
} 