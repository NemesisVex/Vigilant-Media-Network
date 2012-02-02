<?php

class Tour extends CI_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->library('DdnLib');
		$this->load->model('Ddn_tour_model');
	}
	
	function index($tour_id = 1)
	{
		$rowTourDates = $this->Ddn_tour_model->get_tour_dates($tour_id);
		$rsTourDates = $this->vigilantedblib->_db_return_smarty_array($rowTourDates);
		
		$rowTours = $this->Ddn_tour_model->get_all_tours();
		$rsTours = $this->vigilantedblib->_db_return_smarty_array($rowTours);

		$this->ddnlib->_format_section_head('Tour History Map');

		$this->mysmarty->assign('rsTourDates', $rsTourDates);
		$this->mysmarty->assign('rsTours', $rsTours);
		$this->ddnlib->_smarty_display_ddn_page('ddn_tour.tpl');
	}
	
	//AJAX methods

	function marker($date_id)
	{
		$rowDate = $this->Ddn_tour_model->get_tour_date($date_id);
		$rsDate = $this->vigilantedblib->_db_return_rs($rowDate);

		$this->mysmarty->assign('rsDate', $rsDate);
		$output = $this->mysmarty->fetch('ddn_tour_marker.tpl');
		echo $output;
		die();
	}

	//Processing methods
}
?>