var currentTab = 0;
$(document).ready(function () {//cleans the modals when page is accesed/reloaded
  showTab(currentTab); // Display the current tab
});


function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    //document.getElementById("prevBtn").style.display = "none";
    $('#prevBtn').attr('disabled', 'disabled');
  } else {
    //document.getElementById("prevBtn").style.display = "inline";
    $('#prevBtn').removeAttr('disabled');
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Guardar";
  } else {
    document.getElementById("nextBtn").innerHTML = "Siguiente";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
  //alert(currentTab);

}

function nextPrev(n) {

  //If the button text is "Guardar" (last page of the form) calls the validateLastTab and submit method;
  if (n == 1 && (($('#nextBtn').html()) == "Guardar")) {
    var table = $('#worksTable').DataTable();
    rowCount = table.rows().count();
    if (rowCount > 0) {
      submitForm();
    } else {
      alert("Agregue al menos un trabajo a la orden");
      return false;
    }
  }

  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  //alert("tabs: " + x)
  //alert("current: " + currentTab)
  if (n == -1) {
    $("nextBtn").removeAttr("type");
    step = document.getElementsByClassName("step");
    step[currentTab - 1].className = step[currentTab - 1].className.replace("finish", " active");
  }

  if (n == 1 && !validateForm()) {
    return false;
  }
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  //var valid = true;

  if (currentTab == 0) {

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

    return correctValidation();

  }
}

function correctValidation() {
  document.getElementsByClassName("step")[currentTab].className += " finish";
  return true;
}


function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
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