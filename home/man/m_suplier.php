<?php

	require "../koneksi.php";
	if(!empty($_POST['id_suplier'])) $kd = $_POST['id_suplier']; 
	if(!empty($_POST['nama'])) $nm = $_POST['nama']; 
	if(!empty($_POST['alamat'])) $alm = $_POST['alamat']; 
	if(!empty($_POST['no_hp'])) $hp = $_POST['no_hp']; 

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update suplier set nama='$nm',alamat='$alm',no_hp='$hp' where id_suplier='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from suplier where id_suplier='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into suplier values('$kd','$nm','$alm','$hp') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	