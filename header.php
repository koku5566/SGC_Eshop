<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  position: fixed;
  top: 0;
  width: 100%;
  display: block;
  transition: top 0.3s;
  min-height:100px;
  overflow: hidden;
  background-color: white;
}

.header a {
  float: left;
  display: block;
  color: grey;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.header a:hover {
  color: black;
}

.header a.active {
  background-color: #04AA6D;
  color: black;
}

.header-right {
  float: right;
}

.header .icon {
  display: block;
}

@media screen and (max-width: 600px) {
  .header a.logo {
    display: none;
  }
  .header a.icon {
    float: right;
  }

  .header-right {
    float: none;
  }
}

</style>
</head>
<body>

<div class="header" id="myheader">
  <div class="header-logo">
    <a href="#home" class="logo">
      <img src="img/segilogo.png" width="200px" height="69px" alt="">
    </a>
 </div>

  <div class="header-right">
    <a href="#promotion">Promotion</a>
    <a href="#event">Event</a>
    <a href="#card" class="icon">
      <i class="fa fa-bars"></i>
    </a>
  </div>
  
  
</div>

<div style="padding-left:16px">
  <h2>Responsive header Example</h2>
  <p>Resize the browser window to see how it works.</p>
</div>



<!-- Zoom Hover for product picture -->
<style>
* {
  box-sizing: border-box;
}

.zoom {
  padding: 50px;
  background-color: green;
  transition: transform .2s;
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.zoom:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
</style>
</head>
<body>

<h1>Zoom on Hover</h1>
<p>Hover over the div element.</p>
  
<div class="zoom"></div>


<script>
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("header").style.top = "0";
  } else {
    document.getElementById("header").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}
</script>

</body>
</html>
