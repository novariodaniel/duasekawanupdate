<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By novariodaniel@gmail.com">
    <meta name="author" content="CV. Dua Sekawan">

    <title>Welcome To Point of Sale Apps</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/bootstrap-select.css'?>" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url().'assets/select2/dist/css/select2.min.css'?>" rel="stylesheet" />
    <!-- jQuery library -->
   <script src="<?php echo base_url().'assets/jquery-3.3.1.min.js'?>"></script>

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
            <center><?php echo $this->session->flashdata('msg');?></center>
                <h1 class="page-header">Data
                    <small>Sales</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Sales</a></div>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:11px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>                        
                        <th>Sales</th>
                        <th>Area</th>                        
                        <th>Buyer</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;                    
                        $id=$a['sales_mapping_id'];
                        $sales_id=$a['sales_id'];
                        $karyawan_id=$a['karyawan_id'];   
                        $sales_nama=$a['karyawan_nama'];                    
                        $sales_area=$a['sales_area'];
                        $sales_buyer=$a['sales_buyer'];                                              
                        $sales_status=$a['sales_status'];
                        $karyawan_status=$a['karyawan_status'];
                ?>
                <?php                                                                            
                    if ($sales_status == 1){                        
                        $defJK = "Aktif";
                    }                                        
                ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $sales_nama;?></td>
                        <td><?php echo $sales_area;?></td>
                        <td><?php echo $sales_buyer;?></td>                        
                        <td style="text-align:center;">
                            <!-- <a class="btn btn-xs btn-warning" href="#" data-toggle="modal" title="Edit"><span class="fa fa-edit"></span> Edit</a> -->
                            <a href="#" class="btn btn-xs btn-warning update-record" data-sales_mapping_id="<?php echo $id;?>" data-karyawan_id="<?php echo $karyawan_id;?>" data-sales_nama="<?php echo $sales_nama;?>" data-sales_area="<?php echo $sales_area;?>"data-sales_buyer="<?php echo $sales_buyer;?>"data-isactive="<?php echo $sales_status;?>"data-sales_id="<?php echo $sales_id;?>"><span class="fa fa-edit"></span>Edit</a>
                            <!-- <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Nonaktifkan</a> -->
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Sales</h3>
            </div>
            <div class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Sales</label>
                        <div class="col-xs-9">
                        <select id='selSales' style='width: 200px;'>
                            <option value='0'>-- Pilih sales --</option>
                        </select>
                        </div>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Area</label>
                        <div class="col-xs-9">
                            <input name="add_area" id="add_area"class="form-control" type="text" placeholder="Input Area..." style="width:280px;" required>
                        </div>
                    </div>                   

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Konsumen</label>
                        <div class="col-xs-9">
                            <input name="add_konsumen" id="add_konsumen" class="form-control" type="text" placeholder="Input konsumen..." style="width:280px;" required>
                        </div>
                    </div>                

                    <div class="form-group">
                        <label class="control-label col-xs-3" >isActive</label>
                        <div class="col-xs-7">
                             <select name="isActive" id="add_isActive" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih isActive" data-width="80%" placeholder="Pilih Satuan" required>
                                <option value="1" selected="selected">Aktif</option>
                                <option value="2">Non Aktif</option>                                
                             </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="simpan">Simpan</button>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- ============ MODAL EDIT =============== -->
        <?php            
                    foreach ($data->result_array() as $a) {
                        $id=$a['sales_mapping_id'];
                        $sales_id=$a['sales_id'];
                        $karyawan_id=$a['karyawan_id'];   
                        $sales_nama=$a['karyawan_nama'];                    
                        $sales_area=$a['sales_area'];
                        $sales_buyer=$a['sales_buyer'];                                              
                        $sales_status=$a['sales_status'];
                        $karyawan_status=$a['karyawan_status'];
                        
                    ?>                    
                <div id="UpdateModal" class="modal fade" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Edit Sales</h3>
                    </div>
                    
                    <!-- <div class="form-horizontal"> -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/Sales/edit_sales'?>">
                        <div class="modal-body">                            
                            <input name="karyawan_id" id="karyawan_id" type="hidden" value="<?php echo $karyawan_id;?>">
                            <input name="sales_id" id="sales_id" type="hidden">                            
                            <input type="hidden" name="sales_mapping_id" required>
                            <div class="form-group">
                                <label class="control-label col-xs-3" >Nama Sales</label>
                                <div class="col-xs-9">
                                <select id='sss' name="sss" style='width: 200px;'>
                                    <option value='<?php echo $karyawan_id;?>'><?php echo $sales_nama;?></option>    
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Area</label>
                                <div class="col-xs-9">
                                    <input name="edit_area" id="edit_area" class="form-control" type="text" value="<?php echo $sales_area;?>" placeholder="Input sales area..." style="width:280px;" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Konsumen</label>
                                <div class="col-xs-9">
                                    <input name="edit_buyer" id="edit_buyer" class="form-control" type="text" placeholder="Input konsumen..." style="width:280px;" value="<?php echo $sales_buyer;?>">
                                </div>
                            </div>                            
                                                       
                            <div class="form-group">
                                <label class="control-label col-xs-3" >isActive</label>
                                <div class="col-xs-8">
                                    <select name="edit_isactive" id="edit_isactive" class="selectpicker show-tick form-control" style="width:280px;" required>                                    
                                        <option value="1">Aktif</option>
                                        <option value="2">Non Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button type="submit" class="btn btn-info">Update</button>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php
        }
        ?>

       <!-- ============ MODAL HAPUS =============== -->
       <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['karyawan_id'];                       
                    ?>
                <div id="modalHapusPelanggan<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Karyawan</h3>
                    </div>
                    
                        <div class="modal-body">                            
                            <p>Yakin mau menghapus data karyawan ini..?</p>                                    
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-primary btnHapus" value ="<?php echo $id;?>"data-dismiss="modal">Hapus</button>                            
                        </div>
                    
                </div>
                </div>
                </div>
            <?php
        }
        ?>

        <!--END MODAL-->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p style="text-align:center;">Copyright &copy; <?php echo '2020';?> by CV. Dua Sekawan</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.js'?>"></script>
    <!-- Select2 JS -->
   <script src="<?php echo base_url().'assets/select2/dist/js/select2.min.js'?>"></script>
    <script type="text/javascript">

        $(document).ready(function() {         
            $('.bootstrap-select').selectpicker();
            
            //GET UPDATE
            $('.update-record').on('click',function(){
                var sales_mapping_id = $(this).data('sales_mapping_id');
                var sales_id    = $(this).data('sales_id');
                var isActive    = $(this).data('isactive');
                var sales_area  = $(this).data('sales_area');
                var sales_buyer = $(this).data('sales_buyer');
                var sales_nama  = $(this).data('sales_nama');
                var karyawan_id  = $(this).data('karyawan_id');
                var status   = "Aktif";
                if (isActive != "1"){
                    status = "Non Aktif";
                }

                $(".sss").val('');
                $('#UpdateModal').modal('show');                
                $('[name="sales_id"]').val(sales_id);
                $('[name="edit_area"]').val(sales_area);
                $('[name="edit_buyer"]').val(sales_buyer);
                $('[name="sales_mapping_id"]').val(sales_mapping_id);

                var $newOption1 = $("<option selected='selected'></option>").val(karyawan_id).text(sales_nama);
                $("#sss").append($newOption1).trigger('change');
                // $("#sss").selectpicker('refresh');

                var $newOption2 = $("<option selected='selected'></option>").val(isActive).text(status);
                $("#edit_isactive").append($newOption2).trigger('change');                                
                
            });

            $("#sss").select2({                                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales/getKaryawan",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $("#selSales").select2({                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales/getKaryawan",
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            searchTerm: params.term // search term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });

            $(document).on('click', ".btnHapus",function(){                   
                var karyawan_id = $(this).val();
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_id:karyawan_id},
                    url : "<?php echo base_url()?>admin/Karyawan/nonaktifkan",
                    success:function(data){  
                        var data = $.parseJSON(data);                      
                        console.log(data);
                        alert(data.message);
                        location.reload();
                    }
                });
            });

            

            $("#simpan").click(function(){                       
                karyawan_id = $("#selSales").val();
                sales_area  = $("#add_area").val();
                sales_konsumen = $("#add_konsumen").val();
                sales_isActive = $("#add_isActive").val();                
                
                $.ajax({
                    type: "POST",
                    data: {karyawan_id: karyawan_id,
                            sales_area: sales_area,
                            sales_konsumen: sales_konsumen,
                            sales_isActive: sales_isActive},
                    url: "<?php echo base_url()?>admin/Sales/tambah_sales", 
                    success:function(data){                        
                        var data = $.parseJSON(data);                      
                        console.log(data);
                        alert(data.message);
                        location.reload();
                        
                    }
                });
            })
            
            $('#mydata').DataTable();
        });
    </script>
    
    
</body>

</html>