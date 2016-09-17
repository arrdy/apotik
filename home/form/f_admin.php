<?php 

    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select * from admin where id_admin='$id' "); 
                                   $tampil = mysqli_fetch_assoc($cari);
        $id = $tampil['id_admin'];
        $nama = $tampil['nama'];
        $us = $tampil['username'];
        $ps = $tampil['password'];
        $edit_id = $_GET['id'];
    }
    else
    {      
        $cari_id = mysqli_query($con,"select coalesce(max(right(id_admin,3)),0)+1 as kd from admin") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'AD-'.$id.$kd;  

        $edit_id='';
        $nama= '';
        $us= '';
        $ps= ''; 
    }                 
?>

</br></br>
<label style="margin-left:25px;"><b> <font size="5"> FORM ADMIN </font> </b></label></br></br>
<form id="formulir" name='form' >
<table cellpadding="5" style="margin-left:24px; border:0px solid #999;">
<tr >
                                        <td style="border:0px solid #999;">    <label>Kode admin</label> </td>
                                        <td style="border:0px solid #999;">    <input class="form-control" name="id" id="id" value='<?php echo $id; ?>' readonly='readonly'/> </td>
</tr>
<tr>
                                        <td style="border:0px solid #999;">    <label>Nama admin</label> </td>
                                        <td style="border:0px solid #999;">    <input class="form-control" name="nama" id="nama" value='<?php echo $nama; ?>' /> </td>
</tr>
<tr>
                                        <td style="border:0px solid #999;">    <label>Username</label> </td>
                                        <td style="border:0px solid #999;">    <input class="form-control" name="username" id="username" value='<?php echo $us; ?>' /> </td>
</tr>
<tr>
                                        <td style="border:0px solid #999;">    <label>Password</label> </td>
                                        <td style="border:0px solid #999;">    <input class="form-control" name="password" id="password" value='<?php echo $ps; ?>' /> </td>
</tr>
<tr>
                                        <td style="border:0px solid #999;">    </td>
                                        <td style="border:0px solid #999;">        <button class="btn btn-default" type="button" onclick="tengah('tabeladmin','')" >Kembali</button> 
                                                                                   <button class="btn btn-primary" style="margin-left:5px;" type="button" onclick="val_admin('<?php echo $edit_id; ?>');" > Simpan </button> 
                                                                               </td>
</tr>
</table>
</form>
