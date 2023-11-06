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

	public function getPassword($identity)
	{
		$this->db->select('passdangnhap');
		$this->db->where('identity', $identity);
		return $this->db->get('people');
	}

	public function insertDataLuotKham($dataToSend)
	{
		$get_iden = $dataToSend['identity'];
		$get_date = $dataToSend['ngaykham'];
		foreach ($dataToSend['appointments'] as $luotkham) {
		    $get_doctor = $luotkham['doctor'];
		    $get_result = $luotkham['results'];
		    $get_revisitDate = $luotkham['revisit_date'];
		    $get_payment = $luotkham['payment'];
		    $dulieuLuotKham = array(
				'checkDate' => $get_date,
				'identity' => $get_iden, 
				'doctor_id' => $get_doctor, 
				'result' => $get_result, 
				'fee' => $get_payment, 
				'recheckDate' => $get_revisitDate, 
			);
		    $this->db->insert('checkup', $dulieuLuotKham);
		    $get_idLuotKham = $this->db->insert_id();
		    foreach ($luotkham['medicines'] as $thuoc) {
		        $get_medId = $thuoc['med_id'];
		        $get_medDose = $thuoc['med_dose'];
		        $dulieuDonThuoc = array(
					'id_luotkham' => $get_idLuotKham,
					'med_id' => $get_medId,
					'dose' => $get_medDose,
				);
			    $this->db->insert('prescription', $dulieuDonThuoc);
		    }
		}
	}


	// bác sĩ
	public function getDataDoctor_Bacsi($fac_id)
	{
		$this->db->select('
			doctor_id,
			doctor_name,
			doctor_phone
			');
		$this->db->where('fac_id', $fac_id);
		return $this->db->get('doctor');
	}

	public function xoaBacsi($id_canxoa)
	{
		$this->db->where('doctor_id', $id_canxoa);
		return $this->db->delete('doctor');
	}

	public function themBacsiController($idBacsi,$tenBacsi,$idKhoa,$sdtBacsi)
	{
		$dulieu = array(
			'doctor_id' => $idBacsi,
			'doctor_name' => $tenBacsi,
			'fac_id' => $idKhoa,
			'doctor_phone' => $sdtBacsi
			);
		if($this->db->get_where('doctor', array('doctor_id' => $idBacsi))->num_rows() > 0) {
			return 0;
		} else {
			$this->db->insert('doctor', $dulieu);
			return 1;
		}
	}

	//thuốc
	public function getDataThuoc_trangthuoc($idThuoc)
	{
		$this->db->select('*');
		$this->db->where('med_id', $idThuoc);
		return $this->db->get('medicine');
	}

	public function updateThuoc($idThuoc,$tenThuoc,$nccThuoc,$tpThuoc,$cdThuoc)
	{
		$data = array(
			'med_id' => $idThuoc, 
			'med_name' => $tenThuoc, 
			'nhacungcap' => $nccThuoc, 
			'thanhphan' => $tpThuoc, 
			'chidinh' => $cdThuoc, 
			);
		$this->db->where('med_id', $idThuoc);
		return $this->db->update('medicine', $data);
	}

	public function xoaThuoc($idThuoc)
	{
		$this->db->where('med_id', $idThuoc);
		return $this->db->delete('medicine');
	}

	public function themThuocVaoData($idThuoc,$tenThuoc,$nccThuoc,$tpThuoc,$cdThuoc)
	{
		$dulieu = array(
			'med_id' => $idThuoc,
			'med_name' => $tenThuoc,
			'nhacungcap' => $nccThuoc,
			'thanhphan' => $tpThuoc,
			'chidinh' => $cdThuoc,
			);
		if($this->db->get_where('medicine', array('med_id' => $idThuoc))->num_rows() > 0) {
			return 0;
		} else {
			$this->db->insert('medicine', $dulieu);
			return 1;
		}
	}
}

/* End of file hos_model.php */
/* Location: ./application/models/hos_model.php */