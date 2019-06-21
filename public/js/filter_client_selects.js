$(document).ready(function () {//cleans the search inputs when page is accesed/reloaded
document.getElementById("searchOwnerInput").value = "";
document.getElementById("searchContactInput").value = "";
});

/*
Both function, searchOwner and searchContact make their respective inputs to filter the <option>
at the respective <select> tags, this makes search dynamic for each field.
*/
function searchOwner() {
  // Declare variables
  var input, filter, select, option, i, txtValue;
  input = document.getElementById("searchOwnerInput");//gets the input
  filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
  select = document.getElementById("selectList");//gets the select
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


function searchContact() {
    // Declare variables
    var input, filter, select, option, i, txtValue;
    input = document.getElementById("searchContactInput");//gets the input
    filter = input.value.toUpperCase();//gets the input value and does it upperCase (not sensitive)
    select = document.getElementById("selectList_contact");//gets the select
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