<style>
	.mb-3{
		margin-bottom: 10px;
	}
</style>
<div class="container mt-5">
		<h1 class="text-center mb-4">Add New Product</h1>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
		<?php endif; ?>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
		<?php endif; ?>

		<form action="<?php echo base_url('create'); ?>" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="p_name" class="form-label">Product Name</label>
					<input type="text" id="p_name" class="form-control" name="p_name" placeholder="Product Name" required>
				</div>

				<div class="col-md-6 mb-3">
					<label for="bar_code" class="form-label">Bar Code</label>
					<input type="text" id="bar_code" class="form-control" name="bar_code" placeholder="Bar Code" required>
				</div>

				<div class="col-md-6 mb-3">
					<label for="weight" class="form-label">Weight</label>
					<input type="number" id="weight" class="form-control" name="weight" placeholder="Weight">
				</div>

				<div class="col-md-6 mb-3">
					<label for="size" class="form-label">Size</label>
					<input type="number" id="size" class="form-control" name="size" placeholder="Size">
				</div>

				<div class="col-md-6 mb-3">
					<label for="price" class="form-label">Price</label>
					<input type="number" id="price" class="form-control" name="price" placeholder="Price">
				</div>

				<div class="col-md-6 mb-3">
					<label for="discount" class="form-label">Discount</label>
					<input type="number" id="discount" class="form-control" name="discount" placeholder="Discount">
				</div>

				<div class="col-md-12 mb-3">
					<label for="p_image" class="form-label">Product Image</label>
					<input type="file" id="p_image" class="form-control" name="p_image" placeholder="Product Image">
				</div>

				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</div>
		</form>
	</div>