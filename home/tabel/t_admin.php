	<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		if(!empty($_GET['kk']))
		{   $cari = " where nama like '".$_GET['kk']."%' "; } else { $cari=''; }

	?>
							<button style="margin-left:25px;" class="btn btn-default">
                               <a href="#" style="text-decoration: none;" onclick="tengah('formadmin');" >Tambah admin </a>
                            </button> </br>	</br>		
                                <table class="table table-bordered table-hover">
                                        <tr bgcolor="skyblue">
                                            <th width="5%" style="text-align : center;"><strong>NO</strong></th>
                                            <th width="10%" style="text-align : center;"><strong>ID Admin</strong></th>
											<th width="20%" style="text-align : center;"><strong>Nama Admin</strong></th>
											<th width="15%" style="text-align : center;"><strong>Username</strong></th>
											<th width="15%" style="text-align : center;"><strong>Password</strong></th>
											<th width="8%" style="text-align : center;"><strong>Pilihan</strong></th>
                                        </tr>
                                    <tbody>
									<?php 	
									require_once "koneksi.php"; 
									$cariagt = mysqli_query($con,"select * from admin $cari order by id_admin desc limit $page,10") or die('gagal pencarian data !'); 
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
												<td align=center>".$u['id_admin']."</td>
												<td align=center>".substr($u['nama'],0,50)."</td>
												<td align=center>".substr($u['username'],0,50)."</td>
												<td align=center>".substr($u['password'],0,50)."</td>
												<td align=center>"; ?>
														<a href ='#'onclick="javascript:konfir_hapus('man/m_admin.php','<?php echo $u['id_admin']; ?>','tabeladmin','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/></a>
														<a href ='#'onclick="javascript:tengah('formadmin&id=<?php echo $u['id_admin']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
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
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from admin $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('admin','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>