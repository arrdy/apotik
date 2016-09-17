
<?php
require "../koneksi.php";

//harus selalu gunakan variabel term saat memakai autocomplete,
$term = $_GET['term'];

$query = mysqli_query($con,"select o.*,coalesce(bo.jml,0)-coalesce(jo.jml,0) as sisa_obat
from obat o
left join (select kd_obat,sum(jumlah)as jml,max(tgl_kadaluarsa)as ex from det_pembelian group by kd_obat)bo on bo.kd_obat=o.kd_obat
left join (select kd_obat,sum(jumlah)as jml from det_penjualan group by kd_obat)jo on jo.kd_obat=o.kd_obat
where coalesce(bo.jml,0)-coalesce(jo.jml,0) > 0 and o.nama_obat like '%".$term."%' ");  //'%".$term."%'


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