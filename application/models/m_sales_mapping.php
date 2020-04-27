<?php
class M_sales_mapping extends CI_Model{    
    function get_init(){
		$hsl=$this->db->query("select a.id_mapping,a.id_sales,a.id_customer,a.id_area,c.karyawan_nama,d.customer_name,e.area_nama
        from tbl_sales_mapping a
        join tbl_sales_master b on a.id_sales = b.sales_id 
        join tbl_karyawan c on b.karyawan_id = c.karyawan_id
        join tbl_customer d on a.id_customer = d.customer_id
        join tbl_area e on a.id_area = e.id_area");
		return $hsl;
    }

    function get_customer($param=""){
        $fetched_records=$this->db->query("SELECT * FROM tbl_customer WHERE customer_flagging = 1 and customer_name like'%$param%'");
        $customer = $fetched_records->result_array();
        $data = array();
		 foreach($customer as $arrCust){
			$data[] = array("id"=>$arrCust['customer_id'], "text"=>$arrCust['customer_name']);
		 }
		return $data;
    }
    
    function get_sales($param=""){
		$fetched_records=$this->db->query("select b.sales_id,a.karyawan_id,a.karyawan_nama,b.sales_status,a.karyawan_status
		from tbl_karyawan a
		join tbl_sales_master b
		on a.karyawan_id = b.karyawan_id
		where b.sales_status !=0 and a.karyawan_status != 0 and a.karyawan_nama like'%$param%'");
		$sales = $fetched_records->result_array();
		
		 // Initialize Array with fetched data
		 $data = array();
		 foreach($sales as $arrSales){
			$data[] = array("id"=>$arrSales['sales_id'], "text"=>$arrSales['karyawan_nama']);
		 }
		 return $data;
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