$(document).ready(function () {//cleans the modals when page is accesed/reloaded
    cleanAddWorkModals();
    cleanEditWorkModals();
    cleanExchangeInputs();
    updateByCoin();
});

//This function makes the form validate, do not erase it. 
function formValidation() {
    //here the client and amount inpuuts will be validated
    var table = $('#worksTable').DataTable();
    rowCount = table.rows().count();
    if (rowCount == 0) {
       return alert("Agregue al menos un trabajo a la orden");
    }
    submitForm();
}

//shows add work modal
function showModalWork() {
    loadMaterials();
    activeProductBranch();
    $("#modalWork").modal('show');
}

function addWorkToTable() {
    var priority_add = $("input[name='priority_add']:checked").val();
    priority_add = priority_addTransform(priority_add);//transforms priority_add # into text

    var observation_add = $("#observation_add").val();
    if (isEmptyOrSpaces(observation_add)) {
        return alert("Por favor escriba una observación");
    }
    if (observation_add.length < 5) {
        return alert("Por favor escriba una observación de un mínimo de 5 caracteres");
    }
    if (observation_add.length > 600) {
        return alert("Por favor escriba una observación de un máximo de 600 caracteres");
    }
    var product = $("#product_branch").children("option:selected").val();
    var productName = $("#product_branch").children("option:selected").html();

    if (product == "defecto") {
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
    //alert(priority_add);
    //alert(observation_add);
    //alert(dateInput_add);

    /*var table = document.getElementById("worksTable").getElementsByTagName('tbody')[0];
    var row = table.insertRow(0);

    var td0 = row.insertCell(0);
    var td1 = row.insertCell(1);
    var td2 = row.insertCell(2);
    var td3 = row.insertCell(3);


    td0.innerHTML = dateInput_add;
    td0.id = "date" + rowCount;
    td0.className = "text-center";

    td1.innerHTML = priority_add;
    td1.id = "priority" + rowCount;
    td1.className = "text-center";

*/
    // = $('#worksTable tr').length;

    var table = $('#worksTable').DataTable();

    rowCount = table.rows().count();
    /*if(rowCount != 0) {
        rowCount = rowCount-3;
    }*/
    //alert(rowCount);
    hiden_observation_add = '<input id="observation' + rowCount +
        '" type="hidden" value="' + observation_add + '"></input>'

    /*product_id = '<input id="product' + rowCount +
        '" type="hidden" value="' + product + '"></input>'*/

    hiden_materials = '<input id="materials' + rowCount +
        '" type="hidden" value="' + materials + '"></input>'


    editAndHidden = hiden_observation_add + hiden_materials +
        '<a onClick="loadEditWorkModal(\'' + rowCount + '\')"  class="btn btn-warning style-btn-edit btn-size">Detalles</a>';

    var table = $('#worksTable').DataTable();
    table.rows.add(
        [[dateInput_add, priority_add, productName, editAndHidden]]
    ).draw();

    $("#product" + rowCount).attr("value", product);
    //alert($("#product"+ rowCount).attr("value"));
    //$("#product"+ rowCount).attr("value");

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

    var observation = $("#observation" + rowCount).val();
    //alert(observation);
    $("#observation_edit").val(observation);

    var product = $("#product" + rowCount).attr("value");
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
    document.getElementById("priority_add0").checked = true;
}

function cleanEditWorkModals() {
    document.getElementById("searchProductInput_Edit").value = "";
    document.getElementById("searchOriginInputEdit").value = "";
    $("#observation_edit").val("");
    $("#dateInput_edit").val("");
    $("#destino_edit").empty();
    document.getElementById("priority_edit0").checked = true;
}


//check if param is empty or whitespaces
function isEmptyOrSpaces(str) {
    return str === null || str.match(/^ *$/) !== null;
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

    var priority_edit = $("input[name='priority_edit']:checked").val();
    priority_edit = priority_addTransform(priority_edit);//transforms priority_add # into text

    var observation_edit = $("#observation_edit").val();

    if (observation_edit.length < 5) {
        return alert("Por favor escriba una observación de un mínimo de 5 caracteres");
    }
    if (observation_edit.length > 600) {
        return alert("Por favor escriba una observación de un máximo de 600 caracteres");
    }

    var product = $("#product_branch_edit").children("option:selected").val();
    var productName = $("#product_branch_edit").children("option:selected").html();

    if (product == "defecto") {
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
    $("#observation" + rowCount).val(observation_edit);
    $("#product" + rowCount).attr("value", product);
    $("#product" + rowCount).html(productName);
    $("#materials" + rowCount).val(materials);

    ///////////End inserting new data into row///////////

    $("#modalEditWork").modal('toggle');
    cleanEditWorkModals();
}

function countCharsAddModal(obj) {
    var maxLength = 600;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNumAdd").innerHTML = '<span style="color: red;">Ha excedido el límite de ' + maxLength + ' caracteres</span>';
    } else {
        document.getElementById("charNumAdd").innerHTML = charRemain + ' caracteres restantes';
    }
}

function countCharsEditModal(obj) {
    var maxLength = 600;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);

    if (charRemain < 0) {
        document.getElementById("charNumEdit").innerHTML = '<span style="color: red;">Ha excedido el límite de ' + maxLength + ' caracteres</span>';
    } else {
        document.getElementById("charNumEdit").innerHTML = charRemain + ' caracteres restantes';
    }
}

