$(document).ready(function(){
  changeContentWrapperSize();
});
  
  function changeContentWrapperSize() {
    var sidebarWidth = $('#mySidebar').css('width');
    if(sidebarWidth == "0px") {
      $('#main').css('min-width', '83%');
    } 
    if(sidebarWidth == "230px") {
      $('#main').css('min-width', '100%');
    } 
    //alert(sidebarWidth);
  }