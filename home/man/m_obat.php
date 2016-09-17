<?php

	require "../koneksi.php";
	if(!empty($_POST['kd_obat'])) $kd = $_POST['kd_obat']; 
	if(!empty($_POST['id_kategori'])) $kt = $_POST['id_kategori']; 
	if(!empty($_POST['id_satuan'])) $st = $_POST['id_satuan']; 
	if(!empty($_POST['jenis'])) $jn = $_POST['jenis']; 
	if(!empty($_POST['nama_obat'])) $obt = $_POST['nama_obat']; 
	if(!empty($_POST['harga'])) $hrg = $_POST['harga']; 

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update obat set id_kategori='$kt',id_satuan='$st',jenis='$jn',harga='$hrg' where kd_obat='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from obat where kd_obat='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into obat values('$kd','$kt','$st','$jn','$obt','$hrg') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	