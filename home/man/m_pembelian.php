<?php
	require "../koneksi.php";
	if(!empty($_POST['idp'])) $idp = $_POST['idp']; 
	if(!empty($_POST['tgl'])) $tgl = $_POST['tgl']; 
	if(!empty($_POST['suplier'])) $suplier = $_POST['suplier']; 
	if(!empty($_POST['nomor'])) $nomor = $_POST['nomor']; 
	if(!empty($_POST['dibayar'])) $dibayar = $_POST['dibayar'];

	session_start();
	$user = $_SESSION['id'];

	if(!empty($_GET['edit_id']))
	{   
		$tr = mysqli_query($con,"insert into pembelian values('$idp','$user','$tgl','$suplier') ") or die('Terjadi kesalahan, Gagal input data.. !');
		if($tr){
			$hpstrans = mysqli_query($con,"delete from det_pembelian where faktur='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');
				if($hpstrans)
				{
					for ($i=1; $i < $nomor; $i++) {
							$rek = $_POST['rekening'.$i];
							$debit = $_POST['jdebit'.$i];
							$kredit = $_POST['jkredit'.$i]; 
							mysqli_query($con,"insert into tb_ju values('','$idp','$rek','$debit','$kredit') ");
				}	
			} 
		}	
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from pembelian where faktur='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
		mysqli_query($con,"delete from det_pembelian where faktur='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');
	}
	else
	{  
		mysqli_query($con,"insert into pembelian values('$idp','$user','$tgl','$suplier') ") or die('Terjadi kesalahan, Gagal input data.. !');
		for ($i=1; $i <= $_POST['nomor']; $i++) {
				$kd_obat = $_POST['kd_obat'.$i];
				$qty = $_POST['qty'.$i];
				$jml = $_POST['jml'.$i]; 
				$kdl = $_POST['kadaluarsa'.$i];
			mysqli_query($con,"insert into det_pembelian values('','$idp','$kd_obat','$jml','$qty','$kdl') ");
		} 
	}  

?>	