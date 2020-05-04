<!DOCTYPE html>
<html lang="en">
<?php $session_value=(isset($_SESSION['sess_cname']))?$_SESSION['sess_cname']:'';?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By novariodaniel@gmail.com">
    <meta name="author" content="CV. Dua Sekawan">

    <title>Transaksi Penjualan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/style.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/font-awesome.css' ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url() . 'assets/css/4-col-portfolio.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/dataTables.bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/css/jquery.dataTables.min.css' ?>" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/dist/css/bootstrap-select.css' ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap-datetimepicker.min.css' ?>">
    <!-- Select2 -->
    <link href="<?php echo base_url() . 'assets/select2/dist/css/select2.min.css' ?>" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/jquery-ui-1.12.1/jquery-ui.css' ?>">
</head>

<body>

    <!-- Navigation -->
    <?php
    $this->load->view('admin/menu');
    ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <center><?php echo $this->session->flashdata('msg'); ?></center>
                <h1 class="page-header">Transaksi
                    <small>Penjualan</small>
                    <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small>Cari Produk!</small></a>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">               
                <form action="<?php echo base_url() . 'admin/Penjualan/add_to_cart' ?>" method="post">
                    <table>
                        <tr>
                            <th>Customer</th>
                            <th><input type="text" name="cust_id" id="cust_id" value="<?php echo $this->session->userdata('sess_cname');?>" class="form-control input-sm"></th>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <th><input style="margin-top: 5px;" type="text" name="hid_alamat" id="hid_alamat" value="<?php echo $this->session->userdata('sess_calamat');?>" class="form-control input-sm"></th>
                        </tr>
                        <tr>
                            <th style="width: 200px;">
                                <input type="hidden" name="hid_custid" id="hid_custid" value="<?php echo $this->session->userdata('sess_cid');?>">
                                <input type="hidden" name="hid_custname" id="hid_custname" value="<?php echo $this->session->userdata('sess_cname');?>">
                                <input type="hidden" name="hid_limit" id="hid_limit" value="<?php echo $this->session->userdata('sess_climit');?>">
                                <input type="hidden" name="hid_hutang" id="hid_hutang" value="<?php echo $this->session->userdata('sess_chutang');?>">
                                <input type="hidden" name="hid_sisa" id="hid_sisa" value="<?php echo $this->session->userdata('sess_csisa');?>">                                                                
                            </th>
                        </tr>
                        <tr><th><label></label></th></tr>                     
                            <tr>                        
                                <th><label id="lbl_limit" style="width: 50px; font-family: Courier New;">Limit</label></th>
                                <th><label style="font-family: Courier New; color: blue;" id="l_limit" name="l_limit"></label></th>                        
                            </tr>
                            <tr>
                                <th><label id="lbl_hutang" style="width: 50px;font-family: Courier New;">Hutang</label></th>
                                <th><label style="font-family: Courier New; color:red;" id=l_hutang name="l_hutang"></label></th>
                            </tr>
                            <tr>
                                <th><label id="lbl_sisa" style="width: 50px;font-family: Courier New;">Sisa</label></th>
                                <th><label style="font-family: Courier New; color:green;" id=l_sisa name="l_sisa"></label></th>
                            </tr>
                    </table>
                    <!-- &nbsp; -->
                    <table>
                        <!-- <input type="text" name="vlimit" id="vlimit">
                        <input type="text" name="vhutang" id="vhutang"> -->
                        <tr>
                            <th>Kode/ Nama Barang</th>
                        </tr>
                        <tr>
                            <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>
                        </tr>
                        <div id="detail_barang" style="position:absolute;">
                        </div>
                    </table>
                </form>
                <table class="table table-bordered table-condensed" style="font-size:11px;margin-top:10px;">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th style="text-align:center;">Satuan</th>
                            <th style="text-align:center;">Harga(Rp)</th>
                            <th style="text-align:center;">Diskon(%)</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:center;">Sub Total</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($this->cart->contents() as $items) : ?>
                            <?php echo form_hidden($i . '[rowid]', $items['rowid']);
                            ?>
                            <tr>
                                <td><?= $items['id']; ?></td>
                                <td><?= $items['name']; ?></td>
                                <td style="text-align:center;"><?= $items['satuan']; ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['amount']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['disc']); ?></td>
                                <td style="text-align:center;"><?php echo number_format($items['qty']); ?></td>
                                <td style="text-align:right;"><?php echo number_format($items['subtotal']); ?></td>

                                <td style="text-align:center;"><a href="<?php echo base_url() . 'admin/Penjualan/remove/' . $items['rowid']; ?>" class="btn btn-warning btn-xs"><span class="fa fa-close"></span> Batal</a></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="<?php echo base_url() . 'admin/Penjualan/simpan_penjualan' ?>" method="post">
                    <table>
                        <input type="hidden" id="fin_limit" name="fin_limit" value="<?php echo $this->session->userdata('sess_climit');?>">
                        <input type="hidden" id="fin_hutang" name="fin_hutang" value="<?php echo $this->session->userdata('sess_chutang');?>">
                        <input type="hidden" id="fin_sisa" name="fin_sisa" value="<?php echo $this->session->userdata('sess_csisa');?>">
                        <input type="hidden" id="fin_alamat" name="fin_alamat" value="<?php echo $this->session->userdata('sess_calamat');?>">
                        <tr>
                            <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Simpan</button></td>
                            <th style="width:140px;">Sub Total</th>
                            <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total()); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                            <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total(); ?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                        </tr>
                        <tr>
                            <th>Cashback</th>
                            <th style="text-align:right;"><input type="text" id="cashback" name="cashback" class="cashback form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="cashback2" name="cashback2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Potong Aki Bekas</th>
                            <th style="text-align:right;"><input type="text" id="aki_bekas" name="aki_bekas" class="aki_bekas form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="aki_bekas2" name="aki_bekas2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Total Belanja</th>
                            <th style="text-align:right;"><input type="text" id=total_bel name="total_bel" value="<?php echo $this->cart->total(); ?>" class="total_bel form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                            <input type="hidden" id="total_bel2" name="total_bel2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" value="<?php echo $this->cart->total(); ?>" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Tunai</th>
                            <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>
                        <tr>
                            <td></td>
                            <th>Kembalian</th>
                            <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                            <input type="hidden" id="kembalian2" name="kembalian2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                        </tr>

                    </table>
                </form>
                <hr />
            </div>
            <!-- /.row -->
            <!-- ============ MODAL ADD =============== -->
            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="myModalLabel">Data Barang</h3>
                        </div>
                        <div class="modal-body" style="overflow:scroll;height:500px;">

                            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;width:40px;">No</th>
                                        <th style="width:120px;">Kode Barang</th>
                                        <th style="width:240px;">Nama Barang</th>
                                        <th>Satuan</th>
                                        <th style="width:100px;">Harga (Eceran)</th>
                                        <th>Stok</th>
                                        <th style="width:100px;text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 0;
                                    foreach ($data->result_array() as $a) :
                                        $no++;
                                        $id = $a['barang_id'];
                                        $nm = $a['barang_nama'];
                                        $satuan = $a['barang_satuan'];
                                        $harpok = $a['barang_harpok'];
                                        $harjul = $a['barang_harjul'];
                                        $harjul_grosir = $a['barang_harjul_grosir'];
                                        $stok = $a['barang_stok'];
                                        $min_stok = $a['barang_min_stok'];
                                        $kat_id = $a['barang_kategori_id'];
                                        $kat_nama = $a['kategori_nama'];
                                    ?>
                                        <tr>
                                            <td style="text-align:center;"><?php echo $no; ?></td>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $nm; ?></td>
                                            <td style="text-align:center;"><?php echo $satuan; ?></td>
                                            <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                            <td style="text-align:center;"><?php echo $stok; ?></td>
                                            <td style="text-align:center;">
                                                <form action="<?php echo base_url() . 'admin/Penjualan/add_to_cart' ?>" method="post">
                                                    <input type="text" name="kode_brg_hid" value="<?php echo $id ?>">
                                                    <input type="hidden" name="nabar" value="<?php echo $nm; ?>">
                                                    <input type="hidden" name="satuan" value="<?php echo $satuan; ?>">
                                                    <input type="hidden" name="stok" value="<?php echo $stok; ?>">
                                                    <input type="hidden" name="harjul" value="<?php echo number_format($harjul); ?>">
                                                    <input type="hidden" name="diskon" value="0">
                                                    <input type="hidden" name="qty" value="1" required>
                                                    <button type="submit" class="btn btn-xs btn-info" title="Pilih"><span class="fa fa-edit"></span> Pilih</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>

                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>

                        </div>
                    </div>
                </div>
            </div>



            <!-- ============ MODAL HAPUS =============== -->


            <!--END MODAL-->

            <hr>

            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p style="text-align:center;">Copyright &copy; <?php echo '2020'; ?> by CV. Dua Sekawan</p>
                    </div>
                </div>
                <!-- /.row -->
            </footer>

        </div>
        <!-- /.container -->

        <!-- jQuery -->
        <script src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() . 'assets/dist/js/bootstrap-select.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/dataTables.bootstrap.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.dataTables.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/jquery.price_format.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/moment.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/jquery-ui-1.12.1/jquery-ui.js' ?>"></script>
        <script src="<?php echo base_url() . 'assets/select2/dist/js/select2.min.js' ?>"></script>
        <script type="text/javascript">
            $(function() {
                $('#jml_uang').on("input", function() {
                    var total = $('#total').val();
                    var jumuang = $('#jml_uang').val();
                    var cashback = $('#cashback').val();
                    var aki_bekas = $('#aki_bekas').val();
                    var cb = cashback.replace(/[^\d]/g, "");
                    var ab = aki_bekas.replace(/[^\d]/g, "");
                    $('#cashback2').val(cb);
                    $('#aki_bekas2').val(ab);
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    $('#jml_uang2').val(hsl);
                    var tes = hsl - (total - cb - ab);
                    var total_bel = total - cb - ab;
                    $('#total_bel2').val(total_bel);
                    $('#total_bel').val(total_bel).priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                    });
                    $('#kembalian2').val(tes);
                    if (tes > 0) {
                        $('#kembalian').val(tes).priceFormat({
                            prefix: '',
                            //centsSeparator: '',
                            centsLimit: 0,
                            thousandsSeparator: ','
                        });
                    } else {
                        $('#kembalian').val(tes);
                    }
                })

                $('#cashback').on("input", function() {
                    var cashback = $('#cashback').val();
                    var aki_bekas = $('#aki_bekas').val();
                    var jumuang = $('#jml_uang').val();
                    var total = $('#total').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    var cb = cashback.replace(/[^\d]/g, "");
                    var ab = aki_bekas.replace(/[^\d]/g, "");
                    $('#cashback2').val(cb);
                    $('#aki_bekas2').val(ab);
                    var tes = hsl - (total - cb - ab);
                    $('#kembalian2').val(tes);
                    var total_bel = total - cb - ab;
                    $('#total_bel2').val(total_bel);
                    $('#total_bel').val(total_bel).priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                    });
                    if (tes > 0) {
                        $('#kembalian').val(tes).priceFormat({
                            prefix: '',
                            //centsSeparator: '',
                            centsLimit: 0,
                            thousandsSeparator: ','
                        });
                    } else {
                        $('#kembalian').val(tes);
                    }
                })

                $('#aki_bekas').on("input", function() {
                    var cashback = $('#cashback').val();
                    var aki_bekas = $('#aki_bekas').val();
                    var jumuang = $('#jml_uang').val();
                    var total = $('#total').val();
                    var hsl = jumuang.replace(/[^\d]/g, "");
                    var ab = aki_bekas.replace(/[^\d]/g, "");
                    var cb = cashback.replace(/[^\d]/g, "");
                    $('#cashback2').val(cb);
                    $('#aki_bekas2').val(ab);
                    var tes = hsl - (total - cb - ab);
                    $('#kembalian2').val(tes);
                    var total_bel = total - cb - ab;
                    $('#total_bel2').val(total_bel);
                    $('#total_bel').val(total_bel).priceFormat({
                        prefix: '',
                        //centsSeparator: '',
                        centsLimit: 0,
                        thousandsSeparator: ','
                    });
                    if (tes > 0) {
                        $('#kembalian').val(tes).priceFormat({
                            prefix: '',
                            //centsSeparator: '',
                            centsLimit: 0,
                            thousandsSeparator: ','
                        });
                    } else {
                        $('#kembalian').val(tes);
                    }
                })

            });
        </script>
        <!-- <script type="text/javascript">
        $(document).ready(function() {
            // $('#mydata').DataTable();
        } );
    </script> -->
        <script type="text/javascript">
            $(function() {
                function reset() {
                    $('#cashback').val(0);
                    $('#jml_uang').val(0);
                    $('#kembalian').val(0);
                    $('#aki_bekas').val(0);
                    $('#total_bel').val($("#total").val());
                }
                reset();

                $('.total_bel').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });

                $('.cashback').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });

                $('.aki_bekas').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });

                $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
                $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
                });
                $('#kembalian').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });
                $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
                });            
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                if ($("#hid_custid").val()!=""){                   
                    document.getElementById('lbl_limit').innerHTML = "Limit";
                    document.getElementById('lbl_hutang').innerHTML = "Hutang";
                    document.getElementById('lbl_sisa').innerHTML = "Sisa";
                    document.getElementById('l_limit').innerHTML = $("#hid_limit").val();
                    document.getElementById('l_hutang').innerHTML = $("#hid_hutang").val();
                    document.getElementById('l_sisa').innerHTML = $("#hid_sisa").val();
                }else{
                    document.getElementById('lbl_limit').innerHTML = "";
                    document.getElementById('lbl_hutang').innerHTML = "";
                    document.getElementById('lbl_sisa').innerHTML = "";
                }
                // document.getElementById('l_limit').innerHTML = $("#hid_limit").val();
                // document.getElementById('l_hutang').innerHTML = $("#hid_hutang").val(); 
                // var _hidCustId = $("#hid_custid").val();
                // var _hidCustName = $("#hid_custname").val();
                // var _hidLimit = $("#hid_limit").val();
                // var _hidHutang = $("#hid_hutang").val();
                // var _custid = $("#cust_id").val();                
                // if (_hidCustId != "" && _custid == _hidCustName){
                //         document.getElementById('lbl_limit').innerHTML = "Limit";
                //         document.getElementById('lbl_hutang').innerHTML = "Hutang";
                //         document.getElementById('l_limit').innerHTML = _hidLimit;
                //         document.getElementById('l_hutang').innerHTML = _hidHutang;
                //         $("#jml_uang").val(_hidLimit).priceFormat({
                //             prefix: '',
                //             //centsSeparator: '',
                //             centsLimit: 0,
                //             thousandsSeparator: ','
                //         });
                // }else{
                //     document.getElementById('lbl_limit').innerHTML = "";
                //     document.getElementById('lbl_hutang').innerHTML = "";
                // } 

                $("#kode_brg").autocomplete({
                    source: "<?php echo base_url() . 'admin/Penjualan/get_autocomplete'; ?>"
                });

                $("#cust_id").autocomplete({
                    source: "<?php echo base_url() . 'admin/Penjualan/get_autocust'; ?>"
                });

                $("#kode_brg").focus();
                

                $("#cust_id").keyup(function() {
                    var custid = $("#cust_id").val();
                    // var custid = {
                    //     custid: $(this).val()
                    // };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'admin/Penjualan/get_customer';?>",
                        data: {custid:custid},
                        dataType: 'JSON',
                        success: function(msg) {
                            
                        }
                    });
                });

                $("#kode_brg").keyup(function() {
                    var kobar = {
                        kode_brg: $(this).val()
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url() . 'admin/Penjualan/get_barang'; ?>",
                        data: kobar,
                        success: function(msg) {
                            $('#detail_barang').html(msg);
                        }
                    });
                });

                $("#kode_brg").keypress(function(e) {
                    if (e.which == 13) {
                        $("#jumlah").focus();
                    }
                });

                $("#cust_id").keypress(function(e) {
                    if (e.which == 13) {
                        $("#hid_alamat").focus();
                    }
                });

                $("#hid_alamat").keypress(function(e) {
                    if (e.which == 13) {
                        $("#kode_brg").focus();
                    }
                });

                $("#hid_alamat").focusout(function(){
                    $("#fin_alamat").val($(this).val());
                    var alamat = $(this).val();
                    $.ajax({
                        type:"POST",
                        url :"<?php echo base_url().'admin/Penjualan/session_alamat';?>",
                        data:{alamat:alamat},
                        dataType:'JSON',
                        success:function(data){
                            console.log(data);
                        }
                    })
                })

                $("#cust_id").focusout(function(){
                    // location.reload();                 
                    // var cust_id = $("#cust_id").val();   
                    var cust_id = $(this).val();
                    // var hid_custname = $("#hid_custname").val();            
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url().'admin/Penjualan/get_cust_byname';?>",
                        data: {cust_id:cust_id},
                        dataType: 'JSON',
                        success: function(data) {
                            // console.log(cust_id);                            
                            if (!$.trim(data)){
                                $("#hid_custid").val("");
                                $("#hid_custname").val(cust_id);
                                $("#hid_limit").val("");
                                $("#hid_hutang").val("");
                                $("#hid_sisa").val("");
                                $("#hid_alamat").val("");
                                $("#fin_limit").val("");
                                $("#fin_hutang").val("");
                                $("#fin_sisa").val("");
                                $("#fin_alamat").val("");
                        
                                document.getElementById('lbl_limit').innerHTML = "";
                                document.getElementById('lbl_hutang').innerHTML = "";
                                document.getElementById('lbl_sisa').innerHTML = "";
                                document.getElementById('l_limit').innerHTML = "";
                                document.getElementById('l_hutang').innerHTML = "";
                                document.getElementById('l_sisa').innerHTML = "";
                            }else{
                                sisa = data.customer_limit - data.customer_hutang;
                                $("#hid_custid").val(data.customer_id);
                                $("#hid_custname").val(data.customer_name);
                                $("#hid_alamat").val(data.customer_alamat);
                                $("#fin_alamat").val(data.customer_alamat);
                                $("#hid_limit").val(data.customer_limit).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });
                                $("#hid_hutang").val(data.customer_hutang).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });
                                $("#hid_sisa").val(sisa).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });

                                $("#fin_limit").val(data.customer_limit).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });

                                $("#fin_hutang").val(data.customer_hutang).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });

                                $("#fin_sisa").val(sisa).priceFormat({
                                    prefix: '',
                                    //centsSeparator: '',
                                    centsLimit: 0,
                                    thousandsSeparator: ','
                                });
                                                                
                                document.getElementById('lbl_limit').innerHTML = "Limit";
                                document.getElementById('lbl_hutang').innerHTML = "Hutang";
                                document.getElementById('lbl_sisa').innerHTML = "Sisa";
                                document.getElementById('l_limit').innerHTML = $("#hid_limit").val();
                                document.getElementById('l_hutang').innerHTML = $("#hid_hutang").val();
                                document.getElementById('l_sisa').innerHTML = $("#hid_sisa").val();
                            }                         
                        }
                    });                 
                })
            });
        </script>


</body>

</html>