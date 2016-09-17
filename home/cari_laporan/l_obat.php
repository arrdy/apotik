<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		$status = '3';
		$cari='';
		if(!empty($_GET['status']))
		{  	$status = $_GET['status'];

		if($status=='2')
			 $cari = ' where (coalesce(tot.jml,0)<=coalesce(bayar.bayar,0))'; 
		if($status=='1')
			 $cari = ' where (coalesce(tot.jml,0)>coalesce(bayar.bayar,0))';
		}


	?>

                                <table class="table table-bordered table-hover">
                                        <tr bgcolor="skyblue">
                                            <th width="5%" style="text-align : center;"><strong>NO</strong></th>
                                            <th width="10%" style="text-align : center;"><strong>Kode Obat</strong></th>
											<th width="15%" style="text-align : center;"><strong>Nama Obat</strong></th>
											<th width="15%" style="text-align : center;"><strong>Kategori</strong></th>									
											<th width="15%" style="text-align : center;"><strong>Harga Obat </strong></th>
											<th width="15%" style="text-align : center;"><strong>Kadaluarsa </strong></th>
											<th width="15%" style="text-align : center;"><strong>Jangka kadaluarsa</strong></th>
											<th width="15%" style="text-align : center;"><strong>Stok obat</strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "koneksi.php"; 
									$exe = "
select o.*,s.satuan,k.kategori,bo.ex,coalesce(bo.jml,0)-coalesce(jo.jml,0) as sisa_obat ,
datediff(bo.ex,now()) as jangka
from obat o
left join kategori k on k.id_kategori=o.id_kategori
left join satuan s on s.id_satuan=o.id_satuan
left join (select kd_obat,sum(jumlah)as jml,max(tgl_kadaluarsa)as ex from det_pembelian group by kd_obat)bo on bo.kd_obat=o.kd_obat
left join (select kd_obat,sum(jumlah)as jml from det_penjualan group by kd_obat)jo on jo.kd_obat=o.kd_obat
where coalesce(bo.jml,0)-coalesce(jo.jml,0) > 0 ";

									$cariagt = mysqli_query($con,$exe) or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariagt)<=0)
										{
											echo "
											<tr>
                                            <td align='center' colspan='8'>Data kosong..</td>
											</tr>
											";
										}
										else{ $n=1;
											while($u = mysqli_fetch_assoc($cariagt))
											{  
											echo"
											<tr>
												<td align=center>".($n)."</td>
												<td align=center>".$u['kd_obat']."</td>
												<td align=center>".substr($u['nama_obat'],0,50)."</td>
												<td align=center>".substr($u['kategori'],0,50)."</td>
												<td align=center>Rp. ".number_format($u['harga'])."</td>
												<td align=center>".$u['ex']."</td>
												<td align=center>".$u['jangka']." Hari</td>
												<td align=center>".$u['sisa_obat']." ".$u['satuan']."</td>
											</tr>";
											$n++;
											}
										}
									?>	
                                    </tbody>
                                </table><br><br><br>

                     		 <center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from penjualan $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('tabelpenjualan','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>

<form name='lpengadaan' method="post" action='laporan/print_obat.php' target='_blank'>

					<table border='0' style="margin-left:10;">
						<tr style="border:0px;">
							<td style="border:0px;">Format Laporan</td>
							<td style="border:0px;"> :</td>
							<td style="border:0px;">
								<img src = 'icon/word.gif'><input type='radio' name='format' value='1' class='input'>Microsoft Word
								<br>
								<img src = 'icon/excel.gif'><input type='radio' name='format' value='2' class='input'>Microsoft Excel
								<br>
								<img src = 'icon/pdf.png'><input type='radio' name='format' value='3' class='input' checked>PDF
								
							</td>
						</tr>
						<tr style="border:0px;">
							<td style="border:0px;"></td>
							<td style="border:0px;"></td>
							<td style="border:0px;"><br><input class="btn btn-outline btn-success" type='submit' value='View Data' class='button'></td>
						</tr>
						
					</table>

</form>