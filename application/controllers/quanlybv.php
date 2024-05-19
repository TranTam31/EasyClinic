<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class quanlybv extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function menu_khach()
	{
		$this->load->view('menuKhach_view');
	}

	public function menu_bacsi()
	{
		$this->load->view('menuBacsi_view');
	}

	public function thongtin()
	{
		$identity = $this->session->userdata('identity');
		$this->load->model('hos_model');
		$data = $this->hos_model->getDataPeople($identity)->result_array();
		$dulieu['dulieu'] = $data;
		$this->load->view('thongtin_view', $dulieu, FALSE); 
	}

	public function doimk()
	{
		$this->load->view('doimk_view');
	}

	public function getPass()
	{
		$identity = $this->session->userdata('identity');
		$this->load->model('hos_model');
		$matKhau = $this->hos_model->getPassword($identity)->result();
		// echo "<pre>";
		// var_dump($matKhau);
		$matKhau = json_encode([
	    	'matkhau' => $matKhau,
	    ]);
	    echo $matKhau;
	}

	public function updatePassword()
	{
		$identity = $this->session->userdata('identity');
		$new_pass = $this->input->post('new_pass');
		$this->load->model('hos_model');
		if($this->hos_model->updatePassword($identity,$new_pass)) {
			echo json_encode("OK");
		} else {
			echo json_encode("Thất bại");
		}
	}

	public function getDataCheckUp_Session()
	{
		$identity = $this->session->userdata('identity');
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

	public function menu()
	{
		$this->load->view('menu_view');
	}

	public function dangnhap()
	{
		if($this->session->has_userdata('userType')) {
			$this->session->unset_userdata('userType');
		} else if($this->session->has_userdata('identity')) {
			$this->session->unset_userdata('identity');
		}
		$this->load->view('dangnhap_view');
	}

	public function taoSession()
	{
		$userType = $this->input->post('userType');
        $identity = $this->input->post('identity');
        $password = $this->input->post('password');
        $this->load->model('hos_model');
		$matKhau = $this->hos_model->getPassword($identity)->result_array();
		$matKhauBacsi = $this->hos_model->getPasswordBacsi($identity)->result_array();

        if ($userType == 1 && $identity == 'happyHospital' && $password == 'tranductam31') {
            // Đăng nhập thành công
            // Tạo session
            $this->session->set_userdata('userType', $userType);
            // Hoặc lưu thêm thông tin khác nếu cần

            echo 'success';
        } else if ($userType == 2 && $password == $matKhau[0]['passdangnhap']) {
            $this->session->set_userdata('identity', $identity);
            // Hoặc lưu thêm thông tin khác nếu cần

            echo 'success';
        } else if ($userType == 3 && $password == $matKhauBacsi[0]['passdangnhap']) {
        	$this->session->set_userdata('identity', $identity);
        	echo 'success';
        } else {
        	echo 'false';
        }
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

	public function getPasswordBacsi()
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

	// đăng xuất
	public function dangxuat()
	{

		$this->session->unset_userdata('userType');
		$this->load->view('menu_view');
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

	public function themThuocVaoData()
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

	// người tới khám
	public function themnguoitoikham()
	{
		$this->load->view('themnguoitoikham_view');
	}

	public function themnguoikhamvaodb()
	{
		$p_iden = $this->input->post('p_iden');
		$p_name = $this->input->post('p_name');
		$p_sex = $this->input->post('p_sex');
		$p_date = $this->input->post('p_date');
		$p_address = $this->input->post('p_address');
		$p_phone = $this->input->post('p_phone');
		$p_pass = $this->input->post('p_pass');
		$this->load->model('hos_model');
		if($this->hos_model->themnguoikhamvaodb($p_iden,$p_name,$p_sex,$p_date,$p_address,$p_phone,$p_pass)) {
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

	public function getDataPeople()
	{
		$identity = $this->input->post('identity');
		$this->load->model('hos_model');
		$data = $this->hos_model->getDataPeople($identity)->result();
		$data = json_encode([
			'dulieupeople' => $data,
		]);
		echo $data;
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

	// đặt lịch khám
	public function getDataLuotKham()
	{
		$fac_id = $this->input->post('fac_id');
		$ngaydatkham = $this->input->post('ngaydatkham');
		$this->load->model('hos_model');
		$dataLuotKham = $this->hos_model->getDataLuotKham($fac_id, $ngaydatkham)->result();
		// echo "<pre>";
		// var_dump($dataLuotKham);
		$dataLuotKhamFinal = json_encode([
	    	'dataLuotKham' => $dataLuotKham,
	    ]);
		echo $dataLuotKhamFinal;
	}

	public function postDataDatLich()
	{
		$slot_id = $this->input->post('slot_id');
		$identity = $this->session->userdata('identity');
		$this->load->model('hos_model');
		if($this->hos_model->postDataDatLich($slot_id,$identity)) {
			echo json_encode("Thêm thành công");
		}
		else {
			echo json_encode("Thất bại");
		}
	}

	public function get_luotKhamDangCho()
	{
		$ngayHomNay = date("Y-m-d");
		$identity = $this->session->userdata('identity');
		$this->load->model('hos_model');
		$luotKhamDangCho = $this->hos_model->get_luotKhamDangCho($identity, $ngayHomNay);
		$luotKhamDangCho = array("mang_luotKhamDangCho" => $luotKhamDangCho);
		$this->load->view('luotKhamDangCho_view', $luotKhamDangCho);
		// $this->load->view('luotKhamDangCho_view');
		// echo "<pre>";
		// var_dump("dhjahf");
	}

	public function getPeopleName()
	{
		$identity = $this->input->post('identity');
		$this->load->model('hos_model');
		$peopleName = $this->hos_model->getDataPeople($identity)->result();
		// echo "<pre>";
		// var_dump($matKhau);
		$peopleName = json_encode([
	    	'peopleName' => $peopleName,
	    ]);
	    echo $peopleName;
	}

	public function pushDataLuotKham()
	{
		$dataToSend = $this->input->post('dataToSend');
		$doctor_id = $this->session->userdata('identity');
		// echo "<pre>";
		// var_dump($dataToSend);
		$this->load->model('hos_model');
		if($this->hos_model->pushDataLuotKham($doctor_id, $dataToSend)) {
			echo json_encode("OK");
		}
		else {
			echo json_encode("Fail");
		}
	}

	public function xoaLuotVuaKham()
	{
		$identity = $this->input->post('identity');
		$ngaykham = $this->input->post('ngaykham');
		$doctor_id = $this->session->userdata('identity');
		$this->load->model('hos_model');
		if($this->hos_model->xoaLuotVuaKham($identity, $ngaykham, $doctor_id)) {
			echo json_encode("Đã xóa");
		}
	}

	// hiển thị lượt khám đang chờ bên bệnh nhân
	// đoạn này đéo hoạt động được:))))))
	// public function mangLuotKham_Bn()
	// {
	// 	$identity = $this->session->userdata('identity');
	// 	$this->load->model('hos_model');
	// 	$mangLuotKham = $this->hos_model->mangLuotKham_Bn($identity);
	// 	$mangLuotKham = array("mangLuotKham_Bn" => $mangLuotKham);
	// 	$this->load->view('datlichkham_view', $mangLuotKham);
	// }

	// ôi má ơi hiểu rồi, ôi hay vãi ò, không hiểu sao mình chợt giật mình nhận ra hehehehehehee.
	// kiểu mình tưởng là nó chỉ cần load_view là được nhưng không. 
	public function datlichkham()
	{
		// chỗ này là load phần các khoa
		$this->load->model('hos_model');
		$fac_main = $this->hos_model->getFac_selectMain();
		// $fac_main = array("mangkhoa" => $fac_main);

		// phần này là load phần mảng đã đặt
		$identity = $this->session->userdata('identity');
		$this->load->model('hos_model');
		$mangLuotKham = $this->hos_model->mangLuotKham_Bn($identity);
		// $mangLuotKham = array("mangLuotKham_Bn" => $mangLuotKham);

		$data = array(
		    "mangkhoa" => $fac_main,
		    "mangLuotKham_Bn" => $mangLuotKham
		);

		$data = array("data" => $data);

		// Chuyển mảng duy nhất làm tham số cho hàm load->view()
		$this->load->view('datlichkham_view', $data);
		// $this->load->view('datlichkham_view', $fac_main, $mangLuotKham);
		// echo "<pre>";
		// var_dump($data);

		// hehe hay vãi, từ đầu mình load 2 lần view, xong nó ra 2 cái, thế là mình gộp 2 cái chung 1 lần load_view hoi. uwu đỉnh vãi ò.....
		// $this->load->view('datlichkham_view', $mangLuotKham);
		// echo "<pre>";
		// var_dump($mangLuotKham);
	}
}

/* End of file quanlybv.php */
/* Location: ./application/controllers/quanlybv.php */