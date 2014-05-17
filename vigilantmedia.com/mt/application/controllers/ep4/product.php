<?php

/**
 * Description of product
 *
 * @author Greg Bueno
 */
class Product extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('MtView');
		$this->load->model('Mt_ep4_product_map_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	public function unmap($product_release_id, $release_id) {
		$this->vmview->format_section_head('Observant Records', 'Map a product');
		$this->vmview->section_head = 'Observant Records';
		$this->vmview->section_label = 'Map a product';
		
		$rsProductMap = $this->Mt_ep4_product_map_model->retrieve_by_id($product_release_id);
		$this->mysmarty->assign('rsProductMap', $rsProductMap);
		
		$this->mysmarty->assign('product_release_id', $product_release_id);
		$this->mysmarty->assign('release_id', $release_id);
		$this->vmview->display('mt_ep4_product_unmap.tpl');
	}
	
	public function create() {
		$release_id = $this->input->get_post('product_release_release_id');
		$album_id = $this->input->get_post('product_release_album_id');
		$product_ids = $this->input->get_post('product_ids');
		
		if (!empty($product_ids)) {
			$success_flag = false;
			foreach ($product_ids as $product_id) {
				$input['product_release_release_id'] = $release_id;
				$input['product_release_album_id'] = $album_id;
				$input['product_release_product_id'] = $product_id;
				if (false !== $this->Mt_ep4_product_map_model->create($input)) {
					$success_flag = true;
				}
			}
			if ($success_flag === true) {
				//$this->phpsession->flashsave('msg', 'Products were mapped to this release.');
			}
		} else {
			$this->phpsession->flashsave('msg', 'No products were selected to map.');
		}
		
		
		header('Location: /index.php/ep4/release/edit/' . $release_id . '/');
		die();
	}
	
	public function remove($product_release_id) {
		$confirm = $this->input->get_post('confirm');
		$release_id = $this->input->get_post('product_release_release_id');
		
		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_product_map_model->delete_by_id($product_release_id);
			
			$this->phpsession->flashsave('msg', 'The product mapping was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The product mapping was not deleted.');
		}
		header('Location: /index.php/ep4/release/edit/' . $release_id . '/');
		
		die();
	}
}

?>
