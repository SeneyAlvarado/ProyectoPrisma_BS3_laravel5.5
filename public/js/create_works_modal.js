$(document).ready(function () {//cleans the modals when page is accesed/reloaded
    cleanAddWorkModals();
    cleanEditWorkModals();
});

//shows add work modal
function showModalWork() {
    loadMaterials();
    activeProductBranch();
    $("#modalWork").modal('show');
}

function addWorkToTable() {
    var advance_payment_add = $("input[name='advance_payment_add']:checked").val();
    advance_payment_add = advancedPaymentTransform(advance_payment_add);//transforms advanced payment # into text

    var priority_add = $("input[name='priority_add']:checked").val();
    priority_add = priority_addTransform(priority_add);//transforms priority_add # into text

    var observation_add = $("#observation_add").val();
    if(isEmptyOrSpaces(observation_add)){
        return alert("Por favor escriba una observación");
    }
    if(observation_add.length < 5){
        return alert("Por favor escriba una observación de un mínimo de 5 caracteres");
    }
    if(observation_add.length > 600){
        return alert("Por favor escriba una observación de un máximo de 600 caracteres");
    }
    var product = $("#product_branch").children("option:selected").val();

    if(product == "defecto") {
        return alert("Por favor seleccione un producto");
    }

    var materials = [];
    $("#destino option").each(function () {
        if ($(this).val() != "defecto") {
            materials.push($(this).val());
        }
    });

    var dateInput_add = $("#dateInput_add").val();
    if (isEmptyOrSpaces(dateInput_add)) {//if date is empty or just whitespace
        return alert("Por favor seleccione una fecha válida");
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

    hiden_product_id = '<input id="product' + rowCount +
        '" type="hidden" value="' + product + '"></input>'

    hiden_materials = '<input id="materials' + rowCount +
        '" type="hidden" value="' + materials + '"></input>'


    td3.innerHTML = hiden_observation_add + hiden_product_id + hiden_materials +
        '<a onClick="loadEditWorkModal(\'' + rowCount + '\')"  class="btn btn-warning style-btn-edit btn-size">Editar</a>';
    td3.className = "text-center";

    $("#modalWork").modal('toggle');
    cleanAddWorkModals();
}



function loadEditWorkModal(rowCount) {

    cleanEditWorkModals();

    var date = $("#date" + rowCount).html();
    if (date != "Sin definir") {
        $("#dateInput_edit").val(date);
    }
    var priority = $("#priority" + rowCount).html();
    if (priority != "Posee prioridad") {
        document.getElementById("priority_edit0").checked = true;
    } else {
        document.getElementById("priority_edit1").checked = true;
    }

    var payment = $("#payment" + rowCount).html();
    if (payment != "Posee adelanto") {
        document.getElementById("payment_edit0").checked = true;
    } else {
        document.getElementById("payment_edit1").checked = true;
    }

    var observation = $("#observation" + rowCount).val();
    //alert(observation);
    $("#observation_edit").val(observation);

    var product = $("#product" + rowCount).val();
    //alert("product " + product);
    activeProductBranchSelected(product);

    var materials = $("#materials" + rowCount).val();
    loadMaterialsSelected(materials);


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
    $("#editRow").val(rowCount);
    $("#modalEditWork").modal('show');
}

//cleans the add modal
function cleanAddWorkModals() {
    document.getElementById("searchProductInput").value = "";
    document.getElementById("searchOriginInputAdd").value = "";
    $("#observation_add").val("");
    $("#dateInput_add").val($("#hiddenDateCR").val());
    $("#destino").empty();
    document.getElementById("payment_add0").checked = true;
    document.getElementById("priority_add0").checked = true;
}

function cleanEditWorkModals() {
    document.getElementById("searchProductInput_Edit").value = "";
    document.getElementById("searchOriginInputEdit").value = "";
    $("#observation_edit").val("");
    $("#dateInput_edit").val("");
    $("#destino_edit").empty();
    document.getElementById("payment_edit0").checked = true;
    document.getElementById("priority_edit0").checked = true;
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


function searchProductEdit() {
    // Declare variables
    var input, filter, select, option, i, txtValue;
    input = document.getElementById("searchProductInputEdit");//gets the input
    filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
    select = document.getElementById("product_branch_edit");//gets the select
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

function searchOriginAdd() {
    // Declare variables
    var input, filter, select, option, i, txtValue;
    input = document.getElementById("searchOriginInputAdd");//gets the input
    filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
    select = document.getElementById("origen");//gets the select
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

function searchOriginEdit() {
    // Declare variables
    var input, filter, select, option, i, txtValue;
    input = document.getElementById("searchOriginInputEdit");//gets the input
    filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
    select = document.getElementById("origen_edit");//gets the select
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


function updateWork() {
    var rowCount = $("#editRow").val();

    //Gets all modal edit values
    var dateInput_edit = $("#dateInput_edit").val();
    if (isEmptyOrSpaces(dateInput_edit)) {//if date is empty or just whitespace
        return alert("Por favor seleccione una fecha válida");
    }
    var advance_payment_edit = $("input[name='advance_payment_edit']:checked").val();
    advance_payment_edit = advancedPaymentTransform(advance_payment_edit);//transforms advanced payment # into text

    var priority_edit = $("input[name='priority_edit']:checked").val();
    priority_edit = priority_addTransform(priority_edit);//transforms priority_add # into text

    var observation_edit = $("#observation_edit").val();

    if(observation_edit.length < 5){
        return alert("Por favor escriba una observación de un mínimo de 5 caracteres");
    }
    if(observation_edit.length > 600){
        return alert("Por favor escriba una observación de un máximo de 600 caracteres");
    }

    var product = $("#product_branch_edit").children("option:selected").val();

    if(product == "defecto") {
        return alert("Por favor seleccione un producto");
    }

    var materials = [];
    $("#destino_edit option").each(function () {
        if ($(this).val() != "defecto") {
            materials.push($(this).val());
        }
    });

 //////////////Inserting new data into row////////////

    $("#date" + rowCount).html(dateInput_edit);
    $("#priority" + rowCount).html(priority_edit);
    $("#payment" + rowCount).html(advance_payment_edit);
    $("#observation" + rowCount).val(observation_edit);
    $("#product" + rowCount).val(product);
    $("#materials" + rowCount).val(materials);

 ///////////End inserting new data into row///////////

    $("#modalEditWork").modal('toggle');
    cleanEditWorkModals();
}

function countCharsAddModal(obj){
    var maxLength = 600;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNumAdd").innerHTML = '<span style="color: red;">Ha excedido el límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNumAdd").innerHTML = charRemain+' caracteres restantes';
    }
}

function countCharsEditModal(obj){
    var maxLength = 600;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNumEdit").innerHTML = '<span style="color: red;">Ha excedido el límite de '+maxLength+' caracteres</span>';
    }else{
        document.getElementById("charNumEdit").innerHTML = charRemain+' caracteres restantes';
    }
}