	<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		if(!empty($_GET['kk']))
		{   $cari = " where nama like '".$_GET['kk']."%' "; } else { $cari=''; }

	?>
							<button style="margin-left:25px;" class="btn btn-default">
                               <a href="#" style="text-decoration: none;" onclick="tengah('formpenjualan');" >Tambah Penjualan </a>
                            </button> </br>	</br>		
                                <table class="table table-bordered table-hover">
                                        <tr bgcolor="skyblue">
                                            <th width="5%" style="text-align : center;"><strong>NO</strong></th>
                                            <th width="10%" style="text-align : center;"><strong>Nota</strong></th>
											<th width="10%" style="text-align : center;"><strong>Tanggal</strong></th>
											<th width="15%" style="text-align : center;"><strong>Karyawan</strong></th>
											<th width="15%" style="text-align : center;"><strong>Jumlah Jenis </strong></th>										
											<th width="15%" style="text-align : center;"><strong>Jumlah Barang </strong></th>
											<th width="15%" style="text-align : center;"><strong>Total Bayar </strong></th>
											<th width="10%" style="text-align : center;"><strong>Pilihan</strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "koneksi.php"; 
									$cariagt = mysqli_query($con,"
										select p.*,k.nama,tot.jml_jenis,tot.qty,tot.jml from penjualan p
										left join karyawan k on k.id_karyawan=p.id_karyawan
										left join (select nota,count(*) as jml_jenis,sum(jumlah)as qty, sum(harga) as jml from det_penjualan group by nota)tot on tot.nota=p.nota
										order by nota desc limit $page,10") or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariagt)<=0)
										{
											echo "
											<tr>
                                            <td align='center' colspan='7'>Data kosong..</td>
											</tr>
											";
										}
										else{ $n=1;
											while($u = mysqli_fetch_assoc($cariagt))
											{  
											echo"
											<tr>
												<td align=center>".($n+$hal)."</td>
												<td align=center>".$u['nota']."</td>
												<td align=center>".substr($u['tgl'],0,50)."</td>
												<td align=center>".substr($u['nama'],0,50)."</td>
												<td align=center>".substr($u['jml_jenis'],0,50)." Jenis</td>
												<td align=center>".$u['qty']."</td>
												<td align=center>Rp. ".number_format($u['jml'])."</td>
												<td align=center>"; ?>
														<a href ='laporan/nota_penjualan.php?id=<?php echo $u['nota']; ?>' target="_blank"><img src='icon/nota.ico' width='20' height='20' align='center'/>Nota</a>
										<?php echo "</td>
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