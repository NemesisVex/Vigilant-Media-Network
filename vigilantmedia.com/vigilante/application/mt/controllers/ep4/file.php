<?php
/**
 * Description of file
 *
 * @author Greg Bueno
 */
class File extends CI_Controller {

	private $file_dir;

	public function __construct() {
		parent::__construct();

		$this->file_dir = OBSERVANTRECORDS_FILES_PATH;

		$config['upload_path'] = $this->file_dir;
		$config['allowed_types'] = 'zip|gz|mp3|flac|png';
		$config['overwrite'] = true;

		$this->load->library('upload', $config);
		$this->load->library('MtView');
		$this->load->helper('download');
		$this->load->model('Mt_ep4_file_model');
		$this->load->model('Mt_ep4_file_order_map_model');
		$this->load->model('Mt_ep4_file_product_map_model');
		$this->load->model('Mt_ep4_product_model');
	}

	public function index() {

	}

	public function add($template = 'mt_ep4_file_edit.tpl', $header = 'Add a file') {
		$this->vmview->format_section_head('Observant Records', $header);
		$this->vmview->section_head = 'Observant Records';
		$this->vmview->section_label = $header;
		$this->vmview->display($template);
	}

	public function edit($file_id, $template = 'mt_ep4_file_edit.tpl', $header = 'Edit a file') {
		$rsFile = $this->Mt_ep4_file_model->retrieve_by_id($file_id);
		$this->mysmarty->assign('rsFile', $rsFile);

		$rsOrderMaps = $this->Mt_ep4_file_order_map_model->get_orders_by_file_id($file_id);
		$this->mysmarty->assign('rsOrderMaps', $rsOrderMaps);

		$rsProducts = $this->Mt_ep4_product_model->get_products();
		$this->mysmarty->assign('rsProducts', $rsProducts);

		$rsProductMaps = $this->Mt_ep4_file_product_map_model->get_maps_by_file_id($file_id);
		$this->mysmarty->assign('rsProductMaps', $rsProductMaps);

		$this->mysmarty->assign('file_id', $file_id);
		$this->vmview->section_sublabel = $rsFile->file_name;

		$this->add($template, $header);
	}

	public function delete($file_id) {
		$this->edit($file_id, 'mt_ep4_file_delete.tpl', 'Delete a file');
	}

	public function unmap($file_product_id, $file_id) {
		$this->vmview->format_section_head('Observant Records', 'Map a file');
		$this->vmview->section_head = 'Observant Records';
		$this->vmview->section_label = 'Map a file';

		$rsProductMap = $this->Mt_ep4_file_product_map_model->retrieve_by_id($file_product_id);
		$this->mysmarty->assign('rsProductMap', $rsProductMap);

		$this->mysmarty->assign('file_product_id', $file_product_id);
		$this->mysmarty->assign('file_id', $file_id);
		$this->vmview->display('mt_ep4_file_unmap.tpl');
	}

	//Processing methods

	public function create() {
		$file_name = $this->input->get_post('file_name');
		$file_path = $this->input->get_post('file_path');
		$file_label = $this->input->get_post('file_label');

		if (!empty($file_name)) {
			$input['file_path'] = $file_path;
			$input['file_name'] = $file_name;
			$input['file_label'] = $file_label;
			if (false !== ($file_id = $this->Mt_ep4_file_model->create($input))) {
				$this->phpsession->flashsave('msg', $file_name . ' was successfully added to the database.');
				header('Location: /index.php/ep4/file/edit/' . $file_id . '/');
				die();
			}
		} elseif (false !== $this->upload->do_upload()) {
			$file_info = $this->upload->data();
			$input['file_path'] = $file_info['file_path'];
			$input['file_name'] = $file_info['client_name'];
			$input['file_label'] = $file_label;
			if (false !== ($file_id = $this->Mt_ep4_file_model->create($input))) {
				$this->phpsession->flashsave('msg', $file_info['client_name'] . ' was successfully uploaded and added to the database.');
				header('Location: /index.php/ep4/file/edit/' . $file_id . '/');
			}
		}
		die();
	}

	public function update($file_id) {
		$file_name = $this->input->get_post('file_name');
		$file_path = $this->input->get_post('file_path');
		$file_label = $this->input->get_post('file_label');

		if (!empty($file_name)) {
			$input['file_path'] = $file_path;
			$input['file_name'] = $file_name;
			$input['file_label'] = $file_label;
			if (false !== ($this->Mt_ep4_file_model->update_by_id($file_id, $input))) {
				$this->phpsession->flashsave('msg', $file_name . ' was successfully updated.');
				header('Location: /index.php/ep4/file/edit/' . $file_id . '/');
				die();
			}
		} elseif (false !== $this->upload->do_upload()) {
			$file_info = $this->upload->data();
			$input['file_path'] = $file_info['file_path'];
			$input['file_name'] = $file_info['client_name'];
			if (false !== ($this->Mt_ep4_file_model->update_by_id($file_id, $input))) {
				$this->phpsession->flashsave('msg', $file_info['client_name'] . ' was successfully uploaded and updated to the database.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			die();
		}
	}

	public function remove($file_id) {
		$confirm = $this->input->get_post('confirm');
		$file_path = $this->input->get_post('file_path');

		if ($confirm == 'Yes') {
			if (false !== $this->Mt_ep4_file_model->delete_by_id($file_id)) {
				$this->Mt_ep4_file_product_map_model->delete_product_map_by_file_id($file_id);
				$this->Mt_ep4_file_order_map_model->delete_order_map_by_file_id($file_id);
				if (false !== unlink($file_path)) {
					$this->phpsession->flashsave('msg', 'Your file was deleted.');
					header('Location: /index.php/mt/ep4/');
					die();
				}
			}
		} else {
			$this->phpsession->flashsave('msg', 'Your file was not deleted.');
			header('Location: /index.php/mt/ep4/');
			die();
		}
	}

	public function map($file_product_file_id) {
		$product_ids = $this->input->get_post('product_ids');

		if (!empty($product_ids)) {
			$success_flag = false;
			foreach ($product_ids as $product_id) {
				$input['file_product_file_id'] = $file_product_file_id;
				$input['file_product_product_id'] = $product_id;
				if (false !== $this->Mt_ep4_file_product_map_model->create($input)) {
					$success_flag = true;
				}
			}
			if ($success_flag === true) {
				$this->phpsession->flashsave('msg', 'Products were mapped to this file.');
			}
		} else {
			$this->phpsession->flashsave('msg', 'No products were selected to map.');
		}


		header('Location: /index.php/ep4/file/edit/' . $file_product_file_id . '/');
		die();
	}

	public function unmap_product($file_product_id) {
		$confirm = $this->input->get_post('confirm');
		$file_id = $this->input->get_post('file_product_file_id');

		if ($confirm == 'Yes')
		{
			$this->Mt_ep4_file_product_map_model->delete_by_id($file_product_id);

			$this->phpsession->flashsave('msg', 'The product mapping was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', 'The product mapping was not deleted.');
		}
		header('Location: /index.php/ep4/file/edit/' . $file_id . '/');

		die();
	}
}

?>
