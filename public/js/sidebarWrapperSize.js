$(document).ready(function(){
  changeContentWrapperSize();
});
  
  function changeContentWrapperSize() {
    var sidebarWidth = $('#mySidebar').css('width');
    if(sidebarWidth == "0px") {
      $('#main').css('min-width', '81.5%');
    } 
    if(sidebarWidth == "230px") {
      $('#main').css('min-width', '98.5%');
    } 
    //alert(sidebarWidth);
  }