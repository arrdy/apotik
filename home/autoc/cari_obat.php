<?php
require "../koneksi.php";

//harus selalu gunakan variabel term saat memakai autocomplete,
$term = $_GET['term'];

$query = mysqli_query($con,"select * from obat o where o.nama_obat like '%".$term."%' ");  //'%".$term."%'


$json = array();
while($produk = mysqli_fetch_assoc($query)){
$json[] = array(
	'label' => $produk['nama_obat'].' | '.$produk['kd_obat'], // text sugesti saat user mengetik di input box 
	'value' => $produk['nama_obat'], // nilai yang akan dimasukkan diinputbox saat user memilih salah satu sugesti
	'nama' => $produk['kd_obat'],
	'harga' => $produk['harga']
);

}
header("Content-Type: text/json");
echo json_encode($json); 

?>