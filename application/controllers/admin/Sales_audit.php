<?php
class Sales_audit extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            // $url=base_url();
            $url = 'Administrator';
            redirect($url);
        };
        $this->load->model('M_customer');
        $this->load->model('M_sales_audit');
    }
    
	function index(){
        if($this->session->userdata('akses')=='1'){
            $sales_id = $this->session->userdata('sales_id');
            $data['data']=$this->M_sales_audit->faktur_bysales($sales_id);
            $data['sales']=$this->M_sales_audit->tampil_sales();
            $this->load->view('admin/v_sales_audit',$data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function session_salesid(){
        if($this->session->userdata('akses')=='1'){
            $salesid = $this->input->post('sales_id');            
            $fetched_records = $this->M_sales_audit->sum_data($salesid)->result_array();
            $fetched_belanja = $this->M_sales_audit->sum_belanja($salesid)->result_array();
            // $this->session->set_userdata('')
            $belanja = 0;
            $setoran = 0;
            foreach($fetched_records as $a){                
                $setoran = $a['sum_setoran'];
            }

            foreach($fetched_belanja as $a){                
                $belanja = $a['sum_belanja'];
            }

            $this->session->set_userdata('sum_belanja',$belanja);
            $this->session->set_userdata('sum_setoran',$setoran);
            $this->session->set_userdata('sales_id',$salesid);
            $data['status'] = '1';
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }

    function tambah_customer(){                 
        if($this->session->userdata('akses')==1){        
            $customer_name     = $this->input->post('customer_name');
            $customer_limit    = $this->input->post('customer_limit'); 
            $customer_hutang   = $this->input->post('customer_hutang');
            $customer_alamat   = $this->input->post('customer_alamat');
            $customer_telepon  = $this->input->post('customer_telepon');
            $customer_flagging = $this->input->post('customer_flagging');                        
            $insert_date       = date("Y-m-d H:i:s");
            $update_date       = date("Y-m-d H:i:s");
            $insert_user       = $this->session->userdata('nama');
            $update_user       = $this->session->userdata('nama');
        };        

        $param = array($customer_name,$customer_limit,$customer_hutang,$customer_alamat,$customer_telepon,$customer_flagging,$insert_date,$update_date,$insert_user,$update_user);            
        
        if($this->M_customer->simpan_customer($param)==1){
            $data['status'] = 1;
            $data['message'] = "Data area berhasil disimpan";
        }else{
            $data['status'] = 0;
            $data['message'] = "Data area gagal disimpan";
        }        
        echo json_encode($data);
        return;
    }

    function edit_customer(){
        // echo "a";die();
        if($this->session->userdata('akses') == '1'){
            $custId      = $this->input->post('custId');
            $custName    = $this->input->post('custName');
            $custLimit   = $this->input->post('custLimit');
            $custHutang  = $this->input->post('custHutang');
            $custAlamat  = $this->input->post('custAlamat');
            $custTlp     = $this->input->post('custTlp');
            $update_date = date("Y-m-d H:i:s");
            $update_user = $this->session->userdata('nama');

            $param = array($custId,$custName,$custLimit,$custHutang,$custAlamat,$custTlp,$update_date,$update_user);

            if($this->M_customer->update_customer($param)==1){
                $data['status'] = 1;
                $data['message'] = "Data customer berhasil diupdate";
            }else{
                $data['status'] = 0;
                $data['message'] = "Data customer gagal diupdate";
            }        
            echo json_encode($data);
            return;
        }
    }

	function nonaktifkan(){
        if($this->session->userdata('akses')=='1'){
            $customer_id=$this->input->post('customer_id');
            $data['status'] = 0;
            $data['message'] = "Gagal hapus data customer";
            
            
            $fetched_records = $this->M_customer->validasi_delete($customer_id)->result_array();
            $hutang = 0;
            $customer_name = "";                        
            foreach($fetched_records as $a){
                $hutang = $a['customer_hutang'];
                $customer_name = $a['customer_name'];
            }            

            if ($hutang == 0){
                if($this->M_customer->update_status($customer_id)==1){
                    $data['status'] = 1;
                    $data['message'] = "Sukses hapus data customer";
                };                
            }else{
                $data['status'] = -1;
                $data['message'] = "Gagal hapus data customer, $customer_name masih memiliki hutang";
            }
            echo json_encode($data);            
        }else{
            echo "Halaman tidak ditemukan";
        }
    }
    
    function faktur_bysales(){
        if($this->session->userdata('akses')=='1'){
            $sales_id = $this->input->post('sales_id');            
            $data['detail'] = $this->M_sales_audit->faktur_bysales($sales_id);
            echo json_encode($data);
        }else{
            echo "Halaman tidak ditemukan";
        }
    }
}