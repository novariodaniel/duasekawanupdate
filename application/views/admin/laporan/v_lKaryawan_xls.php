<?php 

$title = "laporan_karyawan".date('d-m-Y');;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$title.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<b><h4>Laporan Karyawan <?php echo date('M-Y');?></h4></b>
<table width="100%">
    <thead>
        <tr style='font-weight:bold;'>
            <th>No.</th>

            <th>ID</th>

            <th>Nama</th>

            <th>Tempat Lahir</th>

            <th>Tgl Lahir</th>                        
            
            <th>Alamat</th> 
            
            <th>Status</th>
            
            <th>Jenis Kelamin</th>                                    
        </tr>
    </thead>
    <tbody>
        <?php $i=1; foreach($data->result_array() as $list) { 
            $marrital = "";
            $gender = "";
            switch ($list['karyawan_marrital']) {
                case '1':
                    $marrital = 'Kawin';
                    break;
                
                default:
                    $marrital = 'Belum Kawin';
                    break;
            }

            switch ($list['karyawan_gender']) {
                case '1':
                    $gender = 'Laki-laki';
                    break;
                
                default:
                    $gender = 'Perempuan';
                    break;
            }
        ?>            
        <tr>
            <td align='center'><?php echo $i;?></td>

            <td><?php echo $list['karyawan_id'];?></td>

            <td><?php echo $list['karyawan_nama'];?></td>

            <td><?php echo $list['karyawan_tempatlahir'];?></td>

            <td><?php echo $list['karyawan_tgllahir'];?></td>

            <td><?php echo $list['karyawan_domisili'];?></td>

            <td><?php echo $marrital;?></td>

            <td><?php echo $gender;?></td>            

        </tr>

        <?php $i++; } ?>
    </tbody>
</table>

<?php redirect('admin/Laporan','refresh'); ?>