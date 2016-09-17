<?php

	require "../koneksi.php";
	session_start();
	$user = $_SESSION['id'];

	if(!empty($_POST['idp'])) $kd = $_POST['idp']; 
	if(!empty($_POST['tgl'])) $tgl = $_POST['tgl']; 
	if(!empty($_POST['faktur'])) $faktur = $_POST['faktur']; 
	if(!empty($_POST['dibayar'])) $dibayar = $_POST['dibayar']; 

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update pembayaran set id_karyawan='$user',faktur='$faktur',tgl='$tgl',jumlah='$dibayar' where id_pembayaran='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from pembayaran where id_pembayaran='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into pembayaran values('$kd','$faktur','$user','$tgl','$dibayar') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	