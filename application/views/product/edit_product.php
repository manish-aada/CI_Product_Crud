<style>
	.mb-3 {
		margin-bottom: 10px;
	}
</style>

<div class="container mt-5">
	<h1 class="text-center">Update Product</h1>
	<form action="<?php echo base_url('edit/' . $product['id']); ?>" method="POST" enctype="multipart/form-data">
		<div class="row mb-3">
			<div class="col-md-6 mb-3">
				<label for="p_name">Product Name</label>
				<input type="text" class="form-control" id="p_name" name="p_name" value="<?php echo set_value('p_name', $product['p_name']); ?>" placeholder="Product Name" required>
			</div>

			<div class="col-md-6 mb-3">
				<label for="bar_code">Bar Code</label>
				<input type="text" class="form-control" id="bar_code" name="bar_code" value="<?php echo set_value('bar_code', $product['bar_code']); ?>" placeholder="Bar Code" required>
			</div>

			<div class="col-md-6 mb-3">
				<label for="weight">Weight</label>
				<input type="number" class="form-control" id="weight" name="weight" value="<?php echo set_value('weight', $product['weight']); ?>" placeholder="Weight">
			</div>

			<div class="col-md-6 mb-3">
				<label for="size">Size</label>
				<input type="number" class="form-control" id="size" name="size" value="<?php echo set_value('size', $product['size']); ?>" placeholder="Size">
			</div>

			<div class="col-md-6 mb-3">
				<label for="price">Price</label>
				<input type="number" class="form-control" id="price" name="price" value="<?php echo set_value('price', $product['price']); ?>" placeholder="Price">
			</div>

			<div class="col-md-6 mb-3">
				<label for="discount">Discount</label>
				<input type="text" class="form-control" id="discount" name="discount" value="<?php echo set_value('discount', $product['discount']); ?>" placeholder="Discount">
			</div>

			<div class="col-md-12 mb-3">
				<label for="p_image">Product Image</label>
				<?php if (!empty($product['p_image'])): ?>
					<div class="mb-2">
						<img src="<?php echo base_url($product['p_image']); ?>" alt="Product Image" class="img-thumbnail" style="width:100px;">
					</div>
				<?php endif; ?>
				<input type="file" class="form-control" id="p_image" name="p_image">
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-md-12 text-center">
				<input type="submit" class="btn btn-primary" value="Save">
				<a href="<?php echo base_url('all-products'); ?>" class="btn btn-secondary">Cancel</a>
			</div>
		</div>
	</form>
</div>
