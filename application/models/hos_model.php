<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hos_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	// phần cho người khám nhé
	public function getDataPeople($identity)
	{
		$this->db->select('*');
		$this->db->where('identity', $identity);
		return $this->db->get('people');
	}

	public function updatePassword($identity,$new_pass)
	{
		$data = array(
			'passdangnhap' => $new_pass, 
			);
		$this->db->where('identity', $identity);
		return $this->db->update('people', $data);
	}

	// cho các phần kia
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

	public function getPasswordBacsi($identity)
	{
		$this->db->select('passdangnhap');
		$this->db->where('doctor_id', $identity);
		return $this->db->get('doctor');
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

	// thêm người tới khám
	public function themnguoikhamvaodb($p_iden,$p_name,$p_sex,$p_date,$p_address,$p_phone,$p_pass)
	{
		$dulieu = array(
			'identity' => $p_iden,
			'people_name' => $p_name,
			'sex' => $p_sex,
			'dob' => $p_date,
			'people_phone' => $p_phone,
			'address' => $p_address,
			'passdangnhap' => $p_pass,
			);
		if($this->db->get_where('people', array('identity' => $p_iden))->num_rows() > 0) {
			return 0;
		} else {
			$this->db->insert('people', $dulieu);
			return 1;
		}
	}

	// tra cứu
	public function getMangNgay($identity)
	{
		$this->db->distinct();
        $this->db->select('checkDate');
        $this->db->where('identity', $identity);
        $this->db->order_by('checkDate', 'DESC');
        return $this->db->get('checkup');
	}

	public function getMangLuotKham($identity,$ngayKham)
	{
		$this->db->select('
			id_luotkham,
			doctor_id,
			result, 
			recheckDate, 
			fee
		');
		$conditions = array(
		    'identity' => $identity,
		    'checkDate' => $ngayKham
		);

		$this->db->where($conditions);
		//$this->db->where('checkDate', $ngayKham);
		return $this->db->get('checkup');
	}

	public function getDataBacSi($idDoctor)
	{
		$this->db->select('d.doctor_name, fa.fac_name');
        $this->db->from('doctor d');
        $this->db->join('faculty fa', 'd.fac_id = fa.fac_id');
        $this->db->where('doctor_id', $idDoctor);
        $query = $this->db->get();
        return $query;
	}

	// public function getMangDonThuoc($idLuotKham)
	// {
	// 	$this->db->select('p.dose, m.med_name');
    //     $this->db->from('prescription p');
    //     $this->db->join('medicine m', 'p.med_id = m.med_id');
    //     $this->db->where('id_luotkham', $idLuotKham);
    //     $query = $this->db->get();
    //     return $query;
	// }

	public function getResult($id_luotKham)
	{
		$this->db->select('result');
		$this->db->where('id_luotkham', $id_luotKham);
		return $this->db->get('checkup');
	}

	public function getDonThuoc($id_luotKham)
	{
		$this->db->select('p.dose, m.med_name');
        $this->db->from('prescription p');
        $this->db->join('medicine m', 'p.med_id = m.med_id');
        $this->db->where('id_luotkham', $id_luotKham);
        $query = $this->db->get();
        return $query;
	}


	//đặt lịch khám
	public function getDataLuotKham($fac_id, $ngaydatkham)
	{
		$this->db->select('available_slots.slot_id, doctor.doctor_id, doctor.doctor_name, available_slots.work_date, available_slots.available_slot');
		$this->db->from('doctor');
		$this->db->join('available_slots', 'doctor.doctor_id = available_slots.doctor_id', 'left');
		$this->db->where('doctor.fac_id', $fac_id);
		$this->db->where('available_slots.work_date', $ngaydatkham);
		$this->db->where('available_slots.available_slot >', 0);
		$query = $this->db->get();
		return $query;
	}


	public function postDataDatLich($slot_id,$identity)
	{
		$this->db->select('work_date, available_slot');
		$this->db->from('available_slots');
		$this->db->where('slot_id', $slot_id);
		$query = $this->db->get()->result_array();
		foreach ($query as $row) {
	        $work_date = $row['work_date'];
	        $available_slot = $row['available_slot'];
	        $stt = (11 - $row['available_slot']);
	    }
		$dulieu = array(
			'slot_id' => $slot_id,
			'stt' => $stt,
			'identity' => $identity,
			);
		if($this->db->get_where('dsdatlich', array('identity' => $identity, 'slot_id' => $slot_id))->num_rows() > 0) {
			return 0;
		} else {
			$this->db->insert('dsdatlich', $dulieu);
			$data = array(
				'available_slot' => $available_slot - 1, 
				);
			$this->db->where('slot_id', $slot_id);
			$this->db->update('available_slots', $data);
			return 1;
		}
	}
	
	public function get_luotKhamDangCho($identity, $ngayHomNay)
	{
		$this->db->select('dsdatlich.stt, dsdatlich.identity, people.people_name');
		$this->db->from('available_slots');
		$this->db->join('dsdatlich', 'available_slots.slot_id = dsdatlich.slot_id');
		$this->db->join('people', 'dsdatlich.identity = people.identity');
		$this->db->where('available_slots.doctor_id', $identity);
		$this->db->where('available_slots.work_date', $ngayHomNay);
		return $this->db->get()->result_array();
	}

	public function pushDataLuotKham($doctor_id, $dataToSend)
	{
		$get_iden = $dataToSend['identity'];
		$get_date = $dataToSend['ngaykham'];
	    $get_doctor = $doctor_id;
	    $get_result = $dataToSend['results'];
	    $get_revisitDate = $dataToSend['revisit_date'];
	    $get_payment = $dataToSend['payment'];
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
	    foreach ($dataToSend['medicines'] as $thuoc) {
	        $get_medId = $thuoc['med_id'];
	        $get_medDose = $thuoc['med_dose'];
	        $dulieuDonThuoc = array(
				'id_luotkham' => $get_idLuotKham,
				'med_id' => $get_medId,
				'dose' => $get_medDose,
			);
		    $this->db->insert('prescription', $dulieuDonThuoc);
	    }
		return 1;
	}

	// public function xoaLuotVuaKham($identity, $ngaykham, $doctor_id)
	// {
	// 	$this->db->from('dsdatlich');
	// 	$this->db->join('available_slots', 'available_slots.slot_id = dsdatlich.slot_id');
	// 	$this->db->where('dsdatlich.identity', $identity);
	// 	$this->db->where('available_slots.doctor_id', $doctor_id);
	// 	$this->db->where('available_slots.work_date', $ngaykham);
	// 	return $this->db->delete('dsdatlich');
	// }

	// ui ui đcm ảo vãi ò... Cái trên mình không làm được mặc dù chat bảo thế
	// xong cái mình dùng cái dưới này được cmnl nài, đcm ảo lòi....
	public function xoaLuotVuaKham($identity, $ngaykham, $doctor_id)
	{
		$sql = "DELETE dsdatlich 
		        FROM dsdatlich 
		        JOIN available_slots ON available_slots.slot_id = dsdatlich.slot_id
		        WHERE dsdatlich.identity = ? 
		        AND available_slots.doctor_id = ? 
		        AND available_slots.work_date = ?";

		$this->db->query($sql, array($identity, $doctor_id, $ngaykham));
	}

	public function mangLuotKham_Bn($identity)
	{
		$this->db->select('dsdatlich.stt, available_slots.doctor_id, available_slots.work_date');
	    $this->db->from('dsdatlich');
	    $this->db->join('available_slots', 'dsdatlich.slot_id = available_slots.slot_id');
	    $this->db->where('dsdatlich.identity', $identity);
	    return $this->db->get()->result_array();
	}
}

/* End of file hos_model.php */
/* Location: ./application/models/hos_model.php */