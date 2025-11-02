<div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body text-center">
				<h4><?= vendor()->username;?></h4>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
		<div class="card">
			<form action="<?= base_url("admin/pos/add_order");?>" method="post">
				<?= csrf();?>
				<div class="card-body">
					<div class="form-group">
					    <input type="text" name="customer_name" class="form-control" placeholder="Customer Name">
				    </div>
				    <table class="table table-striped text-center table-bordered">
				    	<thead>
				    		<tr>
				    			<th>SL</th>
				    			<th>Uid</th>
				    			<th>Title</th>
				    			<th>Price</th>
				    			<th>Qty</th>
				    			<th>Sold Price</th>
				    			<th>Sub Total</th>
				    			<th>Action</th>
				    		</tr>
				    	</thead>
				    	<tbody id="show_posItems">
				    		<?php if(!empty($this->cart->contents())): ?>
				    			<?php include 'listed_items.php' ?>
				    		<?php endif ?>
				    	</tbody>
				    </table>
				    <br>
				   <div class="row ">
					   	<div class="col-md-6 mt-20">
					   		 <div class="dueArea">
								<label class="custom-checkbox text-danger"> <input type="checkbox" name="is_due" class="isDue" value="1"> Is Due</label>
								<div class="showDuePrice" style="display: none;">
									<input type="number" name="due_price" id="" class="form-control" placeholder="Due Price">
								</div>
							</div>
					   	</div>
				   </div>
				</div>
				<div class="card-footer text-right">

					<button type="submit" class="btn btn-secondary">Submit</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h4 class="title">Choose Product</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped text-center" id="myTable">
					    <thead>
					    	<tr>
					    		<th>SL</th>
							    <th>Code</th>
							    <th>Title</th>
							    <th>Price</th>
							    <th>Stock</th>
							    <th>Action</th>
					    	</tr>
						    
					    </thead>
					    <tbody>
					    	<?php foreach ($product_list as $key => $item): ?>
					    		<tr>
					    			<td><?= $key+1;?></td>
					    			<td><?= $item['uid'];?></td>
					    			<td><?= $item['title'];?> <b> <?= $item['category_name'];?></b></td>
					    			<td><?= number_format($item['price'],0);?></td>
					    			<td><?= $item['in_stock']-$item['sold_qty'];?></td>
					    			<td>
					    				<form action="<?= base_url("admin/pos/add/{$item['id']}");?>" method="POST" class="add_to_cart">
					    					<?= csrf();?>
					    					<button type="submit" class="btn btn-success btn-sm" class=""><i class="fa fa-plus"></i></button>
					    				</form>
					    			</td>
					    		</tr>
					    	<?php endforeach ?>
					    </tbody>
				    </table>
				</div>
			</div>
			
		</div>
	</div>
</div>