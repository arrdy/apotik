<?php
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	require_once "koneksi.php";
	$cari = mysqli_query($con,"select * from 
	( select id_admin as id,nama,username,password,'Admin' as level from admin 
		union
	  select id_karyawan as id,nama,username,password,'Karyawan' as level from karyawan 
	)tabel	
	where username='$user' and password='$pass'
	") or die(mysql_error());
	$htg = mysqli_num_rows($cari);
	if($htg==1)
	{
	$u= mysqli_fetch_assoc($cari);
		session_start(); 
			$_SESSION['id']= $u['id'];
			$_SESSION['nama']= $u['nama'];
			$_SESSION['level']= $u['level'];
		header('location:index.php');
	}else{ 
		 header('location:../index.php?pass=cek');
	}
?>