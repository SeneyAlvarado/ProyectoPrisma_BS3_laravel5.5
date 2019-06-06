<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>A Pen by  Chandra Shekhar</title>
  <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/sidebarNavigation.css">
</head>
<body>
<nav class="navbar navbar-inverse sidebarNavigation" data-sidebarClass="navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle left-navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script  src="js/sidebarNavigation.js"></script>

<style>
  body{position:relative}.overlay,.sideMenu{position:fixed;bottom:0}.overlay{top:0;left:-100%;right:100%;margin:auto;background-color:rgba(0,0,0,.4);z-index:998;transition:all ease 20ms}.sideMenu,.sidebarNavigation{z-index:999;margin-bottom:0}.overlay.open{left:0;right:0}.sidebarNavigation .left-navbar-toggle{float:left;margin-right:0;margin-left:15px}.sideMenu{left:-100%;top:52px;transition:all ease-in-out .4s;overflow:hidden;width:100%;max-width:50%}.sideMenu.open{left:0;display:block;overflow-y:auto}.sideMenu ul{margin:0}
  </style>
</body>

<script>
  window.onload=function(){window.jQuery?$(document).ready(function(){$(".sidebarNavigation .navbar-collapse").hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show(),$("body").append("<div class='overlay'></div>"),$(".navbar-toggle").on("click",function(){$(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass")),$(".sideMenu, .overlay").toggleClass("open"),$(".overlay").on("click",function(){$(this).removeClass("open"),$(".sideMenu").removeClass("open")})}),$(window).resize(function(){$(".navbar-toggle").is(":hidden")?$(".sideMenu, .overlay").hide():$(".sideMenu, .overlay").show()})}):console.log("sidebarNavigation Requires jQuery")};
  </script>
</html>
