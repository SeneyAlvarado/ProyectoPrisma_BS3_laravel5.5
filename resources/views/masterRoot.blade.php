<!DOCTYPE html>
<html>
<head>

<title>Tryit Editor v3.6</title>
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:image" content="https://www.w3schools.com/images/w3schools_logo.png">
<meta property="og:image:type" content="image/png">
<meta property="og:image:width" content="200">
<meta property="og:image:height" content="200">
<link href="https://fonts.googleapis.com/css?family=Source Code Pro" rel="stylesheet">
<link rel="stylesheet" href="/w3css/4/w3.css">
<link rel="stylesheet" href="/lib/codemirror.css">
<script src="https://cdn.ampproject.org/rtv/011905292322390/amp4ads-host-v0.js"></script><script src="https://www.googletagservices.com/activeview/js/current/osd.js?cb=%2Fr20100101"></script><script src="https://securepubads.g.doubleclick.net/gpt/pubads_impl_rendering_2019053001.js"></script><script src="https://static.h-bid.com/sncmp/sncmp.min.js"></script><script src="https://apis.google.com/_/scs/apps-static/_/js/k=oz.gapi.es._nJdOQIuw-s.O/m=client/rt=j/sv=1/d=1/ed=1/am=wQE/rs=AGLTcCMhIBzvixP4RxpSiRPbRFyIGnJA0Q/cb=gapi.loaded_0" async=""></script><script type="text/javascript" src="https://static.h-bid.com/prebid/2.9.0/prebid.js" async=""></script><script type="text/javascript" async="" src="https://static.h-bid.com/snhb/snhbGlobalSettings.js"></script><script async="" type="text/javascript" src="https://www.googletagservices.com/tag/js/gpt.js"></script><script async="" type="text/javascript" src="https://www.googletagservices.com/tag/js/gpt.js"></script><script async="" src="//www.google-analytics.com/analytics.js"></script><script src="/lib/codemirror.js"></script>
<script src="/lib/codemirror_jsx.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-3855518-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
</script>

<script type="text/javascript">
var k42 = false;
var googletag = googletag || {}; googletag.cmd = googletag.cmd || [];

(function() {
  var gads = document.createElement('script');
  gads.async = true;
  gads.type = 'text/javascript';
  gads.src = 'https://www.googletagservices.com/tag/js/gpt.js';
  var node = document.getElementsByTagName('script')[0];
  node.parentNode.insertBefore(gads, node);
})();

var snhb = snhb || {}; snhb.queue = snhb.queue || [];
snhb.options = {
               logOutputEnabled : false,
               autoStartAuction: false,
               gdpr: {
                     mainGeo: "us",
                     reconsiderationAppealIntervalSeconds: 0
                     }
               };

// GPT slots
var gptAdSlots = [];
googletag.cmd.push(function() {
googletag.pubads().disableInitialLoad();               
googletag.pubads().enableSingleRequest();
  var leaderMapping = googletag.sizeMapping().
  // Mobile ad
  addSize([0, 0], [320, 50]). 
  // Vertical Tablet ad
  addSize([468, 0], [468, 60]). 
  // Horizontal Tablet
  addSize([728, 0], [728, 90]).
  // Desktop and bigger ad
  addSize([970, 0], [[728, 90], [970, 90]]).build();
  // addSize([970, 0], [728, 90]).build();
  gptAdSlots[0] = googletag.defineSlot('/16833175/TryitLeaderboard', [[728, 90], [970, 90]], 'div-gpt-ad-1428407818244-0').
  // gptAdSlots[0] = googletag.defineSlot('/16833175/TryitLeaderboard', [728, 90], 'div-gpt-ad-1428407818244-0').
  defineSizeMapping(leaderMapping).addService(googletag.pubads());
  googletag.pubads().setTargeting("content","try" + (function () {
    var folder = location.pathname;
    folder = folder.replace("/", "");
    folder = folder.substr(0, folder.indexOf("/"));
    return folder;
  })());
});  

</script>
<script src="//static.h-bid.com/sncmp/sncmp_stub.min.js" type="text/javascript"></script>
<script>
			window.__cmp('setLogo', "//www.w3schools.com/images/w3schoolscom_gray.gif", function(result){
	       		snhb.console.log("Logo set");
	    	});
			window.__cmp('setPrivacyPolicy', "//www.w3schools.com/about/about_privacy.asp", function(result){
	       		snhb.console.log("Privacy policy URI set");
	    	});
			window.__cmp('enableBanner', null, function(result) {
	       		snhb.console.log("Banner mode enabled");
			});
			__cmp('enablePopupDismissable', null, function(result) {});
			window.__cmp('disableBannerPrivacyPolicyButton', null, function(result) {
	       		snhb.console.log("Banner mode without privacy policy button enabled");
			});
      window.__cmp('setTranslationFiles', { path: '//www.w3schools.com/lib/', locales: ["en"] }, function(result) {});
      __cmp('setCSS', '//www.w3schools.com/lib/cmp.css', function(result){} );
