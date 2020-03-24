<?php
class Laporan extends CI_Controller{
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
		$this->load->model('M_pembelian');
		$this->load->model('M_penjualan');
		$this->load->model('M_laporan');
		$this->load->library('Excel');
		$this->load->library('pdf');
	}
	function index(){
	if($this->session->userdata('akses')=='1'){
		$data['data']=$this->M_barang->tampil_barang();
		$data['kat']=$this->M_kategori->tampil_kategori();
		$data['jual_bln']=$this->M_laporan->get_bulan_jual();
		$data['jual_thn']=$this->M_laporan->get_tahun_jual();
		$this->load->view('admin/v_laporan',$data);
	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function lap_pembelian_xls(){
		$x['data'] = $this->M_laporan->get_data_pembelian();
		$x['jml']  = $this->M_laporan->get_total_pembelian();
		$this->load->view('admin/laporan/v_lap_beli_xls',$x);
	}

	function lap_pembelian_pdf(){
		$x['data'] = $this->M_laporan->get_data_pembelian();
		$x['jml']  = $this->M_laporan->get_total_pembelian();
		$this->load->view('admin/laporan/v_lap_beli_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_beli.pdf",array("Attachment"=>0));
	}

	function lap_beli_xls_cust(){		
		$dateFrom=$this->input->post('dateFrom');
		$dateTo = $this->input->post('dateTo');		
		$x['data']=$this->M_laporan->get_data_beli_cust($dateFrom,$dateTo);		
		$x['jml']=$this->M_laporan->get_total_beli_cust($dateFrom,$dateTo);		
		$this->load->view('admin/laporan/v_lBeli_custX',$x);
	}

	function lap_beli_pdf_cust(){
		// $tanggal=$this->input->post('tgl');
		$dateFrom=$this->input->post('dateFrom');
		$dateTo = $this->input->post('dateTo');		
		$x['data']=$this->M_laporan->get_data_beli_cust($dateFrom,$dateTo);		
		$x['jml']=$this->M_laporan->get_total_beli_cust($dateFrom,$dateTo);		
		$this->load->view('admin/laporan/v_lBeli_custP',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_beli_range_date.pdf",array("Attachment"=>0));		
	}

	function lap_return_xls(){
		$x['data'] = $this->M_laporan->get_data_return();				
		$this->load->view('admin/laporan/v_lReturn_xls',$x);		
	}

	function lap_return_pdf(){
		$x['data'] = $this->M_laporan->get_data_return();
		// $x['jml']  = $this->M_laporan->get_total_return();
		$this->load->view('admin/laporan/v_lReturn_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_return.pdf",array("Attachment"=>0));
	}

	function lap_jual_xls(){
		$x['data'] = $this->M_laporan->get_data_jual();
		$x['jml']  = $this->M_laporan->get_total_jual();
		$this->load->view('admin/laporan/v_lJual_xls',$x);		
	}

	function lap_jual_pdf(){
		$x['data'] = $this->M_laporan->get_data_jual();
		$x['jml']  = $this->M_laporan->get_total_jual();
		$this->load->view('admin/laporan/v_lJual_pdf',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_jual.pdf",array("Attachment"=>0));
	}

	function lap_jual_xls_cust(){		
		$dtJx1=$this->input->post('dtJx1');
		$dtJx2 = $this->input->post('dtJx2');			
		$x['data']=$this->M_laporan->get_data_jual_cust($dtJx1,$dtJx2);		
		$x['jml']=$this->M_laporan->get_total_jual_cust($dtJx1,$dtJx2);		
		$this->load->view('admin/laporan/v_lJual_custX',$x);
	}

	function lap_jual_pdf_cust(){
		$dtJp1=$this->input->post('dtJp1');
		$dtJp2 = $this->input->post('dtJp2');		
		$x['data']=$this->M_laporan->get_data_jual_cust($dtJp1,$dtJp2);		
		$x['jml']=$this->M_laporan->get_total_jual_cust($dtJp1,$dtJp2);		
		$this->load->view('admin/laporan/v_lJual_custP',$x);	
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_jual_range_date.pdf",array("Attachment"=>0));		
	}

	function lap_stok_barang(){
		$x['data']=$this->M_laporan->get_stok_barang();
		$this->load->view('admin/laporan/v_lap_stok_barang',$x);
	}
	function lap_data_barang_xls(){		
		$x['data']=$this->M_laporan->get_data_barang1();
		$this->load->view('admin/laporan/v_lap_barang_xls',$x);
	}
	function lap_data_barang(){
		$x['data']=$this->M_laporan->get_data_barang1();
		$this->load->view('admin/laporan/v_lBarang_pdf',$x);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHTML($html);
		$this->dompdf->setPaper('A4','landscape');
		$this->dompdf->render();
		$this->dompdf->stream("lap_barang.pdf",array("Attachment"=>0));		
	}
	function lap_data_penjualan(){
		$x['data']=$this->M_laporan->get_data_penjualan();
		$x['jml']=$this->M_laporan->get_total_penjualan1();
		$this->load->view('admin/laporan/v_lap_penjualan',$x);
	}
	function lap_penjualan_pertanggal(){
		$tanggal=$this->input->post('tgl');
		$x['jml']=$this->M_laporan->get_data__total_jual_pertanggal1($tanggal);
		$x['data']=$this->M_laporan->get_data_jual_pertanggal($tanggal);		
		$this->load->view('admin/laporan/v_lap_jual_pertanggal',$x);
	}
	function lap_penjualan_perbulan(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->M_laporan->get_total_jual_perbulan1($bulan);
		$x['data']=$this->M_laporan->get_jual_perbulan($bulan);
		$this->load->view('admin/laporan/v_lap_jual_perbulan',$x);
	}	
	function lap_penjualan_pertahun(){
		$tahun=$this->input->post('thn');
		$x['jml']=$this->M_laporan->get_total_jual_pertahun1($tahun);
		$x['data']=$this->M_laporan->get_jual_pertahun($tahun);
		$this->load->view('admin/laporan/v_lap_jual_pertahun',$x);
	}
	function lap_laba_rugi(){
		$bulan=$this->input->post('bln');
		$x['jml']=$this->M_laporan->get_total_lap_laba_rugi($bulan);
		$x['data']=$this->M_laporan->get_lap_laba_rugi($bulan);
		$this->load->view('admin/laporan/v_lap_laba_rugi',$x);
	}
}