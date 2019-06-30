<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistema de Monitoreo de Procesos - Grupo Prisma</title>
  <!-- Bootstrap core CSS 
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="{{asset('css/simple-sidebar.css')}}">
  <link rel="stylesheet" href="{{asset('css/master-root.css')}}">
  <link rel="stylesheet" href="{{asset('css/glyphicons.css')}}">
  <link rel="shortcut icon" href="Imagenes/log.ico" />

  <!--resizes table so the content won´t go down -->
  <link rel="stylesheet" href="{{asset('css/table.css')}}">

  <!-- align added button to Jquery datatable-->
  <link rel="stylesheet" href="{{asset('css/custom-button-datatable.css')}}">

  <!--<script src="{{asset('js/master-root.js')}}"></script>-->

  <script src="{{asset('js/app.min.js')}}"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="css/simple-sidebar.css" rel="stylesheet">

  <script src="{{asset('js/menus_dinamicos.js')}}"></script>
  <!-- helps to add the right route to create buttons-->
  <script src="{{asset('js/customButtonDatatable.js')}}"></script>

  <!-- notifications js handling-->
  <script src="{{asset('js/notifications.js')}}"></script>

  <!-- notifications js handling-->
  <script src="{{asset('/js/dropdownDoubleClickFix.js')}}"></script>

</head>