</script>
<script async="" type="text/javascript" src="//static.h-bid.com/w3schools.com/20190327/snhb-w3schools.com.min.js?20190327"></script>
<script>
  snhb.queue.push(function(){

    snhb.addAdditionalAdSlotsToRefresh(gptAdSlots);

   });
</script>
<script>
if (window.addEventListener) {              
    window.addEventListener("resize", browserResize);
} else if (window.attachEvent) {                 
    window.attachEvent("onresize", browserResize);
}
var xbeforeResize = window.innerWidth;

function browserResize() {
    var afterResize = window.innerWidth;
    if ((xbeforeResize < (970) && afterResize >= (970)) || (xbeforeResize >= (970) && afterResize < (970)) ||
        (xbeforeResize < (728) && afterResize >= (728)) || (xbeforeResize >= (728) && afterResize < (728)) ||
        (xbeforeResize < (468) && afterResize >= (468)) ||(xbeforeResize >= (468) && afterResize < (468))) {
        xbeforeResize = afterResize;
              
        googletag.cmd.push(function() {
            googletag.pubads().refresh([gptAdSlots[0]]);
        });
         
    }
    if (window.screen.availWidth <= 768) {
      restack(window.innerHeight > window.innerWidth);
    }
    fixDragBtn();
    showFrameSize();    
}
var fileID = "";
var loadSave = false;
function getSavedFile() {
    loadSave = true;
    var htmlCode;
    var paramObj = {};
    paramObj.fileid = "";
    fileID = paramObj.fileid;
    var paramA = JSON.stringify(paramObj);
    var httpA = new XMLHttpRequest();
    httpA.open("POST", globalURL, true);
    httpA.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpA.onreadystatechange = function() {
        if(httpA.readyState == 4 && httpA.status == 200) {
            document.getElementById("textareaCode").value = httpA.responseText;
            window.editor.getDoc().setValue(httpA.responseText);
            loadSave = false;
        }
    }
    httpA.send(paramA);   
}

function retheme() {
  var cc = document.body.className;
  if (cc.indexOf("darktheme") > -1) {
    document.body.className = cc.replace("darktheme", "");
  } else {
    document.body.className += " darktheme";
  }
}
</script>
<style>
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
body {
  color:#000000;
  margin:0px;
  font-size:100%;
}
.trytopnav {
  height:40px;
  overflow:hidden;
  min-width:380px;
  position:absolute;
  width:100%;
  top:99px;
  background-color:#f1f1f1;
}
.trytopnav a {
  color:#999999;
}
.w3-bar .w3-bar-item:hover {
  color:#757575 !important;
}
a.w3schoolslink {
  padding:0 !important;
  display:inline !important;
}
a.w3schoolslink:hover,a.w3schoolslink:active {
  text-decoration:underline !important;
  background-color:transparent !important;
}
#dragbar{
  position:absolute;
  cursor: col-resize;
  z-index:3;
  padding:5px;
}
#shield {
  display:none;
  top:0;
  left:0;
  width:100%;
  position:absolute;
  height:100%;
  z-index:4;
}
#framesize span {
  font-family:Consolas, monospace;
}
#container {
  background-color:#f1f1f1;
  width:100%;
  overflow:auto;
  position:absolute;
  top:138px;
  bottom:0;
  height:auto;
}
#textareacontainer, #iframecontainer {
  float:left;
  height:100%;
  width:50%;
}
#textarea, #iframe {
  height:100%;
  width:100%;
  padding-bottom:10px;
  padding-top:1px;
}
#textarea {
  padding-left:10px;
  padding-right:5px;  
}
#iframe {
  padding-left:5px;
  padding-right:10px;  
}
#textareawrapper {
  width:100%;
  height:100%;
  background-color: #ffffff;
  position:relative;
  box-shadow:0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
#iframewrapper {
  width:100%;
  height:100%;
  -webkit-overflow-scrolling: touch;
  background-color: #ffffff;
  box-shadow:0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
#textareaCode {
  background-color: #ffffff;
  font-family: consolas,"courier new",monospace;
  font-size:15px;
  height:100%;
  width:100%;
  padding:8px;
  resize: none;
  border:none;
  line-height:normal;    
}
.CodeMirror.cm-s-default {
  line-height:normal;
  padding: 4px;
  height:100%;
  width:100%;
}
#iframeResult, #iframeSource {
  background-color: #ffffff;
  height:100%;
  width:100%;  
}
#stackV {background-color:#999999;}
#stackV:hover {background-color:#BBBBBB !important;}
#stackV.horizontal {background-color:transparent;}
#stackV.horizontal:hover {background-color:#BBBBBB !important;}
#stackH.horizontal {background-color:#999999;}
#stackH.horizontal:hover {background-color:#999999 !important;}
#textareacontainer.horizontal,#iframecontainer.horizontal{
  height:50%;
  float:none;
  width:100%;
}
#textarea.horizontal{
  height:100%;
  padding-left:10px;
  padding-right:10px;
}
#iframe.horizontal{
  height:100%;
  padding-right:10px;
  padding-bottom:10px;
  padding-left:10px;  
}
#container.horizontal{
  min-height:200px;
  margin-left:0;
}
#tryitLeaderboard {
  overflow:hidden;
  text-align:center;
  margin-top:5px;
  height:90px;
}
  .w3-dropdown-content {width:350px}
  
