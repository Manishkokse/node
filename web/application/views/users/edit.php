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

<div class="col-sm-4">
	<h3>Edit User</h3>
	<hr/>
	
<form method="post" enctype="multipart/form-data">
	
	<div class="form-group">
	<label class="control-label">Name</label>
	<input type="text" id="name" name="name" class="form-control" value="<?php echo set_value("name");?>"/>
	<label class="error"><?php echo form_error("name"); ?></label>
	</div>
	
	<div class="form-group">
	<label class="control-label">Gender</label>
	<input type="radio" id="gendeMale" name="gender" value="Male" <?php echo set_value("gender")=="Male"?"checked":"";?>/> Male
	<input type="radio" id="gendeFemale" name="gender" value="Female" <?php echo set_value("gender")=="Female"?"checked":"";?>/> Female
	<label class="error"><?php echo form_error("gender"); ?></label>
	</div>
	
	<div class="form-group">
	<label class="control-label">Photo</label>
	<input type="file" id="photo" name="photo" />
	<label class="error"><?php echo form_error("photo"); ?></label>
	</div>
	
	<div class="form-group">
	<label class="control-label">Address</label>
	<textarea type="text" id="address" name="address" class="form-control"><?php echo set_value("address");?></textarea>
	<label class="error"><?php echo form_error("address"); ?></label>
	</div>
	
	<div class="form-group">
	<input type="submit" id="submit" name="submit" class="btn btn-primary pull-right" value="Update"/>
	</div>
	
</form>
</div>

</div>
</div>
<?php $this->load->view("layout/frontend/footer"); ?>