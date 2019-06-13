<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

	<!-- Bootstrap core CSS 
		  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
	
	<link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/glyphicons.css')}}">
    <script src="{{asset('js/menus_dinamicos.js')}}"></script>
    
	
	<script src="{{asset('js/app.min.js')}}"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">


<style>
#body-row {
    margin-left:0;
    margin-right:0;
}
#sidebar-container {
    min-height: 90.6vh;   
    background-color: #96183a;
    padding: 0;
}

/* Sidebar sizes when expanded and expanded */
.sidebar-expanded {
    width: 230px;
}
.sidebar-collapsed {
    width: 60px;
}

/* Menu item*/
#sidebar-container .list-group a {
    height: 50px;
    color: white;
}

/* Submenu item*/
#sidebar-container .list-group .sidebar-submenu a {
    height: 45px;
    padding-left: 30px;
}
.sidebar-submenu {
    font-size: 0.9rem;
}

/* Separators */
.sidebar-separator-title {
    background-color: white !important;
    height: 35px;
}
.sidebar-separator {
    background-color: white;
    height: 25px;
}
.logo-separator {
    background-color: #96183a;    
    height: 60px;
}

/* Closed submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="false"] .submenu-icon::after {
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}
/* Opened submenu icon */
#sidebar-container .list-group .list-group-item[aria-expanded="true"] .submenu-icon::after {
  font-family: FontAwesome;
  display: inline;
  text-align: right;
  padding-left: 10px;
}

.nav-color {
    background-color: #821633 !important;  
}

.sidebar-expanded a:hover {
    background: #333333 !important;
   
  }

  .sidebar-expanded {
    background-color: #96183a !important;  
    
  }

  .sidebar-color{
    background-color: #96183a !important;  
  }

  .sidebar-color-collapse{
    background-color: #821633 !important;  
  }

  .borders {
    border-bottom: 1px #e5e5e5 solid !important;
    width: 230px;
    box-shadow: 0px 0px 0px black;
  }

  .active-collapse {
    background-color: #333333 !important;
  }

  .borders {
    display: inline-block;
    width: 70px;
    height: 70px;
    margin: 6px;
  }

  
</style>
</head>

<body>
<nav class="navbar nav-color navbar-expand-md navbar-dark bg-primary border border-left-0 border-top-0 border-right-0 border-light" style="box-shadow: 0px 0px 15px black;">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
    <img src="{{asset('Imagenes/logo.png')}}" width="35" height="35" class="d-inline-block align-top"></div>  
 
    <span class="menu-collapsed">Grupo Prisma</span>
  </a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" style="margin-left:35px;" href="#"><span class="glyphicon glyphicon-menu-left"><span class="glyphicon glyphicon-menu-left"></span></a>
      </li>
      
      <!-- This menu is hidden in bigger devices with d-sm-none. 
           The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
      <li class="border nav-item dropdown d-sm-block d-md-none">
        <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menú
        </a>
        <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
            <a class="dropdown-item" href="#">Trabajos</a>
            <a class="dropdown-item" href="#">Estados</a>
            <a class="dropdown-item" href="#">Cuentas</a>
        </div>
      </li><!-- Smaller devices menu END -->
      
    </ul>
  </div>
</nav><!-- NavBar END -->


<!-- Bootstrap row -->
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="border border-left-0 border-top-0 border-right-0 border-light sidebar-color list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="glyphicon glyphicon-folder-open fa-fw mr-3"></span> 
                    <span class="menu-collapsed">Trabajos</span>
                    <span class="glyphicon glyphicon-menu-down submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class=" list-group-item list-group-item-action sidebar-color-collapse text-white">
                    <span class="menu-collapsed">Visualizar</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action sidebar-color-collapse text-white">
                    <span class="menu-collapsed">Estados</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action sidebar-color-collapse text-white">
                    <span class="menu-collapsed">Materiales</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action sidebar-color-collapse sidebar-color text-white">
                    <span class="menu-collapsed">Productos</span>
                </a>
            </div>
              
            <a href="#" class="sidebar-color  list-group-item list-group-item-action border border-left-0 border-right-0 border-light" >
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="glyphicon glyphicon-user fa-fw mr-3"></span>
                    <span class=" menu-collapsed">Clientes</span>    
                </div>
            </a>

            <!-- /END Separator -->
            <a href="{{ url('admin_accounts_index') }}" class="border border-left-0 border-right-0 border-light sidebar-color  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="glyphicon glyphicon-list fa-fw mr-3"></span>
                    <span class="menu-collapsed">Cuentas</span>
                </div>
            </a>
            <a href="#" class="sidebar-color border border-light border-left-0 border-right-0 list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="glyphicon glyphicon-file fa-fw mr-3"></span>
                    <span class="menu-collapsed">Visitas</span>
                </div>
            </a>

            <a href="#" data-toggle="sidebar-colapse" class="border border-left-0 border-right-0 border-light active-collapse sidebar-color  list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="glyphicon glyphicon-resize-horizontal fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Desplegar</span>
                </div>
            </a>
            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">
             	
                <!-- <img src='https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg' width="30" height="30" />  -->  
            </li>   
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col">
<br>
        <div class="card">
            <h4 class="card-header">Requirements</h4>
            <div class="card-body">
                <ul>
                    <li>JQuery</li>
                    <li>Bootstrap 4 beta-3</li>
                </ul>
            </div>
        </div>
       
    </div><!-- Main Col END -->
</div><!-- body-row END -->

  <!-- Menu Toggle Script -->
  <script>
// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
  </script>

</body>

</html>