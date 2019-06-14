function redirectCreate() {
    
    var url = window.location.pathname;
    var filename = url.substring(url.lastIndexOf('/')+1);

    window.location.href = '/' + filename + ".create"; 
}