function cleanExchangeInputs() {
    $("#order_advanced_payment").val("");
    $("#order_total").val("");
}

function submitForm() {
  var urlData = [];
  var works = getWorksData();
  var order = getOrderData();
  urlData.push(order);
  urlData.push(works);
  JSON.stringify(urlData);
  //alert(urlData);
  //alert(order);
  //window.location.replace("/addOrdersWorks/" + data);
  //JSON.stringify(array_horario_servicio));
  $.ajax({
    url: '/addOrdersWorks',
    type: 'POST',
    data: { 'data': urlData, '_token': $('#_token').val() },
    dataType: 'json',
    success: function (datos) {
      window.location.replace("/orders");
      //alert("YAYYYYYYYYYYYYY");
      //alert(datos.data);
     /*$.each(datos, function () {
        $.each(this, function () {
          alert(this);
        })
      })*/
    }, error: function (e) {
      console.log(e);
      alert("¡Ha habido un error al insertar la orden y los trabajos! Verifique los" +
        " datos e intente de nuevo más tarde. Si el error persiste contacte con el equipo técnico");
    }
  });
}

function getWorksData() {
  var date, priority, observation, product, materials, workData;
  var works_array = [];
  var table = $('#worksTable').DataTable();
  rowCount = table.rows().count();
  for (var i = 0; i < rowCount; i++) {

    date = $("#date" + i).html();

    priority = $("#priority" + i).html();
    if (priority != "Posee prioridad") {
      priority = 0;
    } else {
      priority = 1;
    }

    observation = $("#observation" + i).val();
    //alert("la obs es:" + observation);
    product = $("#product" + i).attr("value");
    materials = $("#materials" + i).val();

    workData = {
      date: date, priority: priority, observation: observation,
      product: product, materials: materials
    };
    works_array.push(workData);
    //alert("pbservation en el array: " + workData.observation);
  }
  return JSON.stringify(works_array);
}

function getOrderData() {
  var quotation_number = document.getElementById("quotation_number").value;//gets the input quotation #
  if(isEmptyOrSpaces(quotation_number)){
    quotation_number = -1;
  }
  var order_advanced_payment = $("#order_advanced_payment").val();
  if(isEmptyOrSpaces(order_advanced_payment)){
    order_advanced_payment = -1;
  }

  var order_total = $("#order_total").val();
  if(isEmptyOrSpaces(order_total)){
    order_total = -1;
  }
  var owner = $("#selectList").children("option:selected").val();
  var contact = $("#selectList_contact").children("option:selected").val();
  var coin = $("input[name='coin']:checked").val();
  var exchange_rate;
  if (coin == "0") {
    exchange_rate = 1;
  }
  if (coin == "1") {
    exchange_rate = $("#dolarExchangeRate").val();
  }

  //var advance_payment_add = $("input[name='advance_payment_add']:checked").val();

  var orderArray = [];

  orderArray.push({
    quotation_number: quotation_number, owner: owner, contact: contact,
    order_advanced_payment: order_advanced_payment, order_total: order_total,
    exchange_rate: exchange_rate, coin: coin,
  });
  return JSON.stringify(orderArray);
}

