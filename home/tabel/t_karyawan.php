<?php
	require_once "koneksi.php";
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; }

		if(!empty($_GET['kk']))
		{   $cari = " where nama like '".$_GET['kk']."%' "; } else { $cari=''; }

	
?>


<input type="button"  class="btn btn-default" value="Tambah Karyawan" onclick="tengah('formkaryawan');"> </br></br>
<table border="1" class="table table-bordered table-hover">
	<tr  bgcolor="skyblue">
		<td width="30" align="center"><strong>No</strong></td>
		<td width="100" align="center"><strong>Id Karyawan</strong></td>
		<td width="200" align="center"><strong>Nama</strong></td>
		<td width="150" align="center"><strong>Username</strong></td>
		<td width="150" align="center"><strong>password</strong></td>
		<td width="100" align="center"><strong>PILIHAN</strong></td>
	</tr>

	<?php
	$cari = mysqli_query($con, "select * from karyawan $cari order by id_karyawan desc limit $page,10") or die ('Gagal Pencarian...!!!');
	
		if(mysqli_num_rows($cari)==0)
		{ echo "<tr>
				<td colspan='6'>Data Kosong...!!!</td>
		</tr>";}
		else {
			$no=1;
			while ($tampil = mysqli_fetch_assoc($cari))
			{ echo "<tr>
						<td align=center>".$no."</td>
						<td>".$tampil['id_karyawan']."</td>
						<td>".$tampil['nama']."</td>
						<td>".$tampil['username']."</td>
						<td>".$tampil['password']."</td>
						<td align=center>"; ?>
						<a href ='#'onclick="javascript:konfir_hapus('man/m_karyawan.php','<?php echo $tampil['id_karyawan']; ?>','tabelkaryawan','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/></a>
						<a href ='#'onclick="javascript:tengah('formkaryawan&id=<?php echo $tampil['id_karyawan']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
						<?php echo "</td>
						</tr>";
						$no++;

			}
		}
	?>
</table>
<center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from karyawan $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('karyawan','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
		</center>	