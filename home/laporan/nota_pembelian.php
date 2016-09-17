
<?php


include "../fungsi/terbilang.php";		
if(!empty($_GET['id'])){ $id = $_GET['id']; }else{ $id = ''; }

$content ="
<div style='margin-left:100;'>  
	<strong> <font size='5'> DETAIL TRANSAKSI PEMBELIAN </font>  </strong>
</div> 
<hr>
<br><br>
<table border=0 width=100% align=left style='border:0px; margin-left:10;'>";					
									require_once "../koneksi.php"; 
									$cariagt = mysqli_query($con,"select dp.faktur,k.nama,p.tgl,o.nama_obat,s.satuan,g.kategori from det_pembelian dp
																	left join pembelian p on p.faktur=dp.faktur
																	left join  karyawan k on k.id_karyawan=p.id_karyawan
																	left join obat o on o.kd_obat=dp.kd_obat 
																	left join satuan s on s.id_satuan=o.id_satuan
																	left join kategori g on g.id_kategori=o.id_kategori
									where p.faktur='$id'
") or die('gagal pencarian data !'); 
										
											$u = mysqli_fetch_assoc($cariagt);
											 
											$content .="
											<tr  bgcolor='beige' class='satu' >
												<td align=left width=40%>No Transaksi </td>
												<td > : ".$u['faktur']."</td>
											</tr>
											<tr  bgcolor='beige' class='satu' >
												<td align=left width=30%>Tgl Pembelian </td>
												<td align=left>: ".$u['tgl']."</td>
											</tr>
											<tr  bgcolor='beige' class='satu' >
												<td align=left width=30%>Karyawan </td>
												<td align=left>: ".$u['nama']."</td>
											</tr>
											";
											
                                  $content .=  "</tbody>
</table><br>
<table border='0' width=100% align=left style='border:0px; margin-left:10;'>";
				$jml = 0;
				$harga = 0; 
				$n=0;

				 $content .= "
					<tr class='dua' >					
					<td align=center bgcolor='darkcyan' height='30'> <b>Barang</b> </td>
					<td align=center bgcolor='darkcyan'><b> Jumlah</b></td>
					<td align=center bgcolor='darkcyan'><b> Biaya</b></td>
					</tr>";

					if(!empty($_GET['id']))
					{	$edit_id = $_GET['id'];
					$cariju = mysqli_query($con,"select dp.*,k.nama,p.tgl,o.nama_obat,s.satuan,g.kategori from det_pembelian dp
left join pembelian p on p.faktur=dp.faktur
left join  karyawan k on k.id_karyawan=p.id_karyawan
left join obat o on o.kd_obat=dp.kd_obat 
left join satuan s on s.id_satuan=o.id_satuan
left join kategori g on g.id_kategori=o.id_kategori

									where p.faktur='$id' ") or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariju)>0)
										{	
										 $n=1;
											while($u = mysqli_fetch_assoc($cariju))
											{ 
 $content .= "
					<tr class='dua'>					
					<td bgcolor='beige' >"; $content .= $u['nama_obat']; $content .=" </td>
					<td align=center bgcolor='gainsboro' >"; $content .= number_format($u['jumlah']); $content .=" </td>
					<td align=right bgcolor='gainsboro' >"; $content .= number_format($u['harga']); $content .=" </td>
					</tr>";

					$jml = $jml+$u['jumlah'];
					$harga = $harga+$u['harga'];
					$n++;
											}

										}
					}
					 $content .= "
					<tr class='dua'>					
					<td  > </td>
					<td align=center bgcolor='powderblue'><b>"; $content .= $jml; $content .=" </b></td>
					<td align=center bgcolor='powderblue'><b>"; $content .= number_format($harga); $content .=" </b></td>
					</tr>";

$content .= "</table> ";

	$tglnow = date('Y - m - d');
	// Define relative path from this script to mPDF
	$nama_dokumen='lap_buku'; //Beri nama file PDF hasil.
	define('_MPDF_PATH','../fungsi/MPDF60/');
	include(_MPDF_PATH . "mpdf.php");
	$mpdf=new mPDF('c', 'A5'); // Create new mPDF Document
	//Beginning Buffer to save PHP variables and HTML tags
	ob_start(); 
		echo $content;
	$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
	ob_end_clean();
	//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;

?>