function showConvertedTotal() {

  var quantity = $("#order_total").val();
  if (isNaN(quantity)) {
    return alert("Por favor, digite solo números");
  }
  if (quantity < 0) {
    return alert("Por favor, digite solo números positivos");
  }

  var coin = $("input[name='coin']:checked").val();
  if (coin == "0") {
    document.getElementById("pOrder").style.display = "none";
    $("#pOrder").html("0.00");
  }
  if (coin == "1") {
    document.getElementById("pOrder").style.display = "block";
    colones = calculateDolarExchange(quantity);
    if (isNaN(colones)) {
      alert(colones);
    } else {
      dolarExchangeRate = $("#dolarExchangeRate").val();
      $("#pOrder").html(colones.toFixed(2) + " colones" + "<br> Tipo de cambio: " + dolarExchangeRate);
    }
  }
}

function showConvertedAdvanced() {

  var quantity = $("#order_advanced_payment").val();
  if (isNaN(quantity)) {
    return alert("Por favor, digite solo números");
  }
  if (quantity < 0) {
    return alert("Por favor, digite solo números positivos");
  }

  var coin = $("input[name='coin']:checked").val();
  if (coin == "0") {
    document.getElementById("pAdvanced").style.display = "none";
    $("#pAdvanced").html("0.00");
  }
  if (coin == "1") {
    document.getElementById("pAdvanced").style.display = "block";
    colones = calculateDolarExchange(quantity);
    if (isNaN(colones)) {
      alert(colones);
    } else {
      dolarExchangeRate = $("#dolarExchangeRate").val();
      $("#pAdvanced").html(colones.toFixed(2) + " colones" + "<br> Tipo de cambio: " + dolarExchangeRate);
    }
  }
}



function calculateDolarExchange(colones) {
  var dolarExchangeRate = $("#dolarExchangeRate").val();
  if (isNaN(dolarExchangeRate)) {
    return "Error en la conversión a dólares, el tipo de cambio no es un número válido";
  }
  return (dolarExchangeRate * colones)
}

