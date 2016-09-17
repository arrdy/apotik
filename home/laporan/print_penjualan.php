<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		$status = '3';
		$cari='';
		if(!empty($_GET['cari']))
		{  	$status = $_GET['cari'];
		}


$content = "
<div style='margin-left:15;'>  
	<strong> <font size='5'> LAPORAN PENJUALAN OBAT </font>  </strong> <br>
	Tanggal Cetak : ".date('Y - m - d')." <br>
	<br>
</div>
                                <table class=table table-bordered table-hover>
                                        <tr bgcolor=skyblue>
                                            <th width=5% style=text-align : center;><strong>NO</strong></th>
                                            <th width=10% style=text-align : center;><strong>Tgl Beli</strong></th>
											<th width=15% style=text-align : center;><strong>Kode Obat</strong></th>
											<th width=15% style=text-align : center;><strong>Nama Obat </strong></th>	
											<th width=15% style=text-align : center;><strong>Kategori </strong></th>									
											<th width=5% style=text-align : center;><strong>Jumlah Beli </strong></th>
											<th width=15% style=text-align : center;><strong>Biaya beli </strong></th>
                                        </tr>
                                    <tbody> ";

									require_once "../koneksi.php"; 

									$exe = "
										select o.*,s.satuan,k.kategori,coalesce(bo.jml,0)as jml,p.tgl,bo.harga as harga_beli
from obat o
left join kategori k on k.id_kategori=o.id_kategori
left join satuan s on s.id_satuan=o.id_satuan
left join (select nota,kd_obat,sum(jumlah)as jml,harga from det_penjualan group by kd_obat,nota)bo on bo.kd_obat=o.kd_obat
inner join penjualan p on p.nota=bo.nota $cari";

									$cariagt = mysqli_query($con,$exe) or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariagt)<=0)
										{
											$content .= "
											<tr>
                                            <td align='center' colspan='8'>Data kosong..</td>
											</tr>
											";
										}
										else{ $n=1; $tot=0;
											while($u = mysqli_fetch_assoc($cariagt))
											{  
											$content .="
											<tr bgcolor=beige>
												<td align=center>".($n)."</td>
												<td align=center>".$u['tgl']."</td>
												<td align=center>".substr($u['kd_obat'],0,50)."</td>
												<td align=center>".substr($u['nama_obat'],0,50)." Jenis</td>
												<td align=center>".$u['kategori']."</td>
												<td align=center>".$u['jml']." ".$u['satuan']."</td>
												<td align=center>Rp. ".number_format($u['harga_beli'])."</td>
											</tr>"; $tot = $tot+$u['harga_beli'];
											$n++;
											}
											$content .="
											<tr>
												<td align=center colspan=6></td>
												<td bgcolor=bisque align=center><h3>Rp. ".number_format($tot)."</h3></td>
											</tr>";
										}
									$content .= "
                                    </tbody>
                                </table>";
	
	$tglnow = date('Y - m - d');

	if($_POST['format']=='1') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pembelian_$tglnow.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='2') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pembelian_$tglnow.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='3') {
	// Define relative path from this script to mPDF
	$nama_dokumen='lap_buku'; //Beri nama file PDF hasil.
	define('_MPDF_PATH','../fungsi/MPDF60/');
	include(_MPDF_PATH . "mpdf.php");
	$mpdf=new mPDF('c', 'A4-L'); // Create new mPDF Document
	//Beginning Buffer to save PHP variables and HTML tags
	ob_start(); 
		echo $content;
	$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
	ob_end_clean();
	//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
	$mpdf->WriteHTML(utf8_encode($html));
	$mpdf->Output($nama_dokumen.".pdf" ,'I');
	exit;

	}
?>