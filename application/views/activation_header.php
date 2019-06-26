<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Project management Tool</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="JS/script.js"></script>
<style type="text/css">
  
  /* CSS Document */
  .card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 40%;
  border-radius: 5px;
  float: left;
  margin-left: 10px;
  margin-top: 10px;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
}

.container {
  padding: 2px 16px;
}
#topNav .dropdown-toggle::after {
  display: none;
}
.navbar-nav .nav-item .nav-link .badge {
  position: absolute;
  font-size: 7.5px;
  margin-left: -7.5px;
}
.wrapper {
  display: flex;
  align-items: stretch;
}
/* Sidebar */
#sidebar {
  min-width: 200px;
  max-width: 200px;
  padding-left: 20px;
  background-color: #212529;
}
#sidebar:not(.dropdown-menu) {
  transition: ease-in-out 1s;
}
#sidebar.active .dropdown-toggle::after {
  display: none;
}
#sidebar.active:not(.dropdown-menu) {
  min-width: 80px;
  max-width: 80px;
  padding-left: 0px;
}
#sidebar.active ul li:not(.dropdown-menu) {
  text-align: center;
  font-size: 12px;
}
#sidebar.active ul li a i {
  position: absolute;
  margin-top: -10px;
  margin-left: 10px;
}
#sidebar.active ul li a .fa-tachometer {
  position: absolute;
  margin-top: -10px;
  margin-left: 23px;
}
#sidebar.active #pageItem {
  position: relative;
}
#sidebar.active #pageSubMenu {
  margin-left: 85px;
  margin-top: -40px;
  position: absolute;
}
/*-------------------------------------------------------------------------*/
#wrapper-content {
  width: 100%;
  transition: ease-in-out 0.5s;
}
.card-body-icon{
  position: absolute;
  opacity: 0.5;
  margin-left: 150px;
  margin-top: -10px;
  transform: rotate(20deg);
}
/*-------------------------------------------------------------------------*/
footer .footer-container{
  height: 100px;
  background-color: #EDEDED;
}
footer .copyright{
  line-height: 100px;
}
.scroll-to-top{
  position: fixed;
  right: 15px;
  bottom: 15px;
  width: 50px;
  height: 50px;
  text-align: center;
  line-height: 46px;
  background-color: #8E8E8E; 
  color: #fff;
}
.scroll-to-top:hover{
  color: #fff;
}

</style>
</head>

<body id="pageTop">
<!-- Top Navbar -->

  <div id="wrapper-content">
    
  
