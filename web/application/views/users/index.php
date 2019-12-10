<?php $this->load->view("layout/frontend/header"); ?>
<div class="container-fluid">


<div class="row margin_top">
	<div class="col-sm-12 margin-bottom">
	<?php
	$success_msg = $this->session->flashdata('success_msg');
	if(!empty($success_msg)){
	?>
	<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><?php echo $success_msg;?></strong>
	</div>
	<?php
	}
	?>
	<?php
	$error_msg = $this->session->flashdata('error_msg');
	if(!empty($error_msg)){
	?>
	<div class="alert alert-danger alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><?php echo $error_msg;?></strong>
	</div>
	<?php
	}
	?>
	</div>

<div class="col-sm-12 table-responsive">
<a href="<?php echo site_url("/users/add/".$row->_id);?>" class="btn btn-sm btn-primary pull-right">Add User</a>
	</div>
	<div class="col-sm-12 table-responsive">
		<table class="table">
		<thead>
		<tr>
		<th>Sr.No.</th>
		<th>User ID</th>
		<th>Name</th>
		<th>Image</th>
		<th>Action</th>
		</tr>
		</thead>
		
		<body>
		<?php
		$i = $start;
		foreach($result as $row){
		$i++;
		?>
		<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $row->_id;?></td>
		<td><?php echo $row->name;?></td>
		<td><img src="<?php echo API_URL."uploads/".$row->photo;?>" width="40" height="40" /></td>
		<td>
		<a href="<?php echo site_url("/users/edit/".$row->_id);?>" class="btn btn-xs btn-info">Edit</a>
		<a href="<?php echo site_url("/users/delete/".$row->_id);?>" class="btn btn-xs btn-danger">Delete</a>
		</td>
		</tr>
		<?php
		}
		?>
		</body>
		</table>
	</div>

	<div class="col-sm-12 table-responsive">
	<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
</div>
<?php $this->load->view("layout/frontend/footer"); ?>