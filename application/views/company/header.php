<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Company- Dashboard</title>
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
<script type="text/javascript">
  // JavaScript Document
$(document).ready(function () {

  $('#sidebarToggle').on('click', function () {
    $('#sidebar').toggleClass('active');
  });
});
</script>
</head>

<body id="pageTop">
<!-- Top Navbar -->
<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top" id="topNav"> <a href="index.html" class="navbar-brand">Company Admin</a>
  <button class="btn btn-link btn-sm text-white order-1 order-sm-0" type="button" id="sidebarToggle"><span class="fa fa-bars"></span></button>
  <form class="d-none d-sm-inline-block form-inline ml-auto">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for ...">
      <div class="input-group-append">
        <button class="btn btn-primary"><span class="fa fa-search"></span></button>
      </div>
    </div>
  </form>
  <ul class="navbar-nav ml-auto ml-sm-2">
    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell"></i><span class="badge badge-danger">9+</span></a>
      <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">New notifications</a><a href="#" class="dropdown-item">All notifications</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">Manage Notifications</a> </div>
    </li>
    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope"></i><span class="badge badge-danger">7</span></a>
      <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">New messages</a><a href="#" class="dropdown-item">All messages</a>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">Manage massages</a> </div>
    </li>
    <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user-circle"></i></a>
      <div class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Setting</a><a href="#" class="dropdown-item">Activity Log</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?=base_url().'login/logout';?>">Logout</a> </div>
        
    </li>
  </ul>
</nav>
<div class="wrapper mt-5">
  <!-- Sidebar -->
  <nav id="sidebar">
    <ul class="navbar-nav">
      <li class="nav-item active pt-3"><a href="index.html" class="nav-link text-white"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a> </li>
      <li class="nav-item pt-3" id="pageItem"><a href="#pageSubMenu" class="nav-link dropdown-toggle text-white" data-toggle="collapse" aria-expanded="false" role="button"><i class="fa fa-folder"></i> <span>Manage</span></a>
        <div class="dropdown-menu mr-4" id="pageSubMenu">
          <h6 class="dropdown-header">Project management</h6>
          <a href="<?=base_url().'company/manager/all_managers';?>" class="dropdown-item">Project Managers</a>
          <a href="<?=base_url().'company/manager/add_manager';?>" class="dropdown-item">Add project Manager</a>
          <a href="<?=base_url().'company/project/all_projects';?>" class="dropdown-item">Projects</a>
          <a href="<?=base_url().'company/project/add_project';?>" class="dropdown-item">Add project</a>
          
        </div>
      </li>
      <li class="nav-item pt-3"><a href="#" class="nav-link text-white"><i class="fa fa-area-chart"></i> <span>Charts</span></a> </li>
      <li class="nav-item pt-3"><a href="index.html" class="nav-link text-white"><i class="fa fa-table"></i> <span>Reports</span></a> </li>
    </ul>
  </nav>
  <!-- Content -->
  <div id="wrapper-content">
    
  
