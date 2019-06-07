$(document).ready(function(){
    openNav();
})    
function openNav() {
  document.getElementById("mySidebar").style.width = "230px";
  document.getElementById("main").style.marginLeft = "230px";
}

var on =true;
function myFunction() {
  var x = document.getElementById("mySidebar");
  if (on === true) {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
    on = false;
  } else {
    document.getElementById("mySidebar").style.width = "230px";
   document.getElementById("main").style.marginLeft = "230px";
   on =true;
  }
}

function mouseOver() {
  document.getElementById("toggle").style.color = "#A5A5A5";
}