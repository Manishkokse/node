<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
<?php
$loggedIn = $this->session->userdata("admin_logged_in");
?>
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
	  <img src="<?php echo base_url()."assets/images/users/".$loggedIn["photo"];?>" class="img-circle" alt="User Image">
	</div>
	<div class="pull-left info">
	  <p><?php echo ($loggedIn["first_name"]." ".$loggedIn["last_name"]);?></p>
	</div>
  </div>
 
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">  
	<li class="active">
	  <a href="<?php echo site_url("/admin/users");?>">
		<i class="fa fa-dashboard"></i> <span>Dashboard</span>            
	  </a>
	</li>
	<li class="treeview">
	  <a href="#">
		<i class="fa fa-table"></i> <span>Category</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	  </a>
	  <ul class="treeview-menu">
		<li class="active"><a href="<?php echo site_url("/admin/categories/add");?>"><i class="fa fa-circle-o"></i> Add Category</a></li>
		<li><a href="<?php echo site_url("/admin/categories");?>"><i class="fa fa-circle-o"></i> Categories List</a></li>
	  </ul>
	</li>
	<li class="treeview">
	  <a href="#">
		<i class="fa fa-table"></i> <span>Products</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	  </a>
	  <ul class="treeview-menu">
		<li class="active"><a href="<?php echo site_url("/admin/products/add");?>"><i class="fa fa-circle-o"></i> Add Product</a></li>
		<li><a href="<?php echo site_url("/admin/products");?>"><i class="fa fa-circle-o"></i> Products List</a></li>
	  </ul>
	</li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>