<?php
if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; }

if(!empty($_GET['kk']))
		{   $cari = " where o.nama_obat like '".$_GET['kk']."%' "; } else { $cari=''; }
?>

<input type="button"  class="btn btn-default" value="Tambah Obat" onclick="tengah('formobat');"> </br></br>
<table border="1" class="table table-bordered table-hover">
	<tr bgcolor="skyblue">
		<td width="30" align="center"><strong> No</strong></td>
		<td width="100" align="center"><strong>Kd Obat</strong></td>
		<td width="150" align="center"><strong>Kategori</strong></td>
		<td width="200" align="center"><strong>Satuan</strong></td>
		<td width="150" align="center"><strong>Jenis</strong></td>
		<td width="150" align="center"><strong>Nama Obat</strong></td>
		<td width="100" align="center"><strong>Harga</strong></td>
		<td width="100" align="center"><strong>PILIHAN</strong></td>
	</tr>

	<?php
	require_once "koneksi.php";
	$cari = mysqli_query($con, "select o.*,s.satuan,k.kategori from obat o
left join kategori k on k.id_kategori=o.id_kategori
left join satuan s on s.id_satuan=o.id_satuan $cari order by o.kd_obat desc limit $page,10") or die ('Gagal Pencarian...!!!');
	
		if(mysqli_num_rows($cari)==0)
		{ echo "<tr>
				<td colspan='8'>Data Kosong...!!!</td>
		</tr>";}
		else {
			$no=1;
			while ($tampil = mysqli_fetch_assoc($cari))
			{ echo "<tr>
						<td>".$no."</td>
						<td>".$tampil['kd_obat']."</td>
						<td>".$tampil['kategori']."</td>
						<td>".$tampil['satuan']."</td>
						<td>".$tampil['jenis']."</td>
						<td>".$tampil['nama_obat']."</td>
						<td>".number_format($tampil['harga'])."</td>
						<td align=center>"; ?>
						<a href ='#'onclick="javascript:konfir_hapus('man/m_obat.php','<?php echo $tampil['kd_obat']; ?>','tabelobat','<?php echo $hal; ?>');"><img src='icon/delete.png' width='20' height='20' align='center'/></a>
						<a href ='#'onclick="javascript:tengah('formobat&id=<?php echo $tampil['kd_obat']; ?>')"><img src='icon/edit.png' width='20' height='20' align='center'/>edit</a>
						<?php echo "</td>
						</tr>";
						$no++;

			}
		}
	?>
                         
  </table>
   <center> 	
                                <?php 
                        		        $jml = mysqli_query($con,'select ceil(count(*)/10) as jml from obat $cari '); 
		                                $j_hal= mysqli_fetch_assoc($jml); $jml_hal=$j_hal['jml']; 
		                            if($jml_hal > 1){     
												for ($i=0; $i < $jml_hal; $i++) {  
													?>  <a href="#" onclick="javascript:tengah('obat','','<?php echo $i; ?>')"><?php echo $i+1; ?></a> 
										<?php
							 					}
									}			
								?>	
								</center>

                         