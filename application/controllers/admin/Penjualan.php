<?php
class Penjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_suplier');
		$this->load->model('M_penjualan');
	}
	function index(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$data['data']=$this->M_barang->tampil_barang();
		$this->load->view('admin/v_penjualan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function get_barang(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kobar=$this->input->post('kode_brg');
		// echo $kobar;die();
		$x['brg']=$this->M_barang->get_barang_dynamic($kobar);
		$this->load->view('admin/v_detail_barang_jual',$x);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function add_to_cart(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kobar=$this->input->post('kode_brg');
		$produk=$this->M_barang->get_barang_dynamic($kobar);
		$harjul=$this->input->post('harjul');
		$qty = $this->input->post('qty');
		$diskonVal = $this->input->post('diskon')*(str_replace(",", "", $harjul)*$qty)/100;
		// echo $diskonVal;die();
		$i=$produk->row_array();
		$data = array(
               'id'       => $i['barang_id'],
               'name'     => $i['barang_nama'],
               'satuan'   => $i['barang_satuan'],
               'harpok'   => $i['barang_harpok'],	
			   'price'    => str_replace(",", "", $this->input->post('harjul'))-(($this->input->post('diskon')*str_replace(",", "", $this->input->post('harjul')))/100),
			   'disc'     => str_replace(",", "", $this->input->post('diskon')),
			   'discVal'  => $diskonVal,
               'qty'      => str_replace(",", "", $this->input->post('qty')),
               'amount'	  => str_replace(",", "", $this->input->post('harjul'))
			);		
			// print_r($data);die();
			// $this->cart->contents();die();
	if(!empty($this->cart->total_items())){
		$count = 0;
		// print_r($this->cart->contents());die();																																																				
		foreach ($this->cart->contents() as $items){
			$id=$items['id'];
			$qtylama=$items['qty'];			
			$rowid=$items['rowid'];
			$kobar=$this->input->post('kode_brg');
			$qty=$this->input->post('qty');
			if($id==$data['id']){
				$count++;
				$up=array(
					'rowid'=> $rowid,
					'qty'=>$qtylama+$qty
					);					
				if($up['qty']<=$i['barang_stok']){
					$this->cart->update($up);
				}else{
					echo $this->session->set_flashdata('msg','<label class="label label-danger">Stok barang tidak mencukupi </label>');
					redirect('admin/Penjualan');
				}
			}
		}
		if ($count==0){		
			$this->cart->insert($data);
		}
	}else{
		$this->cart->insert($data);
	}

		redirect('admin/Penjualan');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function remove(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$row_id=$this->uri->segment(4);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('admin/Penjualan');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function simpan_penjualan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$total=$this->input->post('total');
		$cashback = $this->input->post('cashback2');		
		$jual_belanja = $total - $cashback;
		$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
		$kembalian=$jml_uang-$total;
		if(!empty($total) && !empty($jml_uang)){
			if($jml_uang < $total){
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('admin/Penjualan');
			}else{
				$nofak=$this->M_penjualan->get_nofak();
				$this->session->set_userdata('nofak',$nofak);
				$order_proses=$this->M_penjualan->simpan_penjualan($nofak,$total,$jml_uang,$jual_belanja,$kembalian,$cashback);
				if($order_proses){
					$this->cart->destroy();
					
					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('suplier');
					$this->load->view('admin/alert/alert_sukses');	
				}else{
					redirect('admin/Penjualan');
				}
			}
			
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('admin/Penjualan');
		}

	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function cetak_faktur(){
		$x['data']=$this->M_penjualan->cetak_faktur();
		$x['sum_qty'] = $this->M_penjualan->sum_qty();
		// print_r($x);die();		
		// print_r ($x['data']); die();
		$this->load->view('admin/laporan/v_faktur',$x);
		//$this->session->unset_userdata('nofak');
	}

	function get_autocomplete(){		
        if (isset($_GET['term'])) {
			$result = $this->M_barang->search_barang($_GET['term']);			
			// print_r($result);die();
			// $final = $result->row_array();
			// print_r($final);die();
            if (count($result) > 0) {
			foreach ($result as $row)								
				$arr_result[] = $row->barang_nama;				
				// $arr_result[] = $row->barang_id;	
                echo json_encode($arr_result);
            }
        }
	}


}