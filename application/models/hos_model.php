<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hos_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getIdentity()
	{
		$this->db->select('
			identity,
			people_name,
			dob
			');
		return $this->db->get('people');
	}

	public function getMedicineName()
	{
		$this->db->select('
			med_id,
			med_name
			');
		return $this->db->get('medicine');
	}

	public function getFac_selectMain()
	{
		$this->db->select('*');
		return $this->db->get('faculty')->result_array();
	}

	public function getFac_selectAjax()
	{
		$this->db->select('*');
		return $this->db->get('faculty');
	}

	public function getNameDoctorSelect($fac_id)
	{
		$this->db->select('
			doctor_id,
			doctor_name
			');
		$this->db->where('fac_id', $fac_id);
		return $this->db->get('doctor');
	}
}

/* End of file hos_model.php */
/* Location: ./application/models/hos_model.php */