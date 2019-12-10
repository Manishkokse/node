<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/Ionicons/css/ionicons.min.css">  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">       
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">  
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css">  
	<!-- jQuery 3 -->
	<script src="<?php echo base_url();?>assets/plugins/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>

	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-validations/jquery.validate.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-validations/additional-methods.min.js"></script>
	<!-- Morris.js charts -->
	<script src="<?php echo base_url();?>assets/plugins/raphael/raphael.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/morris.js/morris.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/fastclick/lib/fastclick.js"></script>
	<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
	
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

<?php
$loggedIn = $this->session->userdata("admin_logged_in");
?>
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url("/admin/users"); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()."assets/images/users/".$loggedIn["photo"];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo ($loggedIn["first_name"]." ".$loggedIn["last_name"]);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()."assets/images/users/".$loggedIn["photo"];?>" class="img-circle" alt="User Image">
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">                
                <div class="pull-right">
                  <a href="<?php echo site_url("/admin/users/logout");?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  
<?php $this->load->view("layout/admin/sidebar"); ?>