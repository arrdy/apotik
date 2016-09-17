<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select * from satuan where id_satuan='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $id = $tampil['id_satuan'];
        $st = $tampil['satuan'];
        $edit_id = $_GET['id'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(id_satuan,3)),0)+1 as kd from satuan") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'ST-'.$id.$kd;  

        $edit_id='';
        $st= '';
    }                 
?>

</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM Satuan </font> </b></label></br></br>
<form id="formulir" name='form' >
<table cellpadding="5" style="margin-left:24px; border:0px solid #999;">
<tr >
         <td style="border:0px solid #999;">    <label>Kode Satuan</label> </td>
         <td style="border:0px solid #999;">    <input class="form-control" name="id_satuan" id="id" value='<?php echo $id; ?>' readonly='readonly'/> </td>
</tr>
<tr>
          <td style="border:0px solid #999;">    <label>Jenis Satuan</label> </td>
         <td style="border:0px solid #999;">    <input class="form-control" name="satuan" id="nama" value='<?php echo $st; ?>' /> </td>
</tr>

<tr>
        <td style="border:0px solid #999;">    </td>
        <td style="border:0px solid #999;"> <button type="button" class="btn btn-default" onclick="tengah('tabelsatuan','')" >Kembali</button> 
        <button style="margin-left:5px;" type="button" class="btn btn-primary" onclick="val_satuan('<?php echo $edit_id; ?>');" > Simpan </button> </td>
</tr>
</table>
</form>
