<?php

if(!empty($_GET['hal'])){
	$hal = $_GET['hal'];
	if($hal=='tabelkategori'){ include "tabel/t_kategori.php"; }
	else if ($hal=='tabeladmin') {include "tabel/t_admin.php";}
	else if ($hal=='tabelkaryawan') {include "tabel/t_karyawan.php";}
	else if ($hal=='tabelsatuan') {include "tabel/t_satuan.php";}
	else if ($hal=='tabelsuplier') {include "tabel/t_suplier.php";}
	else if ($hal=='tabelobat') {include "tabel/t_obat.php";}
	else if ($hal=='tabelpenjualan') {include "tabel/t_penjualan.php";}
	else if ($hal=='tabelpembelian') {include "tabel/t_pembelian.php";}
	else if ($hal=='tabelpembayaran') {include "tabel/t_pembayaran.php";}
	else if ($hal=='formpenjualan') {include "form/f_penjualan.php";}
	else if ($hal=='formpembelian') {include "form/f_pembelian.php";}
	else if ($hal=='formpembayaran') {include "form/f_pembayaran.php";}
	else if ($hal=='lap_obat') {include "laporan/l_obat.php";}
	else if ($hal=='laporan_penjualan') {include "cari_laporan/l_penjualan.php"; }
	else if ($hal=='laporan_pembelian') {include "cari_laporan/l_pembelian.php"; }
	else if ($hal=='laporan_pembayaran') {include "cari_laporan/l_pembayaran.php"; }
	else if ($hal=='laporan_obat') {include "cari_laporan/l_obat.php"; }
	else if ($hal=='formkategori') {include "form/f_kategori.php";}
	else if ($hal=='formadmin') {include "form/f_admin.php";}
	else if ($hal=='formkaryawan') {include "form/f_karyawan.php";}
	else if ($hal=='formsatuan') {include "form/f_satuan.php";}
	else if ($hal=='formsuplier') {include "form/f_suplier.php";}
	else if ($hal=='formobat') {include "form/f_obat.php";}
}

?>