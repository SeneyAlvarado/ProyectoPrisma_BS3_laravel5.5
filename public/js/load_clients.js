

/**Javascrip to fill the list of clients in the table to create a new order*/
function listClientsTable() {

    $.ajax({
        url: '/fillnames',
        type: 'GET',
        dataType: "json",
        success: function (datos) {

            var table = $('#tableClients').DataTable();
            table.clear().draw();
            $.each(datos, function () {
                $.each(this, function () {
                    selectbtn =
                        '<a onClick="fillDataOwnerClient(\'' + this.id + '\',\'' + this.name + '\',\'' + this.identification + '\',\'' + this.phone + '\',\'' + this.email + '\')"  class="btn btn-warning style-btn-edit btn-sm" style="width:95px;">Seleccionar</a>';
                    table.rows.add(
                        [[this.id, this.identification, this.name, this.phone, selectbtn]]
                    ).draw();

                })

            })

        }, error: function () {
            alert("¡Ha habido un error! al cargar la lista de clientes en la tabla");
        }
    });
    $("#table-clients").modal('show');
}

function fillDataOwnerClient(id, name, identification, phone, email) {
    $("#client_name").empty();
    $("#identification").empty();
    $("#phone").empty();
    $("#email").empty();
    $("#client_name").append(name);
    $("#identification").append(identification);
    $("#phone").append(phone);
    $("#email").append(email);
    document.getElementById("hideId").style.display = "block";
    document.getElementById("hidePhone").style.display = "block";
    document.getElementById("hideEmail").style.display = "block";
    document.getElementById("hide_contacts").style.display = "block";
    //document.getElementById("hide_money").style.display = "block";
    //document.getElementById("hide_money").style.marginLeft = "1px";
    //document.getElementById("hide_advancement").style.display = "block";
    //document.getElementById("hide_total").style.display = "block";
    document.getElementById("hideName").style.display = "block";
    $("#client_id").val(id);
    $("#table-clients").modal('hide');
    fillClientContacts(id);
}

function fillClientContacts(id) {
    $.ajax({

        url: '/fillClientContacts/' + id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            var table = $('#tableClients').DataTable();
            table.clear().draw();
            $('#dropContacts').empty();
            $.each(datos, function () {
                $.each(this, function () {
                    $('#dropContacts').append('<option value="' + this.contact_id + '">' + this.identification + " " + this.contact_name + '</option>');
                })

            })

        }, error: function () {
            alert("¡Ha habido un error! al cargar la lista de contactos del cliente");
        }
    });
}


