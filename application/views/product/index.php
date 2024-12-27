<div class="row mt-3">
	<div class="col-sm-4"></div>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<a class="btn btn-lg btn-primary" style="margin-top: 30px; margin-bottom: 30px;" href="<?php echo base_url('add-product'); ?>">Add New Product</a>
	</div>
</div>
<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
		<?php endif; ?>
<table class="table table-bordered table-striped">
	<thead class="table-dark">
		<tr>
			<th>#</th>
			<th>Product Name</th>
			<th>Barcode</th>
			<th>Weight</th>
			<th>Size</th>
			<th>Price</th>
			<th>Discount</th>
			<th>Product Image</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		if (!empty($products)) {
			foreach ($products as $key => $value) { ?>
				<tr>
					<td><?php echo $key + 1; ?></td>
					<td><?php echo !empty($value['p_name']) ? $value['p_name'] : "N/A"; ?></td>
					<td><?php echo !empty($value['bar_code']) ? $value['bar_code'] : "N/A"; ?></td>
					<td><?php echo !empty($value['weight']) ? $value['weight'] : "N/A"; ?></td>
					<td><?php echo !empty($value['size']) ? $value['size'] : "N/A"; ?></td>
					<td><?php echo !empty($value['price']) ? $value['price'] : "N/A"; ?></td>
					<td><?php echo !empty($value['discount']) ? $value['discount'] : "N/A"; ?></td>
					<td>
						<?php if (!empty($value['p_image'])): ?>
							<img src="<?php echo base_url($value['p_image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
						<?php else: ?>
							N/A
						<?php endif; ?>
					</td>
					<td>
						<a class="btn btn-info" href="<?php echo base_url('edit/'.$value['id']); ?>">Update</a>
						<a class="btn btn-danger" href="<?php echo base_url('delete/'.$value['id']); ?>" 
						   onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
					</td>
				</tr>
			<?php } 
		} else { ?>
			<tr>
				<td colspan="9" class="text-center">No data found</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
