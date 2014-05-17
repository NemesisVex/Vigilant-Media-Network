<?php

class Merchants extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->model('Mt_mw_ecommerce_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}
	
	// View methods
	
	function index()
	{
		$this->mtlib->_format_ecommerce_section_head();
		
		$rowMerchants = $this->Mt_mw_ecommerce_model->get_all_merchants();
		$rsMerchants = $this->vigilantedblib->_db_return_smarty_array($rowMerchants);
		
		$this->mysmarty->assign('rsMerchants', $rsMerchants);
		$this->mtlib->_smarty_display_mt_page('mt_ecommerce_merchants_browse.tpl');
	}
	
	function edit($merchant_id, $template = 'mt_ecommerce_merchants_edit.tpl')
	{
		$this->mtlib->_format_ecommerce_section_head();
		$rsMerchant = $this->Mt_mw_ecommerce_model->get_merchant_by_id($merchant_id);
		
		$this->mysmarty->assign('rsMerchant', $rsMerchant);
		$this->mysmarty->assign('merchant_id', $merchant_id);
		$this->mtlib->_smarty_display_mt_page($template);
	}
	
	function delete($merchant_id)
	{
		$this->edit($merchant_id, 'mt_ecommerce_merchants_delete.tpl');
	}
	
	// Processing methods
	function update($merchant_id)
	{
		$rsMerchant = $this->Mt_mw_ecommerce_model->get_merchant_by_id($merchant_id);
		$input = $this->vigilantedblib->_db_build_update_data($rsMerchant);
		$input['merchant_id'] = $merchant_id;
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_ecommerce_model->update_merchant_by_id($merchant_id, $input))
			{
				$this->phpsession->flashsave('msg', $rsMerchant->merchant_name . ' was updated.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
		}
		
		die();
	}
	
	function create()
	{
		$rsMerchant = $this->db->get('mw_ecommerce_merchants', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsMerchant);
		
		if (!empty($input))
		{
			if (false !== $this->Mt_mw_ecommerce_model->add_merchant($input))
			{
				$this->phpsession->flashsave('msg', '<em>' . $input['merchant_name'] . '</em> was created.');
				$merchant_id = $this->db->insert_id();
				header('Location: /index.php/ecommerce/merchants/edit/' . $merchant_id . '/');
			}
		}
		
		die();
	}
	
	function remove($merchant_id)
	{
		$confirm = $this->input->get_post('confirm');
		$merchant_name = $this->input->get_post('merchant_name');
		
		if ($confirm == 'Yes')
		{
			$rsLinks = $this->Mt_mw_ecommerce_model->get_ecommerce_links_by_merchant_id($merchant_id, 'ecommerce_merchant_id');
			if ($rsLinks->num_rows() > 0)
			{
				foreach ($rsLinks->result() as $rsLink)
				{
					$link_ids[] = $rsLink->ecommerce_id;
				}
			}
			if (!empty($link_ids))
			{
				$this->Mt_mw_ecommerce_model->delete_ecommerce_link_by_id($link_ids);
			}
			
			$this->Mt_mw_ecommerce_model->delete_merchant_by_id($merchant_id);
			$this->phpsession->flashsave('msg', $merchant_name . ' was deleted.');
		}
		elseif ($confirm == 'No')
		{
			$this->phpsession->flashsave('msg', $merchant_name . ' was not deleted.');
		}
		
		header('Location: /index.php/ecommerce/merchants/');
		die();
	}
}
?>