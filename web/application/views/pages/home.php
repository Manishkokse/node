<?php $this->load->view("layout/frontend/header"); ?>
<div class="container-fluid">
<div class="row margin_top">
<?php

$cart = $this->session->userdata("cart");
$cart = !empty($cart)?$cart:array();
$cartKeys = array_keys($cart);
if(!empty($products)){
	foreach($products as $row){
?>
	
	<div class="col-sm-3 margin_top">
	<div class="panel panel-primary">
	<div class="panel-heading"><?php echo $row->name;?></div>
	<div class="panel-body">
	<img src="<?php echo base_url()."assets/images/products/".$row->photo;?>"  width="120" height="110"/>
	
	</div>	
	<div class="panel-footer">
	<span>Rs. <?php echo $row->price;?> /-</span>
	<button type="button" onclick="addToCart('<?php echo $row->id;?>')"class="btn btn-sm btn-warning pull-right addItem<?php echo $row->id ?>" <?php echo in_array($row->id,$cartKeys)?'disabled="disabled"':"";?>><?php echo in_array($row->id,$cartKeys)?"Added":"Add to Cart";?></button>
	</div>
	</div>
	
	</div>
<?php		
	}
}
?>
</div>
</div>
<script type="text/javascript">
function addToCart(product_id){
	$.ajax({
	url:"<?php echo site_url('/pages/add_to_cart') ?>",
	data: {
			product_id: product_id,
			quantity: 1,
		},
	type: "POST",
	dataType:'json',
	success:function(response){
		if(response.status=='success'){
			//alert(response.totalItems);
			$(".totalItems").html(response.totalItems);
			$(".addItem"+product_id+"").attr("disabled","disabled");
			$(".addItem"+product_id+"").html("Added");
			
		}
	}
	});
}
</script>
<?php $this->load->view("layout/frontend/footer"); ?>