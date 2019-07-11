$(document).ready(function () {

	$(".agregar").click(function () {
		$("input.nombre").show();
		$("button.show").show();
	});
});



function myFunction() {
	var x = document.getElementById("myDIV");
	var y = document.getElementById("mybutton");
	var button = document.getElementById("mybutton");

	if (x.style.display === "none") {
		y.style.display = "none";
		x.style.display = "block";
		boton.setBackgroundColor(0xFF00FF00);
	} else {

		x.style.display = "none";
	}
}

function mostarHorario() {
	var x = document.getElementById("ocultar-tabla");
	var y = document.getElementById("mostar-tabla");
	//var button = document.getElementById("mostar-tabla");

	if (x.style.display === "none") {
		//y.style.display ="none";
		x.style.display = "block";
	}
}

function ocultarHorario() {
	var x = document.getElementById("ocultar-tabla");
	x.style.display = "none";
	var y = document.getElementById("Fecha");
	y.style.display = "none";
}

function ocultarUnaTabla() {//Este método oculta unada más una tabla que se tenga de id ocultar-tabla
	var x = document.getElementById("ocultar-tabla");
	x.style.display = "none";
}

function ocultarTablaCitasSugeridas() {//Este método oculta la tabla de citas sugeridas
	var x = document.getElementById("ocultar-tabla-sugeridas");
	x.style.display = "none";
}

function mostarTablaCitasSugeridas() {
	var x = document.getElementById("ocultar-tabla-sugeridas");

	if (x.style.display === "none") {
		//y.style.display ="none";
		x.style.display = "block";
	}
}

$(window).resize(function () {
	var path = $(this);
	var contW = path.width();
	fixResponsiveColumns(contW);
	if (contW >= 751) {
		if (document.getElementsByClassName("sidebar-toggle")[0] != undefined) {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "200px";
		}
	} else {
		if (document.getElementsByClassName("sidebar-toggle")[0] != undefined) {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "-200px";
		}
	}
});
$(document).ready(function () {
	// this fixed the responsive not using all the space when the page loads
	var path = $(window);
	var contW = path.width();
	//alert(contW);
	fixResponsiveColumns(contW);

	$('.dropdown').on('show.bs.dropdown', function (e) {
		$(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
		fixResponsiveColumns(contW);

	});
	$('.dropdown').on('hide.bs.dropdown', function (e) {
		$(this).find('.dropdown-menu').first().stop(true, true).slideUp(300);
		fixResponsiveColumns(contW);

	});
	$("#menu-toggle").click(function (e) {
		e.preventDefault();
		var elem = document.getElementById("sidebar-wrapper");
		left = window.getComputedStyle(elem, null).getPropertyValue("left");
		if (left == "200px") {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "-200px";
		}
		else if (left == "-200px") {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "200px";
		}
	});

	$("#menu-toggle").click(function (e) {
		e.preventDefault();
		var elem = document.getElementById("sidebar-wrapper");
		left = window.getComputedStyle(elem, null).getPropertyValue("left");
		if (left == "200px") {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "-200px";
		}
		else if (left == "-230px") {
			document.getElementsByClassName("sidebar-toggle")[0].style.left = "200px";
		}
	});

});

function fixResponsiveColumns(contW) {
	if (contW >= 751) {
		//alert("a");
		$('#contentDiv').removeClass("col-12");
		if ($('#sidebar-container').hasClass('col-2')) {
			$('#contentDiv').addClass("col-10");
		} else {
			$('#contentDiv').addClass("col-11");
		}
	} else {
		//alert("b");
		$('#contentDiv').removeClass("col-11");
		$('#contentDiv').removeClass("col-10");
		$('#contentDiv').addClass("col-12");
	}
	//end fixing the responsive not using all space
}

function mostarHorarioServicio() {
	var x = document.getElementById("ocultar-tabla");
	var y = document.getElementById("mostar-tabla");
	//var button = document.getElementById("mostar-tabla");

	if (x.style.display === "none") {
		//y.style.display ="none";
		x.style.display = "block";
	}
}

function parsearFecha(datepicked) {
	var fecha = datepicked.split("/");
	var dia = fecha[1];
	var mes = fecha[0];
	var anio = fecha[2];
	return dia + "/" + mes + "/" + anio;
}