@media screen and (max-width: 727px) {
  .trytopnav {top:70px;}
  #container {top:108px;}

}
@media screen and (max-width: 467px) {
  .trytopnav {top:60px;}
  #container {top:98px;}
  .w3-dropdown-content {width:100%}
}
@media only screen and (max-device-width: 768px) {
  #iframewrapper {overflow: auto;}
  #container     {min-width:320px;}
  .stack         {display:none;}
  #tryhome       {display:block;}
}

@font-face {
font-family: 'fontawesome';
src:url('../lib/fonts/fontawesome.eot?14663396');
src:url('../lib/fonts/fontawesome.eot?14663396#iefix') format('embedded-opentype'),
    url('../lib/fonts/fontawesome.woff?14663396') format('woff'),
    url('../lib/fonts/fontawesome.ttf?14663396') format('truetype'),
    url('../lib/fonts/fontawesome.svg?14663396#fontawesome') format('svg');
font-weight:normal;
font-style:normal;
}
.fa {
  display:inline-block;
  font:normal normal normal 14px/1 FontAwesome;
  font-size:inherit;
  text-rendering:auto;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  transform:translate(0,0);
}
.fa-2x {
  font-size:2em;
}
.fa-home:before {content: '\e800'; }
.fa-save:before {content: '\e804'; }
.fa-rotate:before {content: '\e813'; }
.fa-menu:before { content: '\f0c9'; }
.fa-adjust:before { content: '\e80b'; }
.loader {
    border: 6px solid #f3f3f3; /* Light grey */
    border-top: 6px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 2s linear infinite;
}
#saveLoader {
    margin:20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
#iframewrapper {
	
}

body.darktheme {
  background-color:rgb(40, 44, 52);
}
body.darktheme #tryitLeaderboard{
  background-color:rgb(40, 44, 52);
}
body.darktheme .trytopnav{
  background-color:#616161;
  color:#dddddd;
}
body.darktheme #container {
  background-color:#616161;
}
body.darktheme .trytopnav a {
  color:#dddddd;
}
body.darktheme ::-webkit-scrollbar {width:12px;height:3px;}
body.darktheme ::-webkit-scrollbar-track-piece {background-color:#000;}
body.darktheme ::-webkit-scrollbar-thumb {height:50px;background-color: #616161;}
body.darktheme ::-webkit-scrollbar-thumb:hover {background-color: #aaaaaa;}
</style>
<!--[if lt IE 8]>
<style>
#textareacontainer, #iframecontainer {width:48%;}
#container {height:500px;}
#textarea, #iframe {width:90%;height:450px;}
#textareaCode, #iframeResult {height:450px;}
.stack {display:none;}
</style>
<![endif]-->
<link rel="preload" href="https://adservice.google.com/adsid/integrator.js?domain=www.w3schools.com" as="script"><script type="text/javascript" src="https://adservice.google.com/adsid/integrator.js?domain=www.w3schools.com"></script><script src="https://securepubads.g.doubleclick.net/gpt/pubads_impl_2019053001.js" async=""></script><link rel="prefetch" href="https://tpc.googlesyndication.com/safeframe/1-0-33/html/container.html">
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="{{asset('css/paneles.css')}}">
<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}">
<script async="" src="//www.google-analytics.com/analytics.js"></script><script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>

<style>
body {
  font-family: "Lato", sans-serif;
}

.sidebar {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 16px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: #f1f1f1;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

#main {
  transition: margin-left .5s;
	position: absolute;
    width:100%;
}
#main2 {
  transition: margin-left .5s;
	padding:10px;
    position: absolute;
    width:100%;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
</head>
<body>

<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="#" class="w3-bar-item">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>

<div id="main">
<header class="w3-container w3-dark-grey">
<div style="display:inline;">
  <div>
    <div style="float:left;margin-top:9px;"><button class="openbtn" onclick="openNav()">☰</button> </div>
    <div style="float:left;margin-left:10px;"><h2>Sistema de monitoreo</h2></div></div>    
</div>
<div style="clear:both"></div>
</header>
   <div id="main2">
  <h2>Collapsed Sidebar</h2>
  <p>Click on the hamburger menu/bar icon to open the sidebar, and push this content to the right.What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

Why do we use it?
It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


Where does it come from?
Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
</div>
   </div>


<script>

$(document).ready(function(){
    openNav();
})
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>
   
</body>
</html> 