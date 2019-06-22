$(document).ready(function () {//cleans the modals when page is accesed/reloaded
    cleanAddWorkModals();
    //cleanEditWorkModals();
});

//shows add work modal
function showModalWork() {
        active_product_branch();
        loadMaterials();
        $("#modalWork").modal('show');
    }


function addWorkToTable() {
    var advance_payment_add = $("input[name='advance_payment_add']:checked").val();
    advance_payment_add = advancedPaymentTransform(advance_payment_add);//transforms advanced payment # into text

    var priority_add = $("input[name='priority_add']:checked").val();
    priority_add = priority_addTransform(priority_add);//transforms priority_add # into text

    var observation_add = $("#observation_add").val();

    var dateInput_add = $("#dateInput_add").val();
    if (isEmptyOrSpaces(dateInput_add)) {//if date is empty or just whitespace
        dateInput_add = "Sin definir";
    }
    //alert(advance_payment_add);
    //alert(priority_add);
    //alert(observation_add);
    //alert(dateInput_add);

    var table = document.getElementById("worksTable").getElementsByTagName('tbody')[0];
    var row = table.insertRow(0);

    var td0 = row.insertCell(0);
    var td1 = row.insertCell(1);
    var td2 = row.insertCell(2);
    var td3 = row.insertCell(3);

    rowCount = $('#worksTable tr').length;

    td0.innerHTML = dateInput_add;
    td0.id = "date" + rowCount;
    td0.className = "text-center";

    td1.innerHTML = priority_add;
    td1.id = "priority" + rowCount;
    td1.className = "text-center";

    td2.innerHTML = advance_payment_add;
    td2.id = "payment" + rowCount;
    td2.className = "text-center";


    hiden_observation_add = '<input id="observation' + rowCount +
        '" type="hidden" value="' + observation_add + '"></input>'




    td3.innerHTML = hiden_observation_add + '<a onClick="loadEditWorkModal(\'' + rowCount + '\')"  class="btn btn-warning style-btn-edit btn-size">Editar</a>';
    td3.className = "text-center";

    $("#modalWork").modal('toggle');
    cleanAddWorkModals();
}



function loadEditWorkModal(rowCount) {
    alert(rowCount);

    var date = $("#date" + rowCount).html();
    if (date != "Sin definir") {
        $("#dateInput_edit").val(date);
    }
    var priority = $("#priority" + rowCount).html();
    var payment = $("#payment" + rowCount).html();
    var observation = $("#observation" + rowCount).val();


    alert(date + priority + payment + observation);

    //alert(document.getElementById("worksTable").getElementsByTagName('tbody')[rowCoun]);
    //var row = $("#worksTable").find('tr').eq(rowCount)
    //alert(JSON.stringify(row));
    //alert()
    /*var ary = [];
    $('#worksTable tr').each(function (a, b) {
        var name = $('.attrName', b).text();
        var value = $('.attrValue', b).text();
        ary.push({ Name: name, Value: value });
       
    });
    alert(JSON.stringify( ary));*/

    $("#modalEditWork").modal('show');
}

//cleans the add modal
function cleanAddWorkModals() {
    $("#observation_add").val("");
    $("#dateInput_add").val("");
}

//check if param is empty or whitespaces
function isEmptyOrSpaces(str) {
    return str === null || str.match(/^ *$/) !== null;
}



//transforms advanced payment # into text
function advancedPaymentTransform(advance_payment_add) {
    if (advance_payment_add == "1") {
        return "Posee adelanto";
    }
    if (advance_payment_add == "0") {
        return "Sin adelanto";
    }
}

//transforms priority_add # into text
function priority_addTransform(priority_add) {
    if (priority_add == "1") {
        return "Posee prioridad";
    }
    if (priority_add == "0") {
        return "Sin prioridad";
    }
}


/**Javascrip to fill the list of clients to create a ne order*/
function active_product_branch() {
    $.ajax({
        url: '/active_products_branch',
        type: 'GET',
        dataType: "json",
        success: function (datos) {
            $('#product_branch').empty();
            $('#product_branch').append("<option value='defecto'  selected='selected'>Seleccione un producto</option>");
            $.each(datos, function () {
                $.each(this, function () {
                        $('#product_branch').append('<option value="' + this.id + '">' + this.id + ". " + this.name +'</option>');
                })

            })

        }, error: function () {
            alert("¡Ha habido un error cargando los productos!" +
                " Si este error persiste por favor comuníquese con el equipo técnico");
        }
    });
}

function searchProduct() {
    // Declare variables
    var input, filter, select, option, i, txtValue;
    input = document.getElementById("searchProductInput");//gets the input
    filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
    select = document.getElementById("product_branch");//gets the select
    option = select.getElementsByTagName("option");//gets the option
  
  // Loop through all select options, and hide those who don't match the search query
  for (i = 0; i < option.length; i++) {
        txtValue = option[i].textContent || option[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          option[i].style.display = "";
        } else {
          option[i].style.display = "none";
        }
    }
  }