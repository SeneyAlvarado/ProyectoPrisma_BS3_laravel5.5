/**This js load the list of posible contacts of a clien*/
function listContactsTable(id) {
    $.ajax({
        url: '/fillcontacts/' + id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            var table = $('#tableContacts').DataTable();
            table.clear().draw();
            $.each(datos, function () {
                $.each(this, function () {
                    selectbtn =
                    selectbtn =
                        '<a onClick="createContact(\'' + this.owner_id + '\',\'' + this.id + '\')"  class="btn btn-warning style-btn-success btn-sm" style="width:95px;">Seleccionar</a>';
                table.rows.add(
                    [[this.id, this.identification, this.name, this.email, this.phone, selectbtn]]
                ).draw(); 

                })
            })
        }, error: function () {
            alert("¡Ha habido un error al cargar la lista de clientes en la tabla");
        }
    });
    $("#table-clients").modal('show');
}


function createContact(id_owner, contact_id){
    document.getElementById("loader").style.justifyContent = "center";
    //document.getElementById("loader").style.display = "block";
    $.ajax({
        url: '/insertContact/' + id_owner + '/' + contact_id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {

        }, error: function () {
            alert("¡Ha habido un error al crear el contacto");
        }
    });
    $("#table-clients").modal('hide');
    location.reload();
}

function deleteContact(contact_id){
    //document.getElementById("loader").style.display = "block";
    $.ajax({
        url: '/deleteContact/' + contact_id,
        type: 'GET',
        dataType: "json",
        success: function (datos) {

        }, error: function () {
            alert("¡Ha habido un error al eliminar el contacto");
        }
    });
    location.reload();
}