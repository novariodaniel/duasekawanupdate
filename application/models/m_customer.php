<?php
class M_customer extends CI_Model{
	function get_customer($param=""){
		$hsl=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and customer_name like'%$param%'");
		return $hsl;
	}

	function simpan_customer($param){
        $customer_name     = $param[0];
        $customer_limit    = $param[1];
        $customer_hutang   = $param[2];
        $customer_alamat   = $param[3];
        $customer_telepon  = $param[4];
        $customer_flagging = $param[5];
        $insert_date       = $param[6];
        $update_date       = $param[7];
        $insert_user       = $param[8];
        $update_user       = $param[9];
        
        $hsl=$this->db->query("INSERT INTO tbl_customer(customer_name,customer_limit,customer_hutang,customer_alamat,customer_telepon,customer_flagging,insert_datetime,update_datetime,insert_user,update_user) VALUES ('$customer_name','$customer_limit','$customer_hutang','$customer_alamat','$customer_telepon','$customer_flagging','$insert_date','$update_date','$insert_user','$update_user')");
		return $hsl;
	}

	function update_customer($param){
        $hsl=$this->db->query("UPDATE tbl_customer SET customer_name='$param[1]', customer_limit='$param[2]', customer_hutang='$param[3]',customer_alamat='$param[4]',customer_telepon='$param[5]',update_datetime='$param[6]',update_user='$param[7]' WHERE customer_id='$param[0]'");		
		return $hsl;
	}

	function update_status($customer_id){
		$hsl=$this->db->query("UPDATE tbl_customer SET customer_flagging='0' WHERE customer_id='$customer_id'");
		return $hsl;
	}
}