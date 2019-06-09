<!DOCTYPE html>
<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<style>
  body {
    overflow-x: hidden;
 }

/* Toggle Styles */

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.6s ease;
    -moz-transition: all 0.6s ease;
    -o-transition: all 0.6s ease;
    transition: all 0.6s ease;
    
}

#wrapper.toggled {
    padding-left: 200px;
}

#sidebar-wrapper {
    z-index: 1000;
    position: fixed;
    left: 250px;
    
    width: 0;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    background-color:#312A25 !Important;
   
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 0;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 10px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-left:-250px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    top: 0;
    right:15px;
    width: 200px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: #312A25;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 220px;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 200px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 40px;
        
        
    }

#wrapper.toggled span {
        visibility:hidden;
        
    }
  #wrapper.toggled   i {
 float:right;
 } 

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}


@media(max-width:414px) {

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right:60px;
}

#wrapper.toggled {
    padding-right: 60px;
}

 #wrapper {
        padding-left: 20px;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 50px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 140px;
        
        
    }
    
    #wrapper.toggled span {
        visibility:visible;
        position:relative;
        left:70px;
        bottom:13px;
        
    }

#wrapper span {
        visibility:hidden;
        
    }
  #wrapper.toggled   i {
 float:right;
 } 
 
  #wrapper   i {
 float:right;
 } 

    #page-content-wrapper {
        padding: 5px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }




}
  </style>
</head>
<div class="container">
	<div class="row">
		<h2>Some text</h2>
		<hr/>
		
		 <div id="wrapper">
        
    

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" style="margin-left:0;">
                <li class="sidebar-brand">
                    
                        <a href="#menu-toggle"  id="menu-toggle" style="margin-top:20px;float:right;" > <i class="fa fa-bars " style="font-size:20px !Important;" aria-hidden="true" aria-hidden="true"></i> 
                    
                </li>
                <li>
                    <a href="#"><i class="fa fa-sort-alpha-asc " aria-hidden="true"> </i> <span style="margin-left:10px;">Section</span>  </a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-play-circle-o " aria-hidden="true"> </i> <span style="margin-left:10px;"> Section</span> </a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-puzzle-piece" aria-hidden="true"> </i> <span style="margin-left:10px;"> Section</span> </a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-font" aria-hidden="true"> </i> <span style="margin-left:10px;"> Section</span> </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-info-circle " aria-hidden="true"> </i> <span style="margin-left:10px;">Section </span> </a>
                </li>
                <li>
                    <a href="#"> <i class="fa fa-comment-o" aria-hidden="true"> </i> <span style="margin-left:10px;"> Section</span> </a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        
                         
                        
</a>


                    
        
        <!-- /#page-content-wrapper -->

   
    <!-- /#wrapper -->

    
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</html>