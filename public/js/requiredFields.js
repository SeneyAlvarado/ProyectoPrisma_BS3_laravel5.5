
//por ahora no se está usando, se debería de mejorar para usarse, la idea es poner lo 
//del astrisco rojo (CAMPO REQUERIDO) más fácil y si se desea cambiar todos los asteriscos rojos se
//cambiarían acá de una, aún no se implementa y hay que hacer una super pequeña correcion 
//(hacerlo strong como en gráfica)
$(document).ready(function(){
    $(".required").after("&nbsp;&nbsp;<span style='color:red; font-size: 20px;margin-top:50px;'>*</span>");;
});