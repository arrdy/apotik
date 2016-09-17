<?php
	require_once "koneksi.php";
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; }
		
		if(!empty($_GET['kk']))
		{   $cari = " where kategori like '%".$_GET['kk']."%' "; } else { $cari=''; }

	$cari = mysqli_query($con, "select * from kategori $cari order by id_kategori desc limit $page,10") or die ('Gagal Pencarian...!!!');
?>

<input type="button"  class="btn btn-default" value="Tambah Kategori" onclick="tengah('formkategori');"> </br></br>

<table border="1" class="table table-bordered table-hover">
	<tr  bgcolor="skyblue">
		<td width="7%" align="center"><strong>No</strong></td>
		<td width="30%" align="center"><strong>Id Kategori</strong></td>
		<td width="50%" align="center"><strong> Kategori</strong></td>
		<td width="13%" align="center"><strong> PILIHAN</strong></td>
	</tr>
	<?php
		if(mysqli_num_rows($cari)==0)
		{ echo "
				<tr>
					<td colspan='4'> Data Kosong..!!!</td>
				</tr>"; }
		else{
			$no=1;
			while ($tampil = mysqli_fetch_assoc($cari))
			{ echo" <tr>
					<td align=center>".$no."</td>
					<td>".$tampil['id_kategori']."</td>
					<td>".$tampil['kategori']."</td>
					<td align=center>"; ?>
					<a href ='#'onclick="javascript:konfir_hapus('man/m_kategori.php','<?php echo $tampil['id_kategori']; ?>','tabelkategori','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/></a>
					<a href ='#'onclick="javascript:tengah('formkategori&id=<?php echo $tampil['id_kategori']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
										<?php echo "</td>
											</tr>";
					$no++;

			}

		}
	?>
</table>
   <center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from kategori $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('kategori','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>	
	