<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function get_data(){
		 $this->db->get('products')->result_array();
	}

	public function get_all_products() {
				return $this->db->get('products')->result_array();
	}

	public function add_product($data) {
				return $this->db->insert('products', $data);
	}

	public function get_product_by_id($id) {
				return $this->db->get_where('products', ['id' => $id])->row_array();
	}

	public function delete_product($id) {
				$this->db->where('id', $id)->delete('products');
	}
	
	public function update_product($id, $data){
				$this->db->where('id', $id);
				return $this->db->update('products', $data);
	}


}

?>