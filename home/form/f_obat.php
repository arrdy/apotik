<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select * from obat where kd_obat='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $kd = $tampil['kd_obat'];
        $kt = $tampil['id_kategori'];
        $st = $tampil['id_satuan'];
        $jn = $tampil['jenis'];
        $obt = $tampil['nama_obat'];
        $hrg = $tampil['harga'];
        $edit_id = $_GET['id'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(kd_obat,3)),0)+1 as kd from obat") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'OB-'.$id.$kd;  
		$kt = '';
        $st = '';
        $jn = '';
        $obt = '';
        $hrg = ''; 
        $edit_id='';
    }       
?>

</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM OBAT </font> </b></label></br></br>
<form id="formulir" name='form' >
<table border="0" cellpadding="5" style="margin-left:24px; border:0px solid #999;  ">
<tr>
                <td style="border:0px solid #999;">    <label>Kd obat</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="kd_obat" id="ido" value='<?php echo $id; ?>' readonly='readonly' /> </td>
</tr>
<tr>
		<label>Kategori</label>
		<select style="margin-left:30; width:30%;" name="id_kategori" id="id" class="form-control">
						<?php require_once "koneksi.php";
								$cari = mysqli_query($con,"select * from kategori") or die ('Pencarian Gagal !!!');
								if(mysqli_num_rows($cari)>0)
								{	
										while ($k = mysqli_fetch_assoc($cari))
										{	
											echo "<option value='".$k['id_kategori']."'"; if($kt==$k['id_kategori']){ echo 'selected=selected'; }  echo"> ".$k['kategori']."</option>";
										}	
						    	} 
						 ?>
		</select></br>
</tr>
<tr>
			<label>Satuan</label>
			<select style="margin-left:30; width:30%;" name="id_satuan" required=required class="form-control">
							<?php require_once "koneksi.php";
									$cari = mysqli_query($con,"select * from satuan") or die ('Pencarian Gagal !!!');
									if(mysqli_num_rows($cari)>0)
									{	
											while ($s = mysqli_fetch_assoc($cari))
											{	
												echo "<option value='".$s['id_satuan']."'"; if($st==$s['id_satuan']){ echo 'selected=selected'; }  echo"> 
                                                ".$s['satuan']."</option>";
											}	
							    	} 
							 ?>
			</select></br>
</tr>
<tr>
                <td style="border:0px solid #999;">    <label>Jenis</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="jenis" id="id" value='<?php echo $jn; ?>' /> </td>
</tr>
<tr>
                <td style="border:0px solid #999;">    <label>Nama Obat</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="nama_obat" id="nama_obat" value='<?php echo $obt; ?>' /> </td>
</tr>
<tr>
                <td style="border:0px solid #999;">    <label>Harga</label> </td>
                <td style="border:0px solid #999;">    <input class="form-control" name="harga" id="harga" value='<?php echo $hrg; ?>' /> </td>
</tr>
<tr>


                <td style="border:0px solid #999;">    </td>
            <td style="border:0px solid #999;"> <button class="btn btn-default" type="button" onclick="tengah('tabelobat','')" >Kembali</button> 
            <button style="margin-left:5px;" type="button" class="btn btn-primary" onclick="val_obat('<?php echo $edit_id; ?>');" > Simpan </button></td>
</tr>
</table>
</form>
