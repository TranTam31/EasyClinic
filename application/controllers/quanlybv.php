<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quanlybv extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function menu()
	{
		$this->load->view('menu_view');
	}

	public function dangnhap()
	{
		$this->load->view('dangnhap_view');
	}

	// bác sĩ
	public function bacsi()
	{
		$this->load->model('hos_model');
		$fac_main = $this->hos_model->getFac_selectMain();
		$fac_main = array("mangkhoa" => $fac_main);
		// echo "<pre>";
		// var_dump($fac_main);
		$this->load->view('bacsi_view', $fac_main);
	}

	public function getDataDoctorBacsi()
	{
		$fac_id = $this->input->post('fac_id');
		$this->load->model('hos_model');
		$doctors = $this->hos_model->getDataDoctor_Bacsi($fac_id)->result();
		// echo "<pre>";
		// var_dump($doctors);
		$dataDoctorSelect = json_encode([
	    	'dulieubacsi' => $doctors,
	    ]);
		echo $dataDoctorSelect;
	}

	public function xoaBacsi()
	{
		$id_canxoa = $this->input->post('id_canxoa');
		$this->load->model('hos_model');
		if($this->hos_model->xoaBacsi($id_canxoa)) {
			echo json_encode("Đã xóa");
		}
	}

	public function themBacsiController()
	{
		$idBacsi = $this->input->post('idBacsi');
		$tenBacsi = $this->input->post('tenBacsi');
		$idKhoa = $this->input->post('fac_id');
		$sdtBacsi = $this->input->post('sdtBacsi');
		$this->load->model('hos_model');
		if($this->hos_model->themBacsiController($idBacsi,$tenBacsi,$idKhoa,$sdtBacsi)) {
			echo json_encode("Thêm thành công");
		}
		else {
			echo json_encode("Thất bại");
		}
	}


	//thuốc
	public function thuoc()
	{
		$this->load->view('thuoc_view');
	}
	public function getDataThuoc_trangthuoc()
	{
		$idThuoc = $this->input->post('idThuoc');
		$this->load->model('hos_model');
		$thuocs = $this->hos_model->getDataThuoc_trangthuoc($idThuoc)->result();
		$dataThuoc = json_encode([
			'dulieuthuoc' => $thuocs,
		]);
		echo $dataThuoc;
	}

	public function updateThuoc()
	{
		$idThuoc = $this->input->post('idThuoc');
		$tenThuoc = $this->input->post('ten_thuoc');
		$nccThuoc = $this->input->post('ncc_thuoc');
		$tpThuoc = $this->input->post('tp_thuoc');
		$cdThuoc = $this->input->post('cd_thuoc');
		$this->load->model('hos_model');
		if($this->hos_model->updateThuoc($idThuoc,$tenThuoc,$nccThuoc,$tpThuoc,$cdThuoc)) {
			echo json_encode("OK");
		} else {
			echo json_encode("Thất bại");
		}
	}

	public function xoaThuoc()
	{
		$idThuoc = $this->input->post('idThuoc');
		$this->load->model('hos_model');
		if($this->hos_model->xoaThuoc($idThuoc)) {
			echo json_encode("Đã xóa");
		}
	}

	public function themThuocVaoData($value='')
	{
		$idThuoc = $this->input->post('idThuoc');
		$tenThuoc = $this->input->post('tenThuoc');
		$nccThuoc = $this->input->post('nccThuoc');
		$tpThuoc = $this->input->post('tpThuoc');
		$cdThuoc = $this->input->post('cdThuoc');
		$this->load->model('hos_model');
		if($this->hos_model->themThuocVaoData($idThuoc,$tenThuoc,$nccThuoc,$tpThuoc,$cdThuoc)) {
			echo json_encode("Thêm thành công");
		}
		else {
			echo json_encode("Thất bại");
		}
	}

	// tra cứu
	public function tracuu()
	{
		$this->load->view('tracuu_view');
	}

	public function getDataCheckUp()
	{
		$identity = $this->input->post('identity');
		$this->load->model('hos_model');
		$mangNgay = $this->hos_model->getMangNgay($identity)->result_array();
		// echo "<pre>";
		// var_dump($mangNgay);
		$uay = array();
		foreach ($mangNgay as $tungngay) {
		    $ngayKham = $tungngay['checkDate'];
		    $mangLuotkham = $this->hos_model->getMangLuotKham($identity,$ngayKham)->result_array();
		    $thongTin = array();
		    foreach ($mangLuotkham as $luotKham) {
		    	$idLuotKham = $luotKham['id_luotkham'];
		    	$idDoctor = $luotKham['doctor_id'];
		    	$dulieuBacSi = $this->hos_model->getDataBacSi($idDoctor)->result_array();
			    	$tenKhoa = $dulieuBacSi[0]['fac_name'];
			    	$tenBacsi = $dulieuBacSi[0]['doctor_name'];
			    	$ketquaKham = $luotKham['result'];
			    	$ngayKhamLai = $luotKham['recheckDate'];
			    	$thanhToan = $luotKham['fee'];
		    	//$mangDonThuoc = $this->hos_model->getMangDonThuoc($idLuotKham)->result_array();
		    	
	    	    	$tmp = array(
	    	    		'id_luotkham' => $idLuotKham,
		    	    	'tenkhoa' => $tenKhoa, 
		    	    	'tenbacsi' => $tenBacsi,
		    	    	'ngaykhamlai' => $ngayKhamLai,
		    	    	'thanhtoan' => $thanhToan, 
		    	    );
	    	    	$thongTin[] = $tmp;
		    }
		    $motluot = array(
		    	'ngaykham' => $ngayKham,
		    	'thongtin' => $thongTin,
		    );
	    	$uay[] = $motluot;
		}

		echo json_encode($uay);
	}

	public function getResult()
	{
		$id_luotKham = $this->input->post('id_luotKham');
		$this->load->model('hos_model');
		$result = $this->hos_model->getResult($id_luotKham)->result();
		echo json_encode($result);
	}

	public function getDonThuoc()
	{
		$id_luotKham = $this->input->post('id_luotKham');
		$this->load->model('hos_model');
		$donThuoc = $this->hos_model->getDonThuoc($id_luotKham)->result();
		echo json_encode($donThuoc);
	}

	// thêm lượt khám
	public function themluotkham()
	{
		$this->load->model('hos_model');
		$fac_main = $this->hos_model->getFac_selectMain();
		$fac_main = array("mangkhoa" => $fac_main);
		$this->load->view('insertCheck_view', $fac_main);
	}

	public function getPassword()
	{
		$identity = $this->input->post('identity');
		$this->load->model('hos_model');
		$matKhau = $this->hos_model->getPassword($identity)->result();
		// echo "<pre>";
		// var_dump($matKhau);
		$matKhau = json_encode([
	    	'matkhau' => $matKhau,
	    ]);
	    echo $matKhau;
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

	public function pushDataToModel()
	{
		$dataToSend = $this->input->post('dataToSend');
		// echo "<pre>";
		// var_dump($dataToSend);
		$this->load->model('hos_model');
		$this->hos_model->insertDataLuotKham($dataToSend);
	}

}

/* End of file quanlybv.php */
/* Location: ./application/controllers/quanlybv.php */