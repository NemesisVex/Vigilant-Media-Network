<?php

/**
 * Obr_Ecommerce
 * 
 * Obr_Ecommerce is a model for ecommerce links of Observant Records releases.
 *
 * @author Greg Bueno
 */
class Obr_Ecommerce extends MY_Model {
	
	public $_table = 'ep4_ecommerce';
	public $primary_key = 'content_id';
	public $belongs_to = array(
		'releases' => array(
			'model' => 'Obr_Release',
			'primary_key' => 'ecommerce_release_id',
		),
		'tracks' => array(
			'model' => 'Obr_Track', 
			'primary_key' => 'ecomemrce_track_id',
		),
	);
	protected $soft_delete = true;
	protected $soft_delete_key = 'ecommerce_deleted';
	
	public function __construct() {
		parent::__construct();
	}
}

?>
