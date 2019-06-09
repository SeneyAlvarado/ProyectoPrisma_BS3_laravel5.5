<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Collapsible sidebar using Bootstrap 3</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
        <style>
          body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 8px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 0px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */
.wrapper {
    display: flex;
    align-items: stretch;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    background: #464647;
    color: #fff;
    transition: all 0.3s;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 5px;
    background: black;
}

#sidebar ul.components {
    padding: 0px 0;
    border-bottom: 1px solid #FFFFFF;
}
#sidebar li.border {
    padding: 0px 0;
    border-bottom: 1px solid #FFFFFF;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #464647;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #464647;
}


a[data-toggle="collapse"] {
    position: relative;
}

a[aria-expanded="false"]::before, a[aria-expanded="true"]::before {
    content: '\e259';
    display: block;
    position: absolute;
    right: 20px;
    font-family: 'Glyphicons Halflings';
    font-size: 0.6em;
}
a[aria-expanded="true"]::before {
    content: '\e260';
}


ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #464647;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #464647;
}

a.article, a.article:hover {
    background: #464647 !important;
    color: #fff !important;
}



/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
#content {
    min-height: 100vh;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse span {
        display: none;
    }
}

         </style> 
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <h3 style="text-align:center">S.M.P</h3>
                </div>

                <ul class="list-unstyled components">
                    <li class="border">
                        <a href="#">Cuentas</a>
                    </li>
                    <li class="border">
                        <a href="#">Clientes</a>
                    </li>
                    <li class="border">
                        <a href="#">Estados</a>
                    </li>
                    <li class="border">
                        <a href="#">Trabajos</a>
                    </li>
                    <li class="border">
                        <a href="#">Contraseña</a>
                    </li>
                    <li>
                        <a href="#">Salir</a>
                    </li>
                </ul>
            </nav>

            

            <!-- Page Content Holder -->
            <div id="content" style="width:100%" >
            <nav class="navbar navbar-default" style="background-color:#96183a">
                    <div class="container-fluid">

                        <div class="navbar-header" >
                            <button type="button" style="background-color:transparent !important; border:1px; border-color:white;border-style: solid;" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i style="font-size:20px;" class="glyphicon glyphicon-menu-hamburger"></i>  
                            </button>
                        </div>
                    </div>
                </nav>
                <div style="padding:10px">
                  @yield('contenido_Admin')	
                  @if(session('error'))
                  <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  {{@session('error')}}
                  </div>
                  @endif
              </div>
            </div>



              
        </div>

        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });

             $(document).ready(function () {

$("#sidebar").mCustomScrollbar({
    theme: "minimal"
});

// when opening the sidebar
$('#sidebarCollapse').on('click', function () {
    // open sidebar
    $('#sidebar').addClass('active');
    // fade in the overlay
    $('.overlay').fadeIn();
    $('.collapse.in').toggleClass('in');
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
});


// if dismiss or overlay was clicked
$('#dismiss, .overlay').on('click', function () {
  // hide the sidebar
  $('#sidebar').removeClass('active');
  // fade out the overlay
  $('.overlay').fadeOut();
});
});
         </script>
    </body>
</html>