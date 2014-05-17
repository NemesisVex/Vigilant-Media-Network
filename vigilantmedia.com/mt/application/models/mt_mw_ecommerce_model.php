<?php
class Mt_mw_ecommerce_model extends CI_Model
{
	var $ecommerce_table = 'mw_ecommerce';
	var $ecommerce_table_index = 'ecommerce_id';
	var $ecommerce_merchants_table = 'mw_ecommerce_merchants';
	var $ecommerce_merchants_table_index = 'merchant_id';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_all_merchants($order_by = 'merchant_name')
	{
		$this->db->order_by($order_by);
		$rowMerchants = $this->db->get('mw_ecommerce_merchants');
		return $rowMerchants;
	}
	
	function get_merchant_by_id($merchant_id)
	{
		if (false !== ($rowMerchant = $this->vigilantedblib->_get_record($this->ecommerce_merchants_table, $this->ecommerce_merchants_table_index, $merchant_id)))
		{
			$rsMerchant = $this->vigilantedblib->_db_return_rs($rowMerchant);
			return $rsMerchant;
		}
		return false;
	}
	
	function get_ecommerce_link_by_id($ecommerce_id)
	{
		if (false !== ($rowEcommerce = $this->vigilantedblib->_get_record($this->ecommerce_table, $this->ecommerce_table_index, $ecommerce_id)))
		{
			$rsEcommerce = $this->vigilantedblib->_db_return_rs($rowEcommerce);
			return $rsEcommerce;
		}
		return false;
	}
	
	function get_ecommerce_links_by_merchant_id($ecommerce_merchant_id)
	{
		$this->db->where('ecommerce_merchant_id', $ecommerce_merchant_id);
		if (false !== ($rowEcomm = $this->db->get($this->ecommerce_table)))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function get_ecommerce_links_by_field_type($ecommerce_field_id, $ecommerce_field_type = 'release_id')
	{
		$this->db->from($this->ecommerce_table . ' as e');
		$this->db->join($this->ecommerce_merchants_table . ' as m', 'e.ecommerce_merchant_id=m.merchant_id', 'left');
		$this->db->where('e.ecommerce_field_type', $ecommerce_field_type);
		$this->db->where('e.ecommerce_field_id', $ecommerce_field_id);
		if (false !== ($rowEcomm = $this->db->get()))
		{
			return $rowEcomm;
		}
		return false;
	}
	
	function add_merchant($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->ecommerce_merchants_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function add_ecommerce_link($input)
	{
		if (false !== ($id = $this->vigilantedblib->_add_record($this->ecommerce_table, $input)))
		{
			return $id;
		}
		return false;
	}
	
	function update_merchant_by_id($merchant_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->ecommerce_merchants_table, $this->ecommerce_merchants_table_index, $merchant_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function update_ecommerce_link_by_id($ecommerce_id, $input)
	{
		if (false !== $this->vigilantedblib->_update_record($this->ecommerce_table, $this->ecommerce_table_index, $ecommerce_id, $input))
		{
			return true;
		}
		return false;
	}
	
	function delete_ecommerce_link_by_id($ecommerce_id)
	{
		$where_function = is_array($ecommerce_id) ? 'where_in' : 'where';
		$this->db->$where_function('ecommerce_id', $ecommerce_id);
		if (false !== $this->db->delete($this->ecommerce_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_ecommerce_link_by_field_type($ecommerce_field_id, $ecommerce_field_type = 'release_id')
	{
		$where_function = is_array($ecommerce_field_id) ? 'where_in' : 'where';
		
		$this->db->where('ecommerce_field_type', $ecommerce_field_type);
		$this->db->$where_function('ecommerce_field_id', $ecommerce_field_id);
		if (false !== $this->db->delete($this->ecommerce_table))
		{
			return true;
		}
		return false;
	}
	
	function delete_merchant_by_id($merchant_id)
	{
		$where_function = is_array($merchant_id) ? 'where_in' : 'where';
		$this->db->$where_function('merchant_id', $merchant_id);
		if (false !== $this->db->delete($this->ecommerce_merchants_table))
		{
			return true;
		}
		return false;
	}
}
?>