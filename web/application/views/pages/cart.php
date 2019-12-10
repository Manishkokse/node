<?php $this->load->view("layout/frontend/header"); ?>
<div class="container-fluid">
<div class="row margin_top">
	<div class="col-sm-12">
	<?php
	$cart = $this->session->userdata("cart");
	?>
	<table class="table table-bordered">
	<thead>
	<tr>
	<th>Sr.No.</th>
	<th>Product Name</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Total</th>
	<th>Action</th>
	</tr>
	</thead>
	
	<tbody>
	<?php
	if(!empty($cart)){
		$i = 0;
		foreach($cart as $k=>$v){
			$i++;
	?>
	<tr>
	<td><?php echo $i;?></td>
	<td><?php echo $v["name"];?></td>
	<td><?php echo $v["price"];?></td>
	<td align="center">	
	<input type="number" class="itemQty" data-id="<?php echo $v["id"];?>" value="<?php echo $v["quantity"];?>" min="1"/>	
	</td>
	<td><?php echo ($v["quantity"] * $v["price"]);?></td>
	<td><a href="<?php echo site_url("/pages/remove_item/".$v["id"]);?>"><i class="fa fa-trash"></i></a></td>
	</tr>
	<?php
		}
	}
	else{
	?>
	<tr>
	<td colspan="4" align="center">No Items Added</td>
	</tr>
	<?php
	}
	?>
	</tbody>
	
	</table>
	</div>
</div>
</div>

<script type="text/javascript">
$(document).on("change",".itemQty",function(){
	var product_id = $(this).attr("data-id");
	var quantity = $(this).val();
	//alert(qty);
	$.ajax({
	url:"<?php echo site_url('/pages/update_cart') ?>",
	data: {
			product_id: product_id,
			quantity: quantity,
		},
	type: "POST",
	dataType:'json',
	success:function(response){
		if(response.status=='success'){			
			
		}
	}
	});
});
</script>
<?php $this->load->view("layout/frontend/footer"); ?>