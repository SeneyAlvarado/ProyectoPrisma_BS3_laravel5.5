$(document).ready(function(){
    addFileSizeValidation();
    formInitiation();
})

function addFile(id) {
                            
    $("input[name=id]").val(id);
    $('#addFile').modal('show');
}

function addFileSizeValidation() {
    var uploadField = document.getElementById("design");
    uploadField.onchange = function () {
        if (this.files[0].size > 50000000) {//50 MB max size
            alert("El tamaño máximo permitido para el archivo es de 50 MB");
            this.value = "";
        };
    }
}


function formInitiation() {
    
    $('#fileForm').on('submit', function (event) {

        if(document.getElementById("design").value == "") {
            alert("Debe seleccionar un archivo");
        } else {
            event.preventDefault();
            var form = new FormData(this);
            $('#addFile').modal('hide');
            $('#savingModal').modal('show');
            currentRequest = $.ajax({
                url: '/addFileWork',
                type: 'POST',
                data: form,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (datos) {
                    /*alert(JSON.stringify(datos));*/
                    $('#savingModal').modal('hide');
                    window.location.replace("/works");

                }, error: function (e) {
                    $('#savingModal').modal('hide');
                    console.log(e);
                    alert("¡Ha habido un error al insertar el diseño en el trabajo" +
                        " intente de nuevamente. Si el error persiste contacte con el equipo técnico");
                }
            });
        }
        
    });
    }