<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		$cari='';
		if(!empty($_GET['t1']))
		{  	
			$t1 = $_GET['t1']; 
			$t2 = $_GET['t2'];
			$cari = "where p.tgl between '$t1' and '$t2' ";
		}

	?>

                                <table class="table table-bordered table-hover">
                                        <tr bgcolor="skyblue">
                                            <th width="5%" style="text-align : center;"><strong>NO</strong></th>
                                            <th width="10%" style="text-align : center;"><strong>Tgl Beli</strong></th>
											<th width="15%" style="text-align : center;"><strong>Kode Obat</strong></th>
											<th width="15%" style="text-align : center;"><strong>Nama Obat </strong></th>	
											<th width="15%" style="text-align : center;"><strong>Kategori </strong></th>									
											<th width="5%" style="text-align : center;"><strong>Jumlah Beli </strong></th>
											<th width="15%" style="text-align : center;"><strong>Total Biaya </strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "../koneksi.php"; 
									$exe = "
										select o.*,s.satuan,k.kategori,coalesce(bo.jml,0)as jml,p.tgl,bo.harga as harga_beli
from obat o
left join kategori k on k.id_kategori=o.id_kategori
left join satuan s on s.id_satuan=o.id_satuan
left join (select nota,kd_obat,sum(jumlah)as jml,harga from det_penjualan group by kd_obat,nota)bo on bo.kd_obat=o.kd_obat
inner join penjualan p on p.nota=bo.nota
";

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
												<td align=center>".$u['tgl']."</td>
												<td align=center>".substr($u['kd_obat'],0,50)."</td>
												<td align=center>".substr($u['nama_obat'],0,50)." Jenis</td>
												<td align=center>".$u['kategori']."</td>
												<td align=center>".$u['jml']." ".$u['satuan']."</td>
												<td align=center>Rp. ".number_format($u['harga_beli'])."</td>
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

<form name='lpengadaan' method="post" action='laporan/print_penjualan.php?cari=<?php echo $cari; ?>' target='_blank'>

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