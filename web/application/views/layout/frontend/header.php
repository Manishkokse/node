<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Store</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/font-awesome/css/font-awesome.min.css">  
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/custom.css"> 
	
	<script src="<?php echo base_url();?>assets/plugins/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	
</head>
<body>

<?php
$cart = $this->session->userdata("cart");
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Store</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo site_url("/");?>">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">About Us</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
		<li><a href="<?php echo site_url("/pages/cart");?>"><i class="fa fa-cart-plus"></i> <span class="badge totalItems"><?php echo !empty($cart)?count($cart):"0";?></span></a></li>
        <li>		
		</li>      
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php 
/* $cart = $this->session->userdata("cart");
echo "<pre>";
print_r($cart);
echo "</pre>"; */
?>
