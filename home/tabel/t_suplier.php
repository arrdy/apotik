<?php 
	require_once "koneksi.php";
	if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; }
	
	if(!empty($_GET['kk']))
	{   $cari = " where nama like '".$_GET['kk']."%' "; } else { $cari=''; }
	$cari = mysqli_query($con,"select * from suplier $cari order by id_suplier desc limit $page,10") or die ('Pencarian Gagal...!!!');
 ?>

<input  class="btn btn-default" type="button" value="Tambah Suplier" onclick="tengah('formsuplier');"> </br></br>
<table border="1" class="table table-bordered table-hover">
	<tr  bgcolor="skyblue">
		<td width="5%" align="center"><strong>No</strong></td>
		<td width="10%" align="center"><strong>Id Suplier</strong></td>
		<td width="10%" align="center"><strong>Nama</strong></td>
		<td width="20%" align="center"><strong>Alamat</strong></td>
		<td width="30%" align="center"><strong>No HP</strong></td>
		<td width="15%" align="center"><strong>PILIHAN</strong></td>
	</tr>
	<?php
		if(mysqli_num_rows($cari)==0)
			{echo"<tr>
						<td colspan='6'>data Kosong....!!!</td>
				  </tr>";}
	else{ 
		$no=1;
		while($tampil = mysqli_fetch_assoc($cari))
		{echo"<tr>
					<td>".$no."</td>
					<td>".$tampil['id_suplier']."</td>
					<td>".$tampil['nama']."</td>
					<td>".$tampil['alamat']."</td>
					<td>".$tampil['no_hp']."</td>
					<td align=center>"; ?>
					<a href ='#'onclick="javascript:konfir_hapus('man/m_suplier.php','<?php echo $tampil['id_suplier']; ?>','tabelsuplier','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/>HAPUS</a>
					<a href ='#'onclick="javascript:tengah('formsuplier&id=<?php echo $tampil['id_suplier']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
										<?php echo "</td>
											</tr>";
					$no++;

		}
	}
	?>
</table>
 <center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from suplier $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('suplier','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>