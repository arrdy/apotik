<?php

	require "../koneksi.php";
	if(!empty($_POST['id_karyawan'])) $kd = $_POST['id_karyawan']; 
	if(!empty($_POST['nama'])) $nm = $_POST['nama']; 
	if(!empty($_POST['username'])) $user = $_POST['username']; 
	if(!empty($_POST['password'])) $pass = $_POST['password']; 

	if(!empty($_GET['edit_id']))
	{   
		mysqli_query($con,"update karyawan set nama='$nm',username='$user',password='$pass' where id_karyawan='$_GET[edit_id]' ") or die('Terjadi kesalahan, Gagal Ubah data.. !');
	}
	else
	if(!empty($_POST['hapus_id']))
	{   
		mysqli_query($con,"delete from karyawan where id_karyawan='$_POST[hapus_id]' ") or die('Terjadi kesalahan, Gagal Hapus data.. !');	
	}
	else
	{  
		mysqli_query($con,"insert into karyawan values('$kd','$nm','$user','$pass') ") or die('Terjadi kesalahan, Gagal input data.. !');
	}  

?>	