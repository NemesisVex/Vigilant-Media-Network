<?php

class Tour extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('MtLib');
		$this->load->library('MyGoogleMapAPI');
		$this->load->model('Mt_ddn_tour_model');
		$this->mysmarty->assign('session', $this->phpsession);
	}

	function browse()
	{
		$this->mtlib->_format_ddn_section_head('Tour administration');

		$rowTours = $this->Mt_ddn_tour_model->get_tours();
		$rsTours = $this->vigilantedblib->_db_return_smarty_array($rowTours);

		$this->mysmarty->assign('rsTours', $rsTours);
		$this->mtlib->_smarty_display_mt_page('mt_ddn_tour_browse.tpl');
	}

	function dates($tour_id)
	{
		$this->mtlib->_format_ddn_section_head('Tour administration');
		
		$rowTourDates = $this->Mt_ddn_tour_model->get_tour_dates($tour_id);
		$rsTourDates = $this->vigilantedblib->_db_return_smarty_array($rowTourDates);

		$this->mysmarty->assign('rsTourDates', $rsTourDates);
		$this->mtlib->_smarty_display_mt_page('mt_ddn_tour_browse_dates.tpl');
	}
	
	function add($tour_id = '')
	{
		$this->mtlib->_format_ddn_section_head('Tour administration');

		$rowCountries = $this->Mt_ddn_tour_model->get_countries();
		$rsCountries = $this->vigilantedblib->_db_return_smarty_array($rowCountries);

		$this->mysmarty->assign('rsCountries', $rsCountries);
		$this->mtlib->_smarty_display_mt_page('mt_ddn_tour_edit.tpl');
	}

	function edit($date_id)
	{
		$rowTourDate = $this->Mt_ddn_tour_model->get_tour_date($date_id);
		$rsTourDate = $this->vigilantedblib->_db_return_rs($rowTourDate);
		//print_r($rsTourDate);

		$this->mysmarty->assign('rsTourDate', $rsTourDate);
		$this->mysmarty->assign('date_id', $date_id);
		$this->add();
	}

	//AJAX methods

	function tours()
	{
		$q = strtolower($this->input->get_post('q'));

		$rowTours = $this->Mt_ddn_tour_model->get_tours();

		foreach ($rowTours->result() as $rsTour)
		{
			$tour_name = strtolower($rsTour->tour_name);
			if (strpos($tour_name, $q) !== false) {
				echo "$rsTour->tour_name|$rsTour->tour_id\n";
			}
		}
	}

	function locations()
	{
		$q = strtolower($this->input->get_post('q'));

		$rowLocations = $this->Mt_ddn_tour_model->get_locations('geocode_location');

		foreach ($rowLocations->result() as $rsLocation)
		{
			$geocode_location = strtolower($rsLocation->geocode_location);
			if (strpos($geocode_location, $q) !== false) {
				echo $rsLocation->geocode_location . '|' . $rsLocation->geocode_address . '|' . $rsLocation->geocode_city . '|' . $rsLocation->geocode_state . '|' . $rsLocation->country_id . '|' . $rsLocation->geocode_lat . '|' . $rsLocation->geocode_lon . '|' . $rsLocation->geocode_id . "\n";
			}
		}
	}

	function lookup($location = '', $address = '', $city = '', $state = '', $country = 'USA', $zip = '', $key = '', $output = 'csv', $oe = 'utf8', $sensor = 'false')
	{
		if (empty($key))
		{
			$key = $this->mtlib->mt_config['google_map_key'];
		}
		
		$api_url = 'http://maps.google.com/maps/geo?';

		$q = '';
		$q .= $location . ', ';
		if ($address != '_') {$q .= $address . ', ';}
		$q .= $city;
		if ($state != '_') {$q .= ', ' . $state;}
		if ($zip != '_') {$q .= ', ' . $zip;}
		$q .= ', ' . $country;

		$url['q'] = $q;
		$url['key'] = $key;
		$url['sensor'] = $sensor;
		$url['output'] = $output;
		$url['oe'] = $oe;

		$api_query = http_build_query($url);
		$api_url .= $api_query;

		$results = $this->mygooglemapapi->fetch_url($api_url);
		echo $results;
		die();
	}

	//Processing methods

	function create()
	{
		/*
		 * Look up tour or create a new one
		 */
		$tour_id = $this->_add_tour_info();

		if (!empty($tour_id))
		{
			/*
			 * Look up location or create a new one
			 */
			$geocode_id = $this->_add_tour_geocode_info();

			/*
			 * Save tour information
			 */
			if (!empty($geocode_id))
			{
				$date_id = $this->_add_tour_date_info($tour_id, $geocode_id);
			}

			/*
			 * Redirect to tour info
			 */
			$this->phpsession->flashsave('msg', 'Your tour date was added.');
			header('Location: /index.php/ddn/tour/edit/' . $date_id . '/');
		}
		
		die();
	}

	function update($date_id)
	{
		$tour_id = $this->input->get_post('tour_id');
		$geocode_id = $this->input->get_post('geocode_id');

		/*
		 * Look up tour or create a new one
		 */
		$new_tour_id = $this->_add_tour_info();
		if (!empty($new_tour_id) && ($new_tour_id !== $tour_id)) {$tour_id = $new_tour_id;}
		
		/*
		 * Look up location or create a new one
		 */
		$new_geocode_id = $this->_add_tour_geocode_info();
		if (!empty($new_geocode_id) && ($new_geocode_id !== $geocode_id)) {$geocode_id = $new_geocode_id;}

		/*
		 * Save tour information
		 */
		if (!empty($date_id))
		{
			$this->_update_tour_date_info($date_id, $tour_id, $geocode_id);
		}


		/*
		 * Save venue information
		 */
		if (!empty($geocode_id))
		{
			$this->_update_tour_geocode_info($geocode_id);
		}

		/*
		 * Redirect to tour info
		 */
		$this->phpsession->flashsave('msg', 'Your tour date was updated.');
		header('Location: /index.php/ddn/tour/edit/' . $date_id . '/');

		die();
	}

	//Private methods
	function _add_tour_info()
	{
		$rsTour = $this->db->get('ddn_tours', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsTour);

		$tour_name = $this->input->get_post('tour_name');
		
		$tour_id = (false !== ($rsTourInfo = $this->_get_tour_info($tour_name))) ? $rsTourInfo->tour_id : $this->_create_tour_info($tour_name);
		
		if (!empty($tour_id))
		{
			return $tour_id;
		}
		
		return false;
	}

	function _add_tour_date_info($tour_id, $geocode_id)
	{
		$rsTourDate = $this->db->get('ddn_tours_dates', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsTourDate);
		
		$input['date_tour_id'] = $tour_id;
		$input['date_geocode_id'] = $geocode_id;

		if (false !== ($date_id = $this->Mt_ddn_tour_model->add_tour_date($input)))
		{
			return $date_id;
		}

		return false;
	}

	function _add_tour_geocode_info()
	{
		$rsGeocode = $this->db->get('ddn_tours_geocodes', 1, 1);
		$input = $this->vigilantedblib->_db_build_insert_data($rsGeocode);

		$fields = array();
		$field_names = array('geocode_location', 'geocode_address', 'geocode_city', 'geocode_state', 'geocode_country_id');

		foreach ($field_names as $field_name)
		{
			$$field_name = $this->input->get_post($field_name);
			if (!empty($$field_name))
			{
				$fields[$field_name] = $$field_name;
			}

		}

		$geocode_id = (false !== ($rsLocation = $this->_get_location_info($fields))) ? $rsLocation->geocode_id : $this->_create_location_info($input);

		if (!empty($geocode_id))
		{
			return $geocode_id;
		}


		if (false !== ($geocode_id = $this->Mt_ddn_tour_model->add_tour_geocode($input)))
		{
			return $geocode_id;
		}

		return false;
	}

	function _update_tour_info()
	{
	}

	function _update_tour_date_info($date_id, $tour_id, $geocode_id)
	{
		$rowTourDate = $this->Mt_ddn_tour_model->get_tour_date($date_id, true);
		$rsTourDate = $this->vigilantedblib->_db_return_rs($rowTourDate);
		$input = $this->vigilantedblib->_db_build_update_data($rsTourDate);

		$input['date_tour_id'] = $tour_id;
		$input['date_geocode_id'] = $geocode_id;

		if (false !== ($this->Mt_ddn_tour_model->update_tour_date_by_id($date_id, $input)))
		{
			return true;
		}

		return false;
	}

	function _update_tour_geocode_info($geocode_id)
	{
		$rowGeocode = $this->Mt_ddn_tour_model->get_geocode_by_id($geocode_id);
		$rsGeocode = $this->vigilantedblib->_db_return_rs($rowGeocode);
		$input = $this->vigilantedblib->_db_build_update_data($rsGeocode);

		if (!empty($input))
		{
			if (false !== ($this->Mt_ddn_tour_model->update_tour_geocode_by_id($geocode_id, $input)))
			{
				return true;
			}
		}

		return false;
	}

	function _get_tour_info($tour_name)
	{
		$rowTour = $this->Mt_ddn_tour_model->get_tour_by_name($tour_name);

		if (false !== $rowTour)
		{
			$rsTour = $this->vigilantedblib->_db_return_rs($rowTour);
			return $rsTour;
		}

		return false;
	}

	function _get_location_info($fields)
	{
		$rowLocation = $this->Mt_ddn_tour_model->get_location($fields);

		if (false !== $rowLocation)
		{
			$rsLocation = $this->vigilantedblib->_db_return_rs($rowLocation);
			return $rsLocation;
		}

		return false;
	}

	function _create_tour_info($tour_name)
	{
		$input['tour_name'] = $tour_name;

		if (false !== ($tour_id = $this->Mt_ddn_tour_model->add_tour($input)))
		{
			return $tour_id;
		}

		return false;
	}

	function _create_location_info($input)
	{
		if (false !== ($geocode_id = $this->Mt_ddn_tour_model->add_tour_geocode($input)))
		{
			return $geocode_id;
		}

		return false;
	}
}

?>
