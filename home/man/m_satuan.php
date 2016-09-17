<?php

	require "../koneksi.php";
	if(!empty($_POST['id_satuan'])) $kd = $_POST['id_satuan']; 
	if(!empty($_POST['satuan'])) $st = $_POST['satuan'];  

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update satuan set satuan='$st' where id_satuan='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from satuan where id_satuan='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into satuan values('$kd','$st') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	