<body>
  <nav class="navbar nav-color navbar-expand-md navbar-dark bg-primary border border-left-0 border-top-0 border-right-0 border-light">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav">
      <li class="nav-item a active">
        <button class="btn btn-default style-return-button" onclick="history.back()"><span class="glyphicon glyphicon-menu-left"></span></button>
      </li>
    </ul>
    <a class="navbar-brand" href="#">
      <img src="{{asset('Imagenes/logo.png')}}" width="35" height="35" class="d-inline-block align-top"></div>
      <span class="">Grupo Prisma</span>
    </a>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">


        <!-- This menu is hidden in bigger devices with d-sm-none. 
        The sidebar isn't proper for smaller screens imo, so this dropdown menu can keep all the useful sidebar itens exclusively for smaller screens  -->
        <!-- <li class=" nav-item dropdown d-sm-block d-md-none">Menú
          <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Menú
          </a>
          <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
            <a class="dropdown-item" href="#">Trabajos</a>
            <a class="dropdown-item" href="{{url('states')}}">Estados</a>
            <a class="dropdown-item" href="{{url('states')}}">Materiales</a>
            <a class="dropdown-item" href="{{url('states')}}">Productos</a>
            <a class="dropdown-item" href="{{route('orders')}}">Órdenes</a>
            <a class="dropdown-item" href="{{route('clients')}}">Clientes</a>
            <a class="dropdown-item" href="{{ url('user') }}">Cuentas</a>
            <a class="dropdown-item" href="{{url('visits')}}">Visitas</a>
            <a class="dropdown-item" href="{{url('branch')}}">Sucursales</a>
          </div>
        </li><!-- Smaller devices menu END -->
        <ul class=" nav-item dropdown d-sm-block d-md-none">Menú
          <!-- <li class=" nav-item dropdown d-sm-block d-md-none">Menú -->
            <a class="nav-link dropdown-toggle" href="#" id="smallerscreenmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Trabajos
            </a>
            <div class="dropdown-menu" aria-labelledby="smallerscreenmenu">
              <a class="dropdown-item" href="{{url('states')}}">Estados</a>
              <a class="dropdown-item" href="{{route('materials')}}">Materiales</a>
              <a class="dropdown-item" href="{{route('products')}}">Productos</a>
            </div>
            <li><a class="dropdown-item" href="{{route('orders')}}">Órdenes</a></li>
            <li><a class="dropdown-item" href="{{route('clients')}}">Clientes</a></li>
            <li><a class="dropdown-item" href="{{ url('user') }}">Cuentas</a></li>
            <li><a class="dropdown-item" href="{{url('visits')}}">Visitas</a></li>
            <li><a class="dropdown-item" href="{{url('branch')}}">Sucursales</a></li>
        </ul>
        <!--</li>-->

      </ul>
    </div>

    <div class="dropdown" style="margin-right: 4vw">
      <button type="button" onclick="markReadNotifications()" class="btn btn-default dropdown-toggle style-name-button" data-target="#dropmenu-notifications" data-toggle="dropdown">Notificaciones &nbsp;
        <span class="glyphicon glyphicon-bell fa-fw mr-3"></span>
        <span id="numberNotification" class="badge">0</span>
      </button>
      <div class="dropdown-menu" id="dropmenu-notifications" style="max-height:157px; overflow:auto;">
      </div>
    </div>

    <div class="dropdown" style="margin-right: 4vw">
      <button type="button" class="btn btn-default dropdown-toggle style-name-button" data-toggle="dropdown" data-target="#dropmenu-user">
        {{ auth()->user()->name . " " . auth()->user()->lastname}}
      </button>
      <div class="dropdown-menu" id="dropmenu-user">
        <a class="dropdown-item" href="{{ url('change_password.search_user') }}">Cambiar contraseña</a>
        <a class="dropdown-item" href="{{ url('/logout') }}">Cerrar sesión</a>
      </div>
    </div>

  </nav><!-- NavBar END -->

  <!-- Bootstrap row -->
  <div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-2">
      <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
      <!-- Bootstrap List Group -->
      <ul class="list-group ">
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
          <a href="{{route('works.index')}}" class=" list-group-item list-group-item-action sidebar-color-collapse text-white">
            <span class="menu-collapsed">Visualizar</span>
          </a>
          <a href="{{url('states')}}" class="list-group-item list-group-item-action sidebar-color-collapse text-white">
            <span class="menu-collapsed">Estados</span>
          </a>
          <a href="{{route('materials')}}" class="list-group-item list-group-item-action sidebar-color-collapse text-white">
            <span class="menu-collapsed">Materiales</span>
          </a>
          <a href="{{route('products')}}" class="list-group-item list-group-item-action sidebar-color-collapse sidebar-color text-white">
            <span class="menu-collapsed">Productos</span>
          </a>
        </div>
        <a href="{{route('orders')}}" class="border border-left-0 border-right-0 border-light sidebar-color  list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="glyphicon glyphicon-edit fa-fw mr-3"></span>
            <span class="menu-collapsed">Órdenes</span>
          </div>
        </a>
        <a href="{{route('clients')}}" class="sidebar-color  list-group-item list-group-item-action border border-left-0 border-right-0 border-light">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="glyphicon glyphicon-user fa-fw mr-3"></span>
            <span class=" menu-collapsed">Clientes</span>
          </div>
        </a>
        <a href="{{ url('user') }}" class="border border-left-0 border-right-0 border-light sidebar-color  list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="glyphicon glyphicon-list fa-fw mr-3"></span>
            <span class="menu-collapsed">Cuentas</span>
          </div>
        </a>
        <a href="{{url('visits')}}" class="sidebar-color border border-light border-left-0 border-right-0 list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="glyphicon glyphicon-file fa-fw mr-3"></span>
            <span class="menu-collapsed">Visitas</span>
          </div>
        </a>
        <a href="{{url('branch')}}" class="sidebar-color border border-light border-left-0 border-right-0 list-group-item list-group-item-action">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="glyphicon glyphicon-flag fa-fw mr-3"></span>
            <span class="menu-collapsed">Sucursales</span>
          </div>
        </a>
        <a href="#" data-toggle="sidebar-colapse" class="border border-left-0 border-right-0 border-light active-collapse sidebar-color  list-group-item list-group-item-action d-flex align-items-center">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span id="collapse-icon" class="glyphicon glyphicon-resize-horizontal fa fa-2x mr-3"></span>
            <span id="collapse-text" class="menu-collapsed">Cerrar menú</span>
          </div>
        </a>
        <!-- Logo -->
        <li class="list-group-item logo-separator d-flex justify-content-center">
          <!-- <img src='https://v4-alpha.getbootstrap.com/assets/brand/bootstrap-solid.svg' width="30" height="30" />  -->
        </li>
      </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div id="contentDiv" class="col-10 container-fluid size-changer">

      @if(session('error'))
      <div class="alert alert-danger alert-dismissible" style="text-align: center; padding:20px;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{@session('error')}}
      </div>
      @endif
      @if(session('success'))
      <div class="alert alert-success alert-dismissible" style="text-align: center; margin-top:10px; 
                    margin-left:10px; margin-right:10px;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{@session('success')}}
      </div>
      @endif
      @if(session('info'))
      <div class="alert alert-info alert-dismissible" style="text-align: center;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        {{@session('info')}}
      </div>
      @endif
      @yield('contenido_Admin')

    </div><!-- Main Col END -->
  </div><!-- body-row END -->

  <script>
    // Hide submenus
    $('#body-row .collapse').collapse('hide');

    // Collapse/Expand icon
    $('#collapse-icon').addClass('fa-angle-double-left');

    // Collapse click
    $('[data-toggle=sidebar-colapse]').click(function() {
      SidebarCollapse();
    });

    function SidebarCollapse() {
      $('.menu-collapsed').toggleClass('d-none');
      $('.sidebar-submenu').toggleClass('d-none');
      $('.submenu-icon').toggleClass('d-none');
      $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

      if ($('#sidebar-container').hasClass('sidebar-expanded')) {
        $('#sidebar-container').removeClass("col-xs-1").addClass("col-2");
        $('#contentDiv').removeClass("col-11").addClass("col-10");
      } else {
        $('#sidebar-container').removeClass("col-2").addClass("col-xs-1");
        $('#contentDiv').removeClass("col-10").addClass("col-11");
      }

      // Treating d-flex/d-none on separators with title
      var SeparatorTitle = $('.sidebar-separator-title');
      if (SeparatorTitle.hasClass('d-flex')) {
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