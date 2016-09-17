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
                                            <th width="10%" style="text-align : center;"><strong>ID</strong></th>
											<th width="10%" style="text-align : center;"><strong>Tanggal Beli</strong></th>
											<th width="15%" style="text-align : center;"><strong>Supplier</strong></th>
											<th width="15%" style="text-align : center;"><strong>Jumlah Jenis </strong></th>							
											<th width="5%" style="text-align : center;"><strong>Jumlah Barang </strong></th>
											<th width="15%" style="text-align : center;"><strong>Sudah Dibayar </strong></th>
											<th width="15%" style="text-align : center;"><strong>Total Bayar </strong></th>
											<th width="15%" style="text-align : center;"><strong>Status</strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "../koneksi.php"; 
									$exe = "
										select p.*,k.nama,tot.jml_jenis,tot.qty,coalesce(tot.jml,0)as biaya,coalesce(bayar.bayar,0) as terbayar,s.nama as sup,
case when (coalesce(tot.jml,0)<=coalesce(bayar.bayar,0)) then 'Lunas' else 'Belum lunas' end as status
from pembelian p
										left join karyawan k on k.id_karyawan=p.id_karyawan
										left join suplier s on s.id_suplier=p.id_suplier
										left join (select faktur,count(*) as jml_jenis,sum(jumlah)as qty, sum(harga) as jml from det_pembelian group by faktur)tot on tot.faktur=p.faktur
left join (select faktur, sum(jumlah) as bayar from pembayaran group by faktur)bayar on bayar.faktur=p.faktur $cari order by faktur desc limit $page,10";

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
												<td align=center>".$u['faktur']."</td>
												<td align=center>".substr($u['tgl'],0,50)."</td>
												<td align=center>".substr($u['sup'],0,50)."</td>
												<td align=center>".substr($u['jml_jenis'],0,50)." Jenis</td>
												<td align=center>".$u['qty']."</td>
												<td align=center>Rp. ".number_format($u['biaya'])."</td>
												<td align=center>Rp. ".number_format($u['biaya'])."</td>
												<td align=center>".$u['status']."</td>
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

<form name='lpengadaan' method="post" action='laporan/print_pembayaran.php?status=<?php echo $status; ?>' target='_blank'>

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