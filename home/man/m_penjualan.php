<?php
	require "../koneksi.php";
	session_start();
	$user = $_SESSION['id'];
	if(!empty($_POST['idp'])) $idp = $_POST['idp']; 
	if(!empty($_POST['tgl'])) $tgl = $_POST['tgl']; 

		mysqli_query($con,"insert into penjualan values('$idp','$user','$tgl') ") or die('Terjadi kesalahan, Gagal input data.. !');
		for ($i=1; $i <= $_POST['nomor']; $i++) {
				$kd_obat = $_POST['kd_obat'.$i];
				$qty = $_POST['qty'.$i];
				$jml = $_POST['jml'.$i]; 
			mysqli_query($con,"insert into det_penjualan values('','$idp','$kd_obat','$jml','$qty') ");
		} 
?>	