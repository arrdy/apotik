<?php
	require_once "koneksi.php";
	if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; }

		if(!empty($_GET['kk']))
		{   $cari = " where satuan like '".$_GET['kk']."%' "; } else { $cari=''; }

	
	$cari = mysqli_query($con, "select * from satuan $cari order by id_satuan desc limit $page,10") or die ('Gagal Pencarian...!!!');

?>
<input type="button"  class="btn btn-default" value="Tambah Satuan" onclick="tengah('formsatuan');"> </br></br>
<table border="1" class="table table-bordered table-hover">
	<tr  bgcolor="skyblue">
		<td width="5%" align="center"><strong>No</strong></td>
		<td width="30%" align="center"><strong>Id Satuan</strong></td>
		<td width="40%" align="center"><strong>Satuan</strong></td>
		<td width="13%" align="center"><strong>Pilihan</strong></td>
	</tr>
	<?php
	if (mysqli_num_rows($cari)==0)
		{ echo "<tr>
				<td colspan='5'>Data Kosong...!!!</td>
		</tr>"; }
		else{
			$no=1;
			while ($tampil = mysqli_fetch_assoc($cari))
			{ echo"<tr>
						<td align=center>".$no."</td>
						<td>".$tampil['id_satuan']."</td>
						<td>".$tampil['satuan']."</td>
						<td align=center>"; ?>
					<a href ='#'onclick="javascript:konfir_hapus('man/m_satuan.php','<?php echo $tampil['id_satuan']; ?>','tabelsatuan','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/> HAPUS</a>
					<a href ='#'onclick="javascript:tengah('formsatuan&id=<?php echo $tampil['id_satuan']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
										<?php echo "</td>
											</tr>";
					$no++;
			}
		}
	?>
</table>
  <center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from satuan $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('satuan','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>	
