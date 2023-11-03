<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quanlybv extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('hos_model');
		$fac_main = $this->hos_model->getFac_selectMain();
		$fac_main = array("mangkhoa" => $fac_main);
		// echo "<pre>";
		// var_dump($fac_main);
		$this->load->view('insertCheck_view', $fac_main);
	}

	public function getDataDocSelect()
	{
		$fac_id = $this->input->post('fac_id');
		$this->load->model('hos_model');
		$doctors = $this->hos_model->getNameDoctorSelect($fac_id)->result();
		// echo "<pre>";
		// var_dump($doctors);
		$dataDoctorSelect = json_encode([
	    	'dulieubacsi' => $doctors,
	    ]);
		echo $dataDoctorSelect;
	}

	public function getDataFacSelect_ajax()
	{
		$this->load->model('hos_model');
		$facs = $this->hos_model->getFac_selectAjax()->result();

		// echo "<pre>";
		// var_dump($facs);
		// die();
		$dataFacSelect = json_encode([
	    	'dulieukhoa' => $facs,
	    ]);
		echo $dataFacSelect;
	}

	public function getDataIdentity()
	{
		$this->load->model('hos_model');
		$iden = $this->hos_model->getIdentity()->result();
		$dataIdentity = json_encode([
			'dulieucccd' => $iden,
		]);
		echo $dataIdentity;
	}

	public function getDataMedicine()
	{
		$this->load->model('hos_model');
		$medi = $this->hos_model->getMedicineName()->result();
		$dataMedi = json_encode([
			'dulieuthuoc' => $medi,
		]);
		echo $dataMedi;
	}
}

/* End of file quanlybv.php */
/* Location: ./application/controllers/quanlybv.php */