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
    $('#prevBtn').attr('disabled','disabled');
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
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  //alert("tabs: " + x)
  //alert("current: " + currentTab)
  if(n == -1) {
    step = document.getElementsByClassName("step");
    step[currentTab-1].className = step[currentTab-1].className.replace("finish", " active");
  }

  if (n == 1 && !validateForm() ){
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

  if(currentTab == 0) {
    
    var owner = $("#selectList").children("option:selected").val();
    var contact = $("#selectList_contact").children("option:selected").val();
    if(owner == "defecto" || contact == "defecto"){
        alert("Elija correctamente los clientes")
        return false;
    }
    var branch = $("#dropBranch").children("option:selected").val();
    if(branch == "defecto"){
        alert("Elija correctamente la sucursal")
        return false;
    }

    return correctValidation();
    
  }

  /*
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");


  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status*/
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