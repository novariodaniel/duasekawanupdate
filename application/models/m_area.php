<?php
class M_area extends CI_Model{
	function get_karyawan($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_karyawan WHERE karyawan_status = 1 and karyawan_nama like'%$param%'");
		return $hsl;
	}

	function get_area($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_area WHERE area_flagging = 1 and area_nama like'%$param%'");
		return $hsl;
	}

	function get_sales($param=""){
		$fetched_records=$this->db->query("SELECT * FROM tbl_karyawan WHERE karyawan_status = 1 and karyawan_nama like'%$param%'");
		$sales = $fetched_records->result_array();		
		
		 // Initialize Array with fetched data
		 $data = array();
		 foreach($sales as $arrSales){
			$data[] = array("id"=>$arrSales['karyawan_id'], "text"=>$arrSales['karyawan_nama']);
		 }
		 return $data;
	}

	function simpan_area($param){
        $area_name         = $param[0];
		$area_flagging     = $param[1];		
		$insert_date       = $param[2];
		$update_date       = $param[3];
		$insert_user       = $param[4];
		$update_user       = $param[5];
        
        $hsl=$this->db->query("INSERT INTO tbl_area(area_nama,area_flagging,insert_datetime,update_datetime,insert_user,update_user) VALUES ('$area_name','$area_flagging','$insert_date','$update_date','$insert_user','$update_user')");
		return $hsl;
	}

	function update_area($area_id,$area_name,$update_date,$update_user){
		$hsl=$this->db->query("UPDATE tbl_area SET area_nama='$area_name', update_datetime='$update_date', update_user='$update_user'WHERE id_area='$area_id'");
		return $hsl;
	}

	function update_pengguna_nopass($kode,$nama,$username,$level){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET user_nama='$nama',user_username='$username',user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_pengguna($kode,$nama,$username,$password,$level){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET user_nama='$nama',user_username='$username',user_password=md5('$password'),user_level='$level' WHERE user_id='$kode'");
		return $hsl;
	}
	function update_status($karyawan_id){
		$hsl=$this->db->query("UPDATE tbl_karyawan SET karyawan_status='0' WHERE karyawan_id='$karyawan_id'");
		return $hsl;
	}
}