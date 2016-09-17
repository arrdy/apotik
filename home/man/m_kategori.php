<?php

	require "../koneksi.php";
	if(!empty($_POST['id_kategori'])) $kd = $_POST['id_kategori']; 
	if(!empty($_POST['kategori'])) $nm = $_POST['kategori']; 

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update kategori set kategori='$nm' where id_kategori='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from kategori where id_kategori='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into kategori values('$kd','$nm') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	