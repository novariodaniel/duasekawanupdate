
   

					<?php 
						error_reporting(0);
						$b=$brg->row_array();
					?>
					<table>
						<tr>
		                    <th style="width:200px;"></th>
		                    <th>Nama Barang</th>
		                    <th>Satuan</th>
		                    <th>Stok</th>
		                    <th>Harga(Rp)</th>
		                    <th>Diskon(%)</th>
		                    <th>Jumlah</th>
		                </tr>
						<tr>
							<td style="width:200px;"></td>
							<td><input type="text" name="nabar" value="<?php echo $b['barang_nama'];?>" style="width:380px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="satuan" value="<?php echo $b['barang_satuan'];?>" style="width:120px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="stok" value="<?php echo $b['barang_stok'];?>" style="width:40px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="harjul" value="<?php echo number_format($b['barang_harjul']);?>" style="width:120px;margin-right:5px;text-align:right;" class="form-control input-sm" readonly></td>
							<!-- <td><input type="text" name="diskon" id="diskon" value="0" min="0" class="form-control input-sm" style="width:130px;margin-right:5px;" required></td> -->
							<td>
								<select name="diskon" class="form-control" data-live-search="true" title="Pilih Diskon" data-width="100%" required>
									<?php 
										$diskon_1 = $b['diskon_1'];
										$diskon_2 = $b['diskon_2'];
										$diskon_3 = $b['diskon_3'];
										if ($b['diskon_1']==""){
											$diskon_1=0;	
										}
										if ($b['diskon_2']==""){
											$diskon_2=0;	
										}
										if ($b['diskon_3']==""){
											$diskon_3=0;
										} 																																																							
											echo "<option value='$diskon_1'>Diskon Konsumen - $diskon_1%</option>";
											echo "<option value='$diskon_2'>Diskon Toko - $diskon_2%</option>";
											echo "<option value='$diskon_3'>Diskon Tempo - $diskon_3%</option>";
									?>
                    			</select>
							</td>
		                    <td><input type="number" name="qty" id="qty" value="0" min="1" max="<?php echo $b['barang_stok'];?>" class="form-control input-sm" style="width:90px;margin-right:5px;" required></td>
		                    <td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table>
					

	<!-- Bootstrap Core JavaScript -->
	
    				
