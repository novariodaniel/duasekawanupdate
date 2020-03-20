<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();		
		if($this->session->userdata('masuk') !=TRUE){			
			// $url=base_url();
			$url = 'Administrator';
            redirect($url);
        };
		$this->load->model('M_kategori');
		$this->load->model('M_barang');
		$this->load->model('M_penjualan');
		$this->load->library('Barcode');
	}
	function index(){
		// echo base_url();die();
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_barang->tampil_barang();
		$data['kat']=$this->M_kategori->tampil_kategori();
		$data['kat2']=$this->M_kategori->tampil_kategori();
		$this->load->view('admin/v_barang',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function tambah_barang(){
	if($this->session->userdata('akses')=='1'){
		$kobar=$this->M_barang->get_kobar();
		$nabar=$this->input->post('nabar');
		$kat=$this->input->post('kategori');
		$satuan=$this->input->post('satuan');
		$harpok=str_replace(',', '', $this->input->post('harpok'));
		$harjul=str_replace(',', '', $this->input->post('harjul'));		
		$stok=$this->input->post('stok');
		$min_stok=$this->input->post('min_stok');
		$this->M_barang->simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok);

		redirect('admin/Barang');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function edit_barang(){
	if($this->session->userdata('akses')=='1'){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$kat=$this->input->post('kategori');
		$satuan=$this->input->post('satuan');
		$harpok=str_replace(',', '', $this->input->post('harpok'));
		$harjul=str_replace(',', '', $this->input->post('harjul'));		
		$stok=$this->input->post('stok');
		$min_stok=$this->input->post('min_stok');
		$this->M_barang->update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$stok,$min_stok);
		redirect('admin/Barang');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function hapus_barang(){
	if($this->session->userdata('akses')=='1'){
		$kode=$this->input->post('kobar');	
		$result['rows'] = $this->M_penjualan->get_barang_jual($kode);			
						
		if($result['rows']->num_rows() > 0){
			// echo "masuk sini 1";
			$data['status'] = 0;
			$data['message'] = "Data tidak bisa dihapus, data sudah digunakan di modul penjualan";
			echo json_encode($data);			
			return;
		}else{					
			// print_r($this->M_barang->hapus_barang($kode));die();	
			if ($this->M_barang->hapus_barang($kode) == 1){
				$data['status'] = 1;
				$data['message'] = "Data sudah dihapus";								
			}else{
				$data['status'] = 2;
				$data['message'] = "Data gagal dihapus";				
			}			
			echo json_encode($data);			
			return;
		}
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
}