function updateByCoin() {
  $('input[type=radio][name=coin]').change(function () {
    showConvertedTotal();
    showConvertedAdvanced();
  });
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function submitForm() {
    var urlData = [];
    var works = getWorksData();
    var order = getOrderData();
    urlData.push(order);
    urlData.push(works);
    JSON.stringify(urlData);
    //alert(urlData);
    //alert(order);
    //window.location.replace("/addOrdersWorks/" + data);
    //JSON.stringify(array_horario_servicio));
    $.ajax({
      url: '/addOrdersWorks',
      type: 'POST',
      data: { 'data': urlData, '_token': $('#_token').val() },
      dataType: 'json',
      success: function (datos) {
        window.location.replace("/orders");
        //alert("YAYYYYYYYYYYYYY");
        //alert(datos.data);
       /*$.each(datos, function () {
          $.each(this, function () {
            alert(this);
          })
        })*/
      }, error: function (e) {
        console.log(e);
        alert("¡Ha habido un error al insertar la orden y los trabajos! Verifique los" +
          " datos e intente de nuevo más tarde. Si el error persiste contacte con el equipo técnico");
      }
    });
  }
  
  function getWorksData() {
    var date, priority, observation, product, materials, workData;
    var works_array = [];
    var table = $('#worksTable').DataTable();
    rowCount = table.rows().count();
    for (var i = 0; i < rowCount; i++) {
  
      date = $("#date" + i).html();
  
      priority = $("#priority" + i).html();
      if (priority != "Posee prioridad") {
        priority = 0;
      } else {
        priority = 1;
      }
  
      observation = $("#observation" + i).val();
      //alert("la obs es:" + observation);
      product = $("#product" + i).attr("value");
      materials = $("#materials" + i).val();
  
      workData = {
        date: date, priority: priority, observation: observation,
        product: product, materials: materials
      };
      works_array.push(workData);
      //alert("pbservation en el array: " + workData.observation);
    }
    return JSON.stringify(works_array);
  }
  
  function getOrderData() {
    var quotation_number = document.getElementById("quotation_number").value;//gets the input quotation #
    if(isEmptyOrSpaces(quotation_number)){
      quotation_number = -1;
    }
    var order_advanced_payment = $("#order_advanced_payment").val();
    if(isEmptyOrSpaces(order_advanced_payment)){
      order_advanced_payment = -1;
    }
  
    var order_total = $("#order_total").val();
    if(isEmptyOrSpaces(order_total)){
      order_total = -1;
    }
    var owner = $("#selectList").children("option:selected").val();
    var contact = $("#selectList_contact").children("option:selected").val();
    var coin = $("input[name='coin']:checked").val();
    var exchange_rate;
    if (coin == "0") {
      exchange_rate = 1;
    }
    if (coin == "1") {
      exchange_rate = $("#dolarExchangeRate").val();
    }
  
    //var advance_payment_add = $("input[name='advance_payment_add']:checked").val();
  
    var orderArray = [];
  
    orderArray.push({
      quotation_number: quotation_number, owner: owner, contact: contact,
      order_advanced_payment: order_advanced_payment, order_total: order_total,
      exchange_rate: exchange_rate, coin: coin,
    });
    return JSON.stringify(orderArray);
  }
  
  function showConvertedTotal() {
    var quantity = $("#order_total").val();
    if (isNaN(quantity)) {
      return alert("Por favor, digite solo números");
    }
    if (quantity < 0) {
      return alert("Por favor, digite solo números positivos");
    }
  
    var coin = $("input[name='coin']:checked").val();
    if (coin == "0") {
      document.getElementById("pOrder").style.display = "none";
      $("#pOrder").html("0.00");
    }
    if (coin == "1") {
      document.getElementById("pOrder").style.display = "block";
      colones = calculateDolarExchange(quantity);
      if (isNaN(colones)) {
        alert(colones);
      } else {
        dolarExchangeRate = $("#dolarExchangeRate").val();
        $("#pOrder").html(colones.toFixed(2) + " colones" + "<br> Tipo de cambio: " + dolarExchangeRate);
      }
    }
  }
  
  function showConvertedAdvanced() {
  
    var quantity = $("#order_advanced_payment").val();
    if (isNaN(quantity)) {
      return alert("Por favor, digite solo números");
    }
    if (quantity < 0) {
      return alert("Por favor, digite solo números positivos");
    }
  
    var coin = $("input[name='coin']:checked").val();
    if (coin == "0") {
      document.getElementById("pAdvanced").style.display = "none";
      $("#pAdvanced").html("0.00");
    }
    if (coin == "1") {
      document.getElementById("pAdvanced").style.display = "block";
      colones = calculateDolarExchange(quantity);
      if (isNaN(colones)) {
        alert(colones);
      } else {
        dolarExchangeRate = $("#dolarExchangeRate").val();
        $("#pAdvanced").html(colones.toFixed(2) + " colones" + "<br> Tipo de cambio: " + dolarExchangeRate);
      }
    }
  }
  
  
  
  function calculateDolarExchange(colones) {
    var dolarExchangeRate = $("#dolarExchangeRate").val();
    if (isNaN(dolarExchangeRate)) {
      return "Error en la conversión a dólares, el tipo de cambio no es un número válido";
    }
    return (dolarExchangeRate * colones)
  }
  
  function updateByCoin() {
    $('input[type=radio][name=coin]').change(function () {
      showConvertedTotal();
      showConvertedAdvanced();
    });
  }

  function validateForm() {
    var quotation_number = document.getElementById("quotation_number").value;//gets the input
    if (isNaN(quotation_number)) {
      alert("Digite un número válido en el número de cotización");
      return false;
    }
    var owner = $("#selectList").children("option:selected").val();
    var contact = $("#selectList_contact").children("option:selected").val();
    if (owner == "defecto" || contact == "defecto") {
      alert("Elija correctamente los clientes")
      return false;
    }
    /*var branch = $("#dropBranch").children("option:selected").val();
    if(branch == "defecto"){
        alert("Elija correctamente la sucursal")
        return false;
    }*/

    var quantity = $("#order_total").val();
    if (isNaN(quantity)) {
      return alert("Por favor, en el total de la orden digite solo números");
    }
    if (quantity < 0) {
      return alert("Por favor, en el total de la orden digite solo números positivos");
    }

    quantity = $("#order_advanced_payment").val();
    if (isNaN(quantity)) {
      return alert("Por favor, en el adelanto de pago digite solo números");
    }
    if (quantity < 0) {
      return alert("Por favor, en el adelanto de pago digite solo números positivos");
    }
    return true;
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////