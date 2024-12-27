<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->library('form_validation');
	}
	
	public function index(){
		$data['products'] = $this->Product_model->get_all_products();
		$this->load->view('layout/head');
		$this->load->view('product/index',$data);
		$this->load->view('layout/footer');
	}

	public function add(){
		$this->load->view('layout/head');
		$this->load->view('product/add_product');
		$this->load->view('layout/footer');
	}

	public function create() {
		if ($this->input->post()) {
			$this->form_validation->set_rules('p_name', 'Product Name', 'required');
			$this->form_validation->set_rules('bar_code', 'Bar Code', 'required');
			$this->form_validation->set_rules('weight', 'Weight', 'required');
			$this->form_validation->set_rules('size', 'Size', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');
			$this->form_validation->set_rules('discount', 'Discount', 'required|numeric');
			
			if ($this->form_validation->run() == TRUE) {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 5048;
				$this->load->library('upload', $config);

				$imagePath = null;
				if (!empty($_FILES['p_image']['name'])) {
					if ($this->upload->do_upload('p_image')) {
						$uploadData = $this->upload->data();
						$imagePath = 'uploads/' . $uploadData['file_name']; 
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('error', "Image Upload Error: $error");
						redirect('add-product');
						return;
					}
				} else {
					$this->session->set_flashdata('error', 'Product Image is required.');
					redirect('add-product');
					return;
				}

				$data = [
					'p_name' => $this->input->post('p_name'),
					'bar_code' => $this->input->post('bar_code'),
					'weight' => $this->input->post('weight'),
					'size' => $this->input->post('size'),
					'price' => $this->input->post('price'),
					'discount' => $this->input->post('discount'),
					'p_image' => $imagePath,
				];

				if ($this->Product_model->add_product($data)) {
					$this->session->set_flashdata('success', 'Product added successfully.');
				} else {
					$this->session->set_flashdata('error', 'Failed to add the product. Please try again.');
				}

				redirect('all-products');
			} else {
				$this->session->set_flashdata('error', validation_errors());
				redirect('add-product');
			}
		} else {
			redirect('add-product');
		}
	}

	public function edit($id){
		$product = $this->Product_model->get_product_by_id($id);

		if (!$product) {
			$this->session->set_flashdata('error', 'Product not found.');
			redirect('all-products');
		}

		if ($this->input->post()) {
			$this->form_validation->set_rules('p_name', 'Product Name', 'required');
			$this->form_validation->set_rules('bar_code', 'Barcode', 'required');
			$this->form_validation->set_rules('weight', 'Weight', 'required|numeric');
			$this->form_validation->set_rules('size', 'Size', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');
			$this->form_validation->set_rules('discount', 'Discount', 'required|numeric');

			if ($this->form_validation->run() == TRUE) {
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size'] = 5048; 
				$config['encrypt_name'] = TRUE; 
				$this->load->library('upload', $config);

				$uploaded_image = $product['p_image']; 

				if (!empty($_FILES['p_image']['name'])) {
					if ($this->upload->do_upload('p_image')) {
						$uploaded_image = $this->upload->data('file_name');

						if (!empty($product['p_image']) && file_exists('./uploads/' . $product['p_image'])) {
							unlink('./uploads/' . $product['p_image']);
						}
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('edit/' . $id);
					}
				}

				$data = [
					'p_name'   => $this->input->post('p_name'),
					'bar_code' => $this->input->post('bar_code'),
					'weight'   => $this->input->post('weight'),
					'size'     => $this->input->post('size'),
					'price'    => $this->input->post('price'),
					'discount' => $this->input->post('discount'),
					'p_image'  => $uploaded_image,
				];

				$update = $this->Product_model->update_product($id, $data);
				if ($update) {
					$this->session->set_flashdata('success', 'Product updated successfully!');
					redirect('all-products');
				} else {
					$this->session->set_flashdata('error', 'Failed to update product.');
				}
			}
		}

		$data['product'] = $product;
		$this->load->view('layout/head');
		$this->load->view('product/edit_product', $data);
		$this->load->view('layout/footer');
		
	}

	public function delete($id)
	{
		$product = $this->Product_model->get_product_by_id($id);
		if ($product) {
			$image_path = './' . $product['p_image'];
			if (file_exists($image_path) && is_file($image_path)) {
				unlink($image_path);
			}
			$this->Product_model->delete_product($id);
			$this->session->set_flashdata('success', 'Product deleted successfully.');
		} else {
			$this->session->set_flashdata('error', 'Product not found.');
		}
		redirect('all-products');
	}


	
	
}
