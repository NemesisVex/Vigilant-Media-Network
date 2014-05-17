<?php
class Mt_ddn_tour_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_tours()
	{
		$this->db->from('ddn_tours as t');
		$this->db->order_by('tour_name');

		if (false !== ($rowTours = $this->db->get()))
		{
			return $rowTours;
		}

		return false;
	}

	function get_locations()
	{
		$this->db->from('ddn_tours_geocodes as g');
		$this->db->join('vm_countries as c', 'c.country_id=g.geocode_country_id', 'left');
		$this->db->group_by('g.geocode_id');
		$this->db->order_by('g.geocode_location');

		if (false !== ($rowLocations = $this->db->get()))
		{
			return $rowLocations;
		}

		return false;
	}

	function get_tour_dates($tour_id)
	{
		$this->db->from('ddn_tours as t');
		$this->db->join('ddn_tours_dates as d', 't.tour_id=d.date_tour_id', 'left');
		$this->db->join('ddn_tours_geocodes as g', 'g.geocode_id=d.date_geocode_id', 'left');
		$this->db->join('vm_countries as c', 'g.geocode_country_id=c.country_id', 'left outer');
		$this->db->where('t.tour_id', $tour_id);
		$this->db->order_by('d.date_tour_date');

		if (false !== ($rowTourDates = $this->db->get()))
		{
			return $rowTourDates;
		}

		return false;
	}

	function get_tour_date($date_id, $simple = false)
	{
		if ($simple == true)
		{
			if (false !== ($rowTourDate = $this->vigilantedblib->_get_record('ddn_tours_dates', 'date_id', $date_id)))
			{
				return $rowTourDate;
			}
		}
		else
		{
			$this->db->from('ddn_tours as t');
			$this->db->join('ddn_tours_dates as d', 't.tour_id=d.date_tour_id', 'left');
			$this->db->join('ddn_tours_geocodes as g', 'g.geocode_id=d.date_geocode_id', 'left');
			$this->db->join('vm_countries as c', 'g.geocode_country_id=c.country_id', 'left outer');
			$this->db->where('d.date_id', $date_id);
			if (false !== ($rowTourDate = $this->db->get()))
			{
				return $rowTourDate;
			}
		}

		return false;
	}

	function get_tour_by_name($tour_name)
	{
		$this->db->from('ddn_tours as t');
		$this->db->where('t.tour_name', $tour_name);

		if (false !== ($rowTour = $this->db->get()))
		{
			return $rowTour;
		}

		return false;
	}

	function get_location($fields)
	{
		$this->db->from('ddn_tours_geocodes as g');
		foreach ($fields as $field => $value)
		{
			$this->db->where($field, $value);
		}

		if (false !== ($rowLocation = $this->db->get()))
		{
			return $rowLocation;
		}

		return false;
	}

	function get_geocode_by_id($geocode_id)
	{
		if (false !== ($rowGeocode = $this->vigilantedblib->_get_record('ddn_tours_geocodes', 'geocode_id', $geocode_id)))
		{
			return $rowGeocode;
		}
		return false;
	}

	function get_countries()
	{
		$rowCountries = $this->db->get('vm_countries');
		return $rowCountries;
	}

	function add_tour($input)
	{
		if (false !== ($tour_id = $this->vigilantedblib->_add_record('ddn_tours', $input)))
		{
			return $tour_id;
		}

		return false;
	}

	function add_tour_date($input)
	{
		if (false !== ($date_id = $this->vigilantedblib->_add_record('ddn_tours_dates', $input)))
		{
			return $date_id;
		}

		return false;
	}

	function add_tour_geocode($input)
	{
		if (false !== ($geocode_id = $this->vigilantedblib->_add_record('ddn_tours_geocodes', $input)))
		{
			return $geocode_id;
		}

		return false;
	}

	function update_tour_date_by_id($date_id, $input)
	{
		if (false !== ($this->vigilantedblib->_update_record('ddn_tours_dates', 'date_id', $date_id, $input)))
		{
			return true;
		}

		return false;
	}

	function update_tour_geocode_by_id($geocode_id, $input)
	{
		if (false !== ($this->vigilantedblib->_update_record('ddn_tours_geocodes', 'geocode_id', $geocode_id, $input)))
		{
			return true;
		}

		return false;
	}
}
?>
