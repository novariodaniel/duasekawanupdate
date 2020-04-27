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
    <link href="<?php echo base_url().'assets/css/fixedHeader.dataTables.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/sweetalert2.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/swal/all.css'?>" rel="stylesheet">
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
   <script src="<?php echo base_url().'assets/swal/sweetalert2.min.js'?>"></script>      

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
                    <small>Sales Mapping</small>
                    <div class="pull-right"><a id="tambahCustomer" href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#largeModal"><span class="fa fa-plus"></span> Tambah Sales Mapping</a></div>
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
                        <th style="text-align:center;">Sales</th>                    
                        <th style="width:140px;text-align:center;">Customer</th>
                        <th style="width:140px;text-align:center;">Area</th>
                        <th style="width:140px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no=0;
                    foreach ($data->result_array() as $a):
                        $no++;                        
                        $id_mapping=$a['id_mapping'];
                        $id_sales=$a['id_sales'];                        
                        $id_customer=$a['id_customer'];
                        $id_area=$a['id_area'];
                        $karyawan_nama=$a['karyawan_nama'];
                        $customer_name=$a['customer_name'];
                        $area_name=$a['area_name'];                                                                     
                ?>                
                    <tr data-idMapping="<?php echo $id_mapping;?>" data-idSales="<?php echo $id_sales;?>" data-idCust="<?php echo $id_customer;?>" data-idArea="<?php echo $id_area;?>" data-karyawan="<?php echo $karyawan_nama;?>" data-cust="<?php echo $customer_name;?>" data-area="<?php echo $area_name;?>">
                        <td style="text-align:center;"><?php echo $no;?></td>
                        <td><?php echo $karyawan_nama;?></td>
                        <td class='money'><?php echo $customer_name;?></td>
                        <td class='money'><?php echo $area_name;?></td>
                        <td style="text-align:center;">
                            <a data-id="<?php echo $id;?>" data-target = "#orderModal" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#orderModal" title="Edit"><span class="fa fa-edit"></span> Edit</a>
                            <a class="btn btn-xs btn-danger" href="#modalHapusCustomer<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fa fa-close"></span> Hapus</a>
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
                        <h3 class="modal-title" id="myModalLabel">Tambah Sales Mapping</h3>
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
                                <label class="control-label col-xs-3" >Nama Customer</label>
                                <div class="col-xs-9">
                                    <select id='selCust' style='width: 200px;'>
                                        <option value='0'>-- Pilih Customer --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Area</label>
                                <div class="col-xs-9">
                                    <select id='selArea' style='width: 200px;'>
                                        <option value='0'>-- Pilih Area --</option>
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
   
    <div id="orderModal" class="modal fade" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true" tabindex="-1" aria-labelledby="largeModal">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header">    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3>Edit Customer</h3>
                </div>
                <div class="form-horizontal">
                    <div class="modal-body">

                        <input type="hidden" id="orderId" name="orderId" class="form-control" style="width:280px;" readonly>
                        <div class="form-group">                                                
                            <label class="control-label col-xs-3" >Customer</label>
                            <div class="col-xs-9">                            
                                <input type="text" id="orderCustomer" name="orderCustomer" class="form-control" style="width:280px">
                            </div>
                        </div>

                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Limit</label>
                            <div class="col-xs-9">
                                <input type="text" id="orderLimit" name="orderLimit" class="money form-control input-sm" style="width:280px;">      
                            </div>
                        </div>

                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Hutang</label>                        
                            <div class="col-xs-9">
                                <input type="text" id="orderHutang" name="orderHutang" class="money form-control input-sm" style="width:280px;">      
                            </div>                        
                        </div>
                    
                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Alamat</label>                        
                            <div class="col-xs-9">
                                <input type="text" id="orderAlamat" name="orderAlamat" class="form-control" style="width:280px;">      
                            </div>                        
                        </div>
                    
                        <div class="form-group">                        
                            <label class="control-label col-xs-3" >Telepon</label>                        
                            <div class="col-xs-9">
                                <input type="text" id="orderTlp" name="orderTlp" class="form-control" style="width:280px;">      
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button id="orderSimpan" class="btn btn-info" data-dismiss="modal" aria-hidden="true" >Simpan</button>
                </div>
            </div>
        </div>
    </div> 
 


       <!-- ============ MODAL HAPUS =============== -->
       <?php
                    foreach ($data->result_array() as $a) {
                        $id=$a['customer_id'];                       
                    ?>
                <div id="modalHapusCustomer<?php echo $id?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 class="modal-title" id="myModalLabel">Hapus Customer</h3>
                    </div>
                    
                        <div class="modal-body">                            
                            <p>Yakin mau menghapus data customer ini..?</p>                                    
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
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/select2/dist/js/select2.min.js'?>"></script>
    <script type="text/javascript">
        $(function(){            
            $('#orderModal').modal({        
                keyboard: true,
                backdrop: "static",
                show:false,
        
            }).on('show.bs.modal', function(){
                var custId = $(event.target).closest('tr').data('id');
                var custName = $(event.target).closest('tr').data('name');
                var custLimit = $(event.target).closest('tr').data('limit');
                var custHutang = $(event.target).closest('tr').data('hutang');
                var custAlamat = $(event.target).closest('tr').data('alamat');
                var custTlp = $(event.target).closest('tr').data('telepon');
                $('#orderId').val(custId);
                $('#orderCustomer').val(custName);
                $('#orderLimit').val(custLimit);
                $('#orderHutang').val(custHutang);
                $('#orderAlamat').val(custAlamat);
                $('#orderTlp').val(custTlp);
            });
        });
        
        $("#orderSimpan").click(function(){
            custId     = $('#orderId').val();
            custName   = $('#orderCustomer').val();
            custLimit  = $('#orderLimit').val().replace(/[^\d]/g,"");;
            custHutang = $('#orderHutang').val().replace(/[^\d]/g,"");;
            custAlamat = $('#orderAlamat').val();
            custTlp    = $('#orderTlp').val();

            $.ajax({
                    type: "POST",
                    data: {custId:custId,
                           custName:custName,
                           custLimit:custLimit,
                           custHutang:custHutang,
                           custAlamat:custAlamat,
                           custTlp:custTlp
                    },
                    url : "<?php echo base_url()?>admin/Customer/edit_customer",
                    success:function(data){  
                        var data = $.parseJSON(data);                      
                        if (data.status == 1){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: data.message,                                
                            }).then (function(){
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: data.message,
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }  
                    }
                });            
        })

        function reset(){
            $("#add_customer").val("");
            $("#add_limit").val("");
            $("#add_hutang").val("");
            $("#add_alamat").val("");
            $("#add_telepon").val("");
        }

        $(document).ready(function() {
            $("#selSales").select2({                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales_mapping/get_sales",
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

            $("#selCust").select2({                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales_mapping/get_customer",
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

            $("#selArea").select2({                
                ajax: { 
                    url: "<?php echo base_url()?>admin/Sales_mapping/get_customer",
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
            
            // selArea        
            
            $(document).on('click', ".btnHapus",function(){                   
                var customer_id = $(this).val();
                
                $.ajax({
                    type: "POST",
                    data: {customer_id:customer_id},
                    url : "<?php echo base_url()?>admin/Customer/nonaktifkan",
                    success:function(data){  
                        var data = $.parseJSON(data);                      
                        if (data.status == 1){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: data.message,                                
                            }).then (function(){
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: data.message,
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }  
                    }
                });
            });

            $("#tambahCustomer").click(function(){
                reset();
            })

            $("#simpan").click(function(){                      
                customer_name    = $("#add_customer").val();
                customer_limit   = $('#add_limit').val().replace(/[^\d]/g,"");
                customer_hutang  = $('#add_hutang').val().replace(/[^\d]/g,"");
                customer_alamat  = $('#add_alamat').val();
                customer_telepon = $('#add_telepon').val();                
                $.ajax({
                    type: "POST",
                    data: {customer_name: customer_name,
                            customer_limit:customer_limit,
                            customer_hutang:customer_hutang,
                            customer_alamat:customer_alamat,
                            customer_telepon:customer_telepon,
                            customer_flagging: 1},
                    url: "<?php echo base_url()?>admin/Customer/tambah_customer", 
                    success:function(data){                        
                        var data = $.parseJSON(data);      
                        if (data.status == 1){
                            Swal.fire({
                                type:'success',
                                title: 'Sukses!',
                                text: data.message,                                
                            }).then (function(){
                                location.reload();
                            })
                        }else{
                            Swal.fire({
                                type:'error',
                                title: 'Oops...',
                                text: data.message,
                                footer: '<a href="https://google.com">Why do I have this issue?</a>'
                            },function(){
                                location.reload();
                            })
                        }                                        
                    }
                });
            })

            $("#add_area").keypress(function(e){                
                if(e.which==13){                    
                    $("#simpan").focus();
                }
            });
            $('.money').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            
            $('#mydata').DataTable();
        });
    </script>
    
    
</body>

</html>

