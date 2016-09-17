<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $edit_id =$_GET['id'];
        $cari = mysqli_query($con,"select * from pembayaran where id_pembayaran='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $kd = $tampil['id_pembayaran'];
        $faktur = $tampil['faktur'];
        $tgl = $tampil['tgl'];
        $jumlah = $tampil['jumlah'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(id_pembayaran,3)),0)+1 as kd from pembayaran") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'PB-'.$id.$kd;  

        $kd = '';
        $faktur = '';
        $tgl = '';
        $jumlah = '';
        $edit_id ='';
    }       
?>

</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM PEMBAYARAN </font> </b></label></br></br>
<form id="formulir" name='form' >
<table border="0" cellpadding="5" style="margin-left:24px; border:0px solid #999;  ">
<tr>
                <td style="border:0px solid #999;">    <label>ID Pembayaran</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="idp" id="ido" value='<?php echo $id; ?>' readonly='readonly' /> </td>
</tr>
<tr>
		<label style="margin-left:25px; border:0px solid #999;">Faktur yang dibayar</label>
		<select style="margin-left:30; width:30%;" name="faktur" id="faktur" class="form-control">
						<?php require_once "koneksi.php";
								$cari = mysqli_query($con,"select *,d.harga-b.jml as sisa from pembelian p
left join (select faktur,sum(jumlah)as jml from pembayaran group by faktur) b on b.faktur=p.faktur
left join suplier s on s.id_suplier=p.id_suplier
left join (select faktur,sum(harga) as harga from det_pembelian )d on d.faktur=p.faktur
where b.jml < d.harga
group by p.faktur ") or die ('Pencarian Gagal !!!');
								if(mysqli_num_rows($cari)>0)
								{	
										while ($k = mysqli_fetch_assoc($cari))
										{	
											echo "<option value='".$k['faktur']."'"; if($faktur==$k['faktur']){ echo 'selected=selected'; }  echo"> 
                                            ".$k['faktur']."- ( ".$k['nama']." ) Kurang : ".$k['sisa']."</option>";
										}	
						    	} 
						 ?>
		</select></br>
</tr>

<tr>
                <td style="border:0px solid #999;">    <label>Tanggal</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" style="width:135%;" type='date' name='tgl' placeholder="Kelas" id="tgl" value="<?php echo $tgl; ?>" required="required" /> </td>
</tr>
<tr>
                <td style="border:0px solid #999;">    <label>Dibayarkan ( Rp. )</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="dibayar" id="harga" onkeyup="val_angka(this.id)" value='<?php echo $jumlah; ?>' /> </td>
</tr>
<tr>


                <td style="border:0px solid #999;">    </td>
            <td style="border:0px solid #999;"> <button class="btn btn-default" type="button" onclick="tengah('tabelpembayaran','')" >Kembali</button> 
            <button style="margin-left:5px;" type="button" class="btn btn-primary" onclick="val_pembayaran('<?php echo $edit_id; ?>');" > Simpan </button></td>
</tr>
</table>
</form>
