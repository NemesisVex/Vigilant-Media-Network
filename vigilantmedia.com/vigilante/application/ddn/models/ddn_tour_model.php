<?php
class Ddn_tour_model extends CI_Model
{
	var $blog_id = '';
	
	function __construct()
	{
		parent::__construct();
	}

	function get_all_tours()
	{
		$query = '';
		$query .= 'Select t.*, Min( d.date_tour_date ) AS date_start, Max( d.date_tour_date ) AS date_end ';
		$query .= 'From ddn_tours_dates as d, ddn_tours as t ';
		$query .= 'Where d.date_tour_id=t.tour_id ';
		$query .= 'Group By t.tour_id ';
		$query .= 'Order By d.date_tour_date';
		if (false !== ($rowTours = $this->db->query($query)))
		{
			return $rowTours;
		}

		return false;
	}

	function get_tour_dates($tour_id)
	{
		$this->db->from('ddn_tours as t');
		$this->db->join('ddn_tours_dates as d', 't.tour_id=d.date_tour_id', 'left');
		$this->db->join('ddn_tours_geocodes as g', 'g.geocode_id=d.date_geocode_id', 'left');
		$this->db->join('vm_countries as c', 'c.country_id=g.geocode_country_id', 'left outer');
		$this->db->where('t.tour_id', $tour_id);
		$this->db->order_by('d.date_tour_date');

		if (false !== ($rowTourDates = $this->db->get()))
		{
			return $rowTourDates;
		}
		
		return false;
	}

	function get_tour_date($date_id)
	{
		$this->db->from('ddn_tours as t');
		$this->db->join('ddn_tours_dates as d', 't.tour_id=d.date_tour_id', 'left');
		$this->db->join('ddn_tours_geocodes as g', 'g.geocode_id=d.date_geocode_id', 'left');
		$this->db->join('vm_countries as c', 'c.country_id=g.geocode_country_id', 'left outer');
		$this->db->where('d.date_id', $date_id);

		if (false !== ($rowTourDate = $this->db->get()))
		{
			return $rowTourDate;
		}

		return false;
	}
}
?>