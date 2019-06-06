<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A Pen by  Chandra Shekhar</title>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/sidebarNavigation.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>

<div class="container-fluid">
      <div class="row row-offcanvas row-offcanvas-left">

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div><!--/span-->
        <div class="col-xs-12 col-sm-9 content">
          <p class="pull-left">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
  
  <div class="text-center">
    <h1>Bootstrap forms</h1>
    <p class="lead">Example of a form with 3 columns and labels aligned to the left of the 
      fields at &gt; 1200px (large) screen sizes, 2 columns and labels aligned to the left of the 
      fields at &gt;992px (medium) screen sizes, 2 columns labels above fields at &gt; 768px (small), and single 
      column at &lt; 768px (Extra small). 
    </p>
  </div>
  <form class="form-horizontal" role="form">
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="inputEmail" class="col-md-4 control-label">Email:</label>
          <div class="col-md-8">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="inputPassword" class="col-md-4 control-label">Password:</label>
          <div class="col-md-8">
            <input type="password" class="form-control" id="inputPassword" placeholder="Password">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="inputLabel3" class="col-md-4 control-label">Label 3:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="inputLabel3" placeholder="Label 3">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="inputLabel4" class="col-md-4 control-label">Label 4:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="inputLabel4" placeholder="Label 4">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input5" class="col-md-4 control-label">1234567890:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input5" placeholder="input 5">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input6" class="col-md-4 control-label">123456789012:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input6" placeholder="input 6">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input7" class="col-md-4 control-label">12345678901234:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input7" placeholder="input 7">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input8" class="col-md-4 control-label">1234567890123456:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input8" placeholder="input 8">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input9" class="col-md-4 control-label">123456789012345678:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input9" placeholder="input 9">
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="form-group">
          <label for="input10" class="col-md-4 control-label">12345678901234567890:</label>
          <div class="col-md-8">
            <input type="text" class="form-control" id="input10" placeholder="input 10">
          </div>
        </div>
      </div>
    </div><!-- /.row this actually does not appear to be needed with the form-horizontal -->
  </form>
  <p>Note: label text will occupy as much space as the text takes regardless of the 
      column size, so be sure to validate your spacing.
  </p>
                  </div><!--/span-->

      </div>

</div>

<style>
  body {
  padding-top: 50px;
}
/*
 * Style tweaks
 * --------------------------------------------------
 */
html,
body {
  overflow-x: hidden; /* Prevent scroll on narrow devices */
  height: 100%;
}
body {
  padding-top: 70px;
}
footer {
  padding: 30px 0;
}

/*
 * Off Canvas
 * --------------------------------------------------
 * Greater thav 768px shows the menu by default and also flips the semantics
 * The issue is to show menu for large screens and to hide for small
 * Also need to do something clever to turn off the tabs for when the navigation is hidden
 * Otherwise keyboard users cannot find the focus point
 * (For now I will ignore that for mobile users and also not worry about
 * screen re-sizing popping the menu out.)
 */
@media screen and (min-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all .25s ease-out;
       -moz-transition: all .25s ease-out;
            transition: all .25s ease-out;
  }

  .row-offcanvas-right {
    right: 25%;
  }

  .row-offcanvas-left {
    left: 25%;
  }

  .row-offcanvas-right .sidebar-offcanvas {
    right: -25%; /* 3 columns */
  	background-color: rgb(255, 255, 255);
  }

  .row-offcanvas-left .sidebar-offcanvas {
    left: -25%; /* 3 columns */
  	background-color: rgb(255, 255, 255);
  }

  .row-offcanvas-right.active {
    right: 0; /* 3 columns */
  }

  .row-offcanvas-left.active {
    left: 0; /* 3 columns */
  }

  .row-offcanvas-right.active .sidebar-offcanvas {
  	background-color: rgb(254, 254, 254);
  }
  .row-offcanvas-left.active .sidebar-offcanvas {
  	background-color: rgb(254, 254, 254);
  }

.row-offcanvas .content {
    width: 75%; /* 9 columns */
    -webkit-transition: all .25s ease-out;
       -moz-transition: all .25s ease-out;
            transition: all .25s ease-out;

  }

  .row-offcanvas.active .content {
    width: 100%; /* 12 columns */
  }
       
  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 25%; /* 3 columns */
  }
}
@media screen and (max-width: 767px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all .25s ease-out;
       -moz-transition: all .25s ease-out;
            transition: all .25s ease-out;
  }

  .row-offcanvas-right {
    right: 0;
  }

  .row-offcanvas-left {
    left: 0;
  }

  .row-offcanvas-right
  .sidebar-offcanvas {
    right: -50%; /* 6 columns */
  }

  .row-offcanvas-left
  .sidebar-offcanvas {
    left: -50%; /* 6 columns */
  }

  .row-offcanvas-right.active {
    right: 50%; /* 6 columns */
  }

  .row-offcanvas-left.active {
    left: 50%; /* 6 columns */
  }

  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 50%; /* 6 columns */
  }
}
  </style>
</body>

<script>
  $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    if ($('.sidebar-offcanvas').css('background-color') == 'rgb(255, 255, 255)') {
	    $('.list-group-item').attr('tabindex', '-1');
    } else {
	    $('.list-group-item').attr('tabindex', '');
    }
    $('.row-offcanvas').toggleClass('active');
    
  });
});
  </script>
</html>