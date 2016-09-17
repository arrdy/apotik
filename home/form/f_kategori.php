<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select * from kategori where id_kategori='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $id = $tampil['id_kategori'];
        $ktg = $tampil['kategori'];
        $edit_id = $_GET['id'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(id_kategori,3)),0)+1 as kd from kategori") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'KT-'.$id.$kd;  

        $edit_id='';
        $ktg= '';
    }                 
?>



</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM KATEGORI </font> </b></label></br></br>
<form id="formulir" name='form' >
<table cellpadding="5" style="margin-left:24px; border:0px solid #999;">
<tr >
        <td style="border:0px solid #999;">    <label>Kode Kategori</label> </td>
        <td style="border:0px solid #999;">    <input class="form-control"  name="id_kategori" id="id" value='<?php echo $id; ?>' readonly='readonly'/> </td>
</tr>
<tr>
        <td style="border:0px solid #999;">    <label>Kategori</label> </td>
        <td style="border:0px solid #999;">    <input class="form-control"  name="kategori" id="nama" value='<?php echo $ktg; ?>' /> </td>
</tr>
<tr>
        <td style="border:0px solid #999;">    </td>
        <td style="border:0px solid #999;">  <button type="button"  class="btn btn-default" onclick="tengah('tabelkategori','')" >Kembali</button> 
        <button class="btn btn-primary" style="margin-left:5px;" type="button" onclick="val_kategori('<?php echo $edit_id; ?>');" > Simpan </button></td>
</tr>
</table>
</form>