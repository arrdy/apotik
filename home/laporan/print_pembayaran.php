<?php 
		if(!empty($_GET['page'])){ $page=$_GET['page']*10; }else{ $page=0; } 

		$status = '3';
		$cari='';
		if(!empty($_GET['status']))
		{  	$status = $_GET['status'];

		if($status=='2')
			 $cari = ' where (coalesce(tot.jml,0)<=coalesce(bayar.bayar,0))'; 
		if($status=='1')
			 $cari = ' where (coalesce(tot.jml,0)>coalesce(bayar.bayar,0))';
		}


$content = "
<div style='margin-left:15;'>  
	<strong> <font size='5'> LAPORAN PEMBAYARAN OBAT </font>  </strong> <br>
	Tanggal Cetak : ".date('Y - m - d')." <br>
	<br>
</div>
                                <table class=table table-bordered table-hover>
                                        <tr bgcolor=skyblue>
                                            <th width=5% style=text-align : center;><strong>NO</strong></th>
                                            <th width=10% style=text-align : center;><strong>Tgl Beli</strong></th>
											<th width=10% style=text-align : center;><strong>Supplier</strong></th>
											<th width=15% style=text-align : center;><strong>Kode Obat</strong></th>
											<th width=15% style=text-align : center;><strong>Nama Obat </strong></th>	
											<th width=15% style=text-align : center;><strong>Kategori </strong></th>									
											<th width=5% style=text-align : center;><strong>Jumlah Beli </strong></th>
											<th width=15% style=text-align : center;><strong>Biaya beli </strong></th>
                                        </tr>
                                    <tbody> ";

									require_once "../koneksi.php"; 

									$exe = "
										select p.*,k.nama,tot.jml_jenis,tot.qty,coalesce(tot.jml,0)as biaya,coalesce(bayar.bayar,0) as terbayar,s.nama as sup,
case when (coalesce(tot.jml,0)<=coalesce(bayar.bayar,0)) then 'Lunas' else 'Belum lunas' end as status
from pembelian p
										left join karyawan k on k.id_karyawan=p.id_karyawan
										left join suplier s on s.id_suplier=p.id_suplier
										left join (select faktur,count(*) as jml_jenis,sum(jumlah)as qty, sum(harga) as jml from det_pembelian group by faktur)tot on tot.faktur=p.faktur
left join (select faktur, sum(jumlah) as bayar from pembayaran group by faktur)bayar on bayar.faktur=p.faktur $cari order by faktur desc limit $page,10";

									$cariagt = mysqli_query($con,$exe) or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariagt)<=0)
										{
											$content .= "
											<tr>
                                            <td align='center' colspan='8'>Data kosong..</td>
											</tr>
											";
										}
										else{ $n=1;
											while($u = mysqli_fetch_assoc($cariagt))
											{  
											$content .="
											<tr bgcolor=beige>
												<td align=center>".($n)."</td>
												<td align=center>".$u['faktur']."</td>
												<td align=center>".substr($u['tgl'],0,50)."</td>
												<td align=center>".substr($u['sup'],0,50)."</td>
												<td align=center>".substr($u['jml_jenis'],0,50)." Jenis</td>
												<td align=center>".$u['qty']."</td>
												<td align=center>Rp. ".number_format($u['biaya'])."</td>
												<td align=center>Rp. ".number_format($u['biaya'])."</td>
												<td align=center>".$u['status']."</td>
											</tr>";
											$n++;
											}
										}
									$content .= "
                                    </tbody>
                                </table>";
	
	$tglnow = date('Y - m - d');

	if($_POST['format']=='1') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pembayaran_$tglnow.doc");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $content;
	}
	elseif($_POST['format']=='2') {
		header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=lap_pembayaran_$tglnow.xls");
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