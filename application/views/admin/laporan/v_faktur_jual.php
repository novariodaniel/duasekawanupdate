

<?php
            $b = $data->row_array();
            // print_r($b);
            $a = $sum_qty->row_array();
            $c = $cust_info->row_array();
            $cust = "";
            $alamat = "";
            $jual_garansi = 0;
            if ($b['jual_garansi'] != ""){
                $jual_garansi = $b['jual_garansi'];
            }
            if (count($c) != 0){
                $cust = $c['customer_name'];
                $alamat = $c['customer_alamat'];
            }else{
                $alamat = $b['jual_alamat'];
                if ($b["jual_customer"] == "ssNONAMEee") {
                    $cust = "";
                }else{
                    $cust = $b["jual_customer"];                
                }            
            }
            $this->session->set_userdata('pdf_nofak',$b['jual_nofak']);
            $tgl = explode(" ",$b['jual_tanggal']);            
        // print_r($a);print_r($b);die();
        ?>

<html style="margin-top:0px; margin-bottom:0px;"lang="en">
    <head>
        <title>Faktur Penjualan Barang</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
    </head>
    <body>

            <table border="0" align="center" style="width:700px;border:none; margin-top: none; padding-left:35px; padding-top: 0px;">
                <tr>
                    <th style="text-align:left; font-size: 18px;">CV. DUA SEKAWAN ACCU</th>
                </tr>
                <tr>
                    <th style="text-align:left; font-size:12px;">Jl. Raya Jakarta KM. 04 Terminal Pakupatan Serang-Banten</th>
                </tr>
                <tr>
                    <th style="text-align:left;font-size:12px;">Telp. 0254-284405, 0813 8178 9004, 0819 1110 5282</th>
                </tr>
            </table>

            <table border="0" align="center" style="padding-left:35px; font-size: 16px; border-width:1px; width:700px; border-top: 0px; border-left: 8px; border-right: 8px;">
                <tr>
                    <th style="text-align:right;">GARANSI <?php echo $jual_garansi;?> BULAN</th>
                </tr>
            </table>

            <table border="0" align="center" style="padding-left:35px; margin-top:0px;margin-bottom: 0px;font-size: 20px; border-width: 1px; width:700px; border-top: 8px; border-left: 0px; border-right: 8px;">
                <tr>
                    <th style="text-align:left;">FAKTUR</th>
                </tr>
            </table>
            <table border="0" align="center" style="margin-top:0px; padding-left:35px; width:700px;border:none; margin-bottom: 5px; font-size: 14px;">
                <tr>
                    <th style="text-align:left;">No Faktur</th>
                    <th style="text-align:left;">: <?php echo $b['jual_nofak']; ?></th>
                    <th style="text-align:left;">Nama Customer</th>
                    <th style="text-align:left;"> : <?php echo "$cust"; ?></th>
                </tr>
                <tr>  
                    <th style="text-align:left;">Tanggal</th>                    
                    <th style="text-align:left;">: <?php echo $tgl[0] ?></th>
                    <th style="text-align:left;">Alamat</th>
                    <th style="text-align:left;">: <?php echo $alamat; ?></th>
                </tr>            
            </table>

            <table border="0" style= "border-collapse:collapse; padding-left:35px; border-bottom: none; width:700px; font-size:14px;">
                <thead style="border: 1px solid black;">
                    <tr>
                        <th style="border: 1.5px solid black; width:10px;">No</th>
                        <th style="border: 1.5px solid black;">Nama Barang</th>
                        <th style="border: 1.5px solid black;">Qty</th>
                        <th style="border: 1.5px solid black;">Satuan</th>
                        <th style="border: 1.5px solid black;">Harga Jual</th>                        
                        <th style="border: 1.5px solid black;">Diskon(%)</th>
                        <th style="border: 1.5px solid black;">SubTotal</th>
                    </tr> 
                </thead>
                <tbody style= "border:1.5px solid black;">
                    <?php
                        $no = 0;
                        foreach ($data->result_array() as $i) {
                            $no++;

                            $nabar = $i['d_jual_barang_nama'];
                            $satuan = $i['d_jual_barang_satuan'];
                            $harjul = $i['d_jual_barang_harjul'];
                            $qty = $i['d_jual_qty'];
                            $diskon_ = $i['d_jual_disc_val'];
                            $diskon = $i['d_jual_diskon'];
                            $total = $i['d_jual_total'];
                    ?>
                        <tr style= "border:1.5px solid black;">
                            <td style="border:1.5px solid black; text-align:center;width:10px;"><?php echo $no; ?></td>
                            <td style="border:1.5px solid black; text-align:left; width:200px;"><?php echo $nabar; ?></td>
                            <td style="border:1.5px solid black; text-align:center; width:80px;"><?php echo $qty; ?></td>
                            <td style="border:1.5px solid black; text-align:center; width:55px;"><?php echo $satuan; ?></td>
                            <td style="border:1.5px solid black; text-align:right; width:90px;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                            <td style="border:1.5px solid black; text-align:right; width:auto;"><?php echo $diskon; ?></td>
                            <td style="border:1.5px solid black; text-align:right; width:auto;"><?php echo 'Rp ' . number_format($total); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>      
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: left; width:97px;">Total(<?php echo $a['sumQty'] ?>)</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_total']); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Customer</th>
                        <th colspan="2">Serang, <?php echo date('d-M-Y') ?></th>
                        <!-- <th></th> -->
                        <th></th>
                        <th style="text-align: left;">Cashback</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_cashback']); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: left;">Aki Bekas</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_aki_bekas']); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: left;">Garansi</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo number_format($b['jual_garansi'])." bln"; ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>(<?php echo $cust;?>)</th>
                        <th colspan="2">(<?php echo $this->session->userdata('nama'); ?>)</th>
                        <!-- <th></th> -->
                        <th></th>
                        <th style="text-align: left;">Total Belanja</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_belanja']); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: left;">Bayar Tunai</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_jml_uang']); ?></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="text-align: left;">Kembalian</th>
                        <th style="border:1.5px solid black;text-align: right;"><?php echo 'Rp ' . number_format($b['jual_kembalian']); ?></th>
                    </tr>
                </tfoot>      
            </table>

            <!--  -->

            <!-- <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px; font-size:14px;">
                <tr>
                    <td align="center">Customer</td>
                    <td align="right">Serang, <?php echo date('d-M-Y') ?></td>
                </tr>
                <tr>
                    <td align="right"></td>
                </tr>

                <tr>
                    <td><br /><br /></td>
                </tr>
                <tr>
                    <td align="center">(<?php echo $cust;?>)</td>
                    <td align="right">( <?php echo $this->session->userdata('nama'); ?> )</td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
            </table> -->

            <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <th><br /><br /></th>
                </tr>
                <tr>
                    <th align="left"></th>
                </tr>
            </table>
    </body>
</html>