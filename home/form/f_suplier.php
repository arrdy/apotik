<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select * from suplier where id_suplier='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $id = $tampil['id_suplier'];
        $nama = $tampil['nama'];
        $alm = $tampil['alamat'];
        $hp = $tampil['no_hp'];
        $edit_id = $_GET['id'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(id_suplier,3)),0)+1 as kd from suplier") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'SP-'.$id.$kd;  

        $edit_id='';
        $nama= '';
        $alm= '';
        $hp= ''; 
    }                 
?>

</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM suplier </font> </b></label></br></br>
<form id="formulir" name='form' >
<table cellpadding="5" style="margin-left:24px; border:0px solid #999;">
<tr >
    <td style="border:0px solid #999;">    <label>Kode suplier</label> </td>
  	<td style="border:0px solid #999;">    <input class="form-control" name="id_suplier" id="id" value='<?php echo $id; ?>' readonly='readonly'/> </td>
</tr>
<tr>
    <td style="border:0px solid #999;">    <label>Nama </label> </td>
    <td style="border:0px solid #999;">    <input class="form-control" name="nama" id="nama" value='<?php echo $nama; ?>' /> </td>
</tr>
<tr>
    <td style="border:0px solid #999;">    <label>Alamat</label> </td>
    <td style="border:0px solid #999;">    <input class="form-control" name="alamat" id="alamt" value='<?php echo $alm; ?>' /> </td>
</tr>
<tr>
    <td style="border:0px solid #999;">    <label>NO HP</label> </td>
    <td style="border:0px solid #999;">    <input class="form-control" name="no_hp" id="nohp" value='<?php echo $hp; ?>' /> </td>
</tr>
<tr>
    <td style="border:0px solid #999;">    </td>
    <td style="border:0px solid #999;">  <button class="btn btn-default" type="button" onclick="tengah('tabelsuplier','')" >Kembali</button> 
    <button style="margin-left:5px;" type="button" class="btn btn-primary" onclick="val_suplier('<?php echo $edit_id; ?>');" > Simpan </button></td>
</tr>
</table>
</form>
