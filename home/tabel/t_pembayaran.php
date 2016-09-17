	<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		if(!empty($_GET['kk']))
		{   $cari = " where nama like '".$_GET['kk']."%' "; } else { $cari=''; }

	?>
							<button style="margin-left:25px;" class="btn btn-default">
                               <a href="#" style="text-decoration: none;" onclick="tengah('formpembayaran');" >Tambah Pembayaran </a>
                            </button> </br>	</br>		
                                <table class="table table-bordered table-hover">
                                        <tr bgcolor="skyblue">
                                            <th width="5%" style="text-align : center;"><strong>NO</strong></th>
                                            <th width="10%" style="text-align : center;"><strong>ID</strong></th>
											<th width="20%" style="text-align : center;"><strong>Faktur</strong></th>
											<th width="10%" style="text-align : center;"><strong>Tgl Bayar</strong></th>							
											<th width="15%" style="text-align : center;"><strong>Jumlah Bayar </strong></th>
											<th width="15%" style="text-align : center;"><strong>Pilihan</strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "koneksi.php"; 
									$cariagt = mysqli_query($con,"  select *,r.tgl as tgl_bayar from pembayaran r
																	left join pembelian p on r.faktur=p.faktur
																	left join suplier s on s.id_suplier=p.id_suplier
																	order by id_pembayaran desc $cari limit $page,10") or die('gagal pencarian data !'); 
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
												<td align=center>".($n+$hal)."</td>
												<td align=center>".$u['id_pembayaran']."</td>
												<td align=left>".substr($u['faktur'],0,50)." ( ".substr($u['nama'],0,50)." )</td>
												<td align=center>".substr($u['tgl_bayar'],0,50)."</td>
												<td align=center>Rp. ".number_format($u['jumlah'])."</td>
												<td align=center>"; ?>
														<a href ='#' onclick="javascript:tengah('formpembayaran&id=<?php echo $u['id_pembayaran']; ?>')" ><img src='icon/edit.png' width='20' height='20' align='center'/>Ubah</a>
														<a href ='#'onclick="javascript:konfir_hapus('man/m_pembayaran.php','<?php echo $u['id_pembayaran']; ?>','tabelpembayaran','');"><img src='icon/remove.png' width='20' height='20' align='center'/>Hapus</a>
														<a href ='laporan/nota_pembelian.php?id=<?php echo $u['faktur']; ?>' target="_blank"><img src='icon/nota.ico' width='20' height='20' align='center'/>Detail</a>
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