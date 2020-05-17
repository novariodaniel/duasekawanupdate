

<?php
            $b = $data->row_array();
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
                    <th style="text-align:left;">: <?php echo $b['jual_tanggal']; ?></th>
                    <th style="text-align:left;">Alamat</th>
                    <th style="text-align:left;">: <?php echo $alamat; ?></th>
                </tr>            
            </table>

            <table border="1" style= "border:2px solid black; border-collapse:collapse; padding-left:35px; border-bottom: none; width:700px; font-size:14px;">
                <thead>
                    <tr>
                        <th style="width:10px;">No</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Qty</th>
                        <th>Diskon</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody style= "border:2px solid black;">
                    <?php
                        $no = 0;
                        foreach ($data->result_array() as $i) {
                            $no++;

                            $nabar = $i['d_jual_barang_nama'];
                            $satuan = $i['d_jual_barang_satuan'];
                            $harjul = $i['d_jual_barang_harjul'];
                            $qty = $i['d_jual_qty'];
                            $diskon = $i['d_jual_disc_val'];
                            $total = $i['d_jual_total'];
                    ?>
                        <tr>
                            <td style="text-align:center;width:10px;"><?php echo $no; ?></td>
                            <td style="text-align:left; width:260px;"><?php echo $nabar; ?></td>
                            <td style="text-align:center; width:25px;"><?php echo $satuan; ?></td>
                            <td style="text-align:right; width:90px;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                            <td style="text-align:center; width:30px;"><?php echo $qty; ?></td>
                            <td style="text-align:right; width:auto;"><?php echo 'Rp ' . number_format($diskon); ?></td>
                            <td style="text-align:right; width:auto;"><?php echo 'Rp ' . number_format($total); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>            
            </table>

            <table border="0" align="center" style= "border-bottom: none; width:700px; font-size: 14px;">
                <thead>
                    <tr>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px;text-align: left;">Total (<?php echo $a['sumQty'] ?>)</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_total']); ?></th>
                    </tr>
                    <tr>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px; text-align: left;">Cashback</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_cashback']); ?></th>
                    </tr>
                    <tr>
                        <th style="width:10px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px; text-align: left;">Potong Aki Bekas</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_aki_bekas']); ?></th>
                    </tr>
                    <tr>
                        <th style="width:10px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px; text-align: left;">Total Belanja</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_belanja']); ?></th>
                    </tr>
                    <tr>
                        <th style="width:10px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px; text-align: left;">Bayar Tunai</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_jml_uang']); ?></th>
                    </tr>
                    <tr>
                        <th style="width:10px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:80px;">&nbsp;</th>
                        <th style="width:50px;">&nbsp;</th>
                        <th style="width:170px; text-align: left;">Kembalian</th>
                        <th style="text-align:right;"><?php echo 'Rp ' . number_format($b['jual_kembalian']); ?></th>
                    </tr>
                </thead>                          
            </table>

            <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px; font-size:14px;">
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
            </table>

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