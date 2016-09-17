
<script language="JavaScript" src="./js/jquery.js"></script>

<script>
	
	function addTableRow(jQtable){
		jQtable.each(function(){

			var $table = $(this);	
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var obat = document.getElementById('obat').value;
			var kd_obat = document.getElementById('kd_obat').value;
			var harga = document.getElementById('harga').innerHTML;
			var kadaluarsa = document.getElementById('kadaluarsa').value;
			var tot = document.getElementById('tot').value;	
			var qty = document.getElementById('qty').value;	

		if(kd_obat==''){ alert('Silahkan isi nama Obat dengan Benar.. !'); 
				document.getElementById('obat').value =  '';
				document.getElementById('obat').focus(); }
		else
		{

			if (qty<=0) {
				alert('Jumlah tidak boleh kosong atau minus..');
				document.getElementById('qty').focus();
			}
			else {
              
				var bku= obat.split('-');
				var tds = '<tr class="dua" >';
				tds += '<td width=3%>'+n+'</td>';
				tds += '<td align=left>'+kd_obat+'<input type="hidden" name="kd_obat'+n+'" value="'+kd_obat+'" /></td>';
				tds += '<td align=left>'+obat+'</td>';
				tds += '<td align=left>'+kadaluarsa+'<input type="hidden" name="kadaluarsa'+n+'" id="kadaluarsa'+n+'" value="'+kadaluarsa+'" /></td>';
				tds += '<td align=center>'+qty+'<input type="hidden" name="qty'+n+'" id="qty'+n+'" value="'+qty+'" /></td>';
				tds += '<td align=center>'+rupiah(parseInt(tot))+'<input type="hidden" name="jml'+n+'" id="jml'+n+'" value="'+parseInt(tot)+'" /></td>';
				tds += '<td align=center onClick="$(this).parent().remove(); minTotal('+qty+','+parseInt(tot)+')"><a href="#"><img src="icon/remove.png" width="20" height="20" align="center"/></a></td>';
				tds += '</tr>';

    			$(this).append(tds);

				document.getElementById('nomor').value =  n;

				document.getElementById('kd_obat').value =  '';
				document.getElementById('obat').value =  '';
				document.getElementById('harga').innerHTML = '';
				document.getElementById('qty').value =  '0';
				document.getElementById('obat').focus();
				hitqty(); hitjml();
			}		
		}
				
		});
	}

	function hitqty() {
		var no = parseInt(document.getElementById('nomor').value);
		var Q = document.getElementById('t_qty').innerHTML;
		var t_Q = parseInt(Q.split(',').join('')); //parseInt(D.replace(",",""));
		var last_Q = parseInt(document.getElementById('qty'+no+'').value);
		t_Q += last_Q;
        document.getElementById('t_qty').innerHTML = rupiah(parseInt(t_Q));
	}

	function hitjml() {
		var no = parseInt(document.getElementById('nomor').value);
		var J = document.getElementById('t_jml').innerHTML;
		var t_J = parseInt(J.split(',').join('')); //parseInt(K.replace(",",""));
		var last_J = parseInt(document.getElementById('jml'+no+'').value);
		t_J += last_J;
        document.getElementById('t_jml').innerHTML = rupiah(parseInt(t_J));
	}

	function minTotal(qty,jml) {
		var SQTY = document.getElementById('t_qty').innerHTML;
		var SJML = document.getElementById('t_jml').innerHTML;
		var NO = parseInt(document.getElementById('nomor').value)-1;
		var sisa_qty = parseInt(SQTY); //parseInt(SD.replace(",",""));
		var sisa_jml = parseInt(SJML.split(',').join('')); //parseInt(SK.replace(",",""));
		sisa_qty -= parseInt(qty);
		sisa_jml -= parseInt(jml);
		document.getElementById('t_qty').innerHTML = rupiah(sisa_qty);
		document.getElementById('t_jml').innerHTML = rupiah(sisa_jml)	;
		document.getElementById('nomor').value = NO;
	}
	
	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('t_qty').innerHTML = 0;
		document.getElementById('t_jml').innerHTML = 0;
	}

	$(document).ready(function(){
			$("#obat").autocomplete({
				minLength:2,
				source:'autoc/cari_obat.php',
				select:function(event, ui){
					$('#kd_obat').val(ui.item.nama);
				//	$('#harga').text(ui.item.harga);
				}
			});
		});

</script>  


<?php 
    require_once "koneksi.php";
    
    if(!empty($_GET['id']))
    {  
        $id = $_GET['id'];
        $cari = mysqli_query($con,"select dp.faktur,k.nama,p.tgl,o.nama_obat,s.satuan,g.kategori from det_pembelian dp
																	left join pembelian p on p.faktur=dp.faktur
																	left join  karyawan k on k.id_karyawan=p.id_karyawan
																	left join obat o on o.kd_obat=dp.kd_obat 
																	left join satuan s on s.id_satuan=o.id_satuan
																	left join kategori g on g.id_kategori=o.id_kategori
									where p.faktur='$id' "); 
                $tampil = mysqli_fetch_assoc($cari);
        $bukti= $tampil['no_bukti'];
        $ket= $tampil['ket'];
        $notaris= $tampil['id_notaris'];
        $tgl= $tampil['tgl_trans'];
        $inv= $tampil['id_investor'];
        $edit_id= $_GET['id'];
    }
    else
    {      
    	$cari_id = mysqli_query($con,"select coalesce(max(right(nota,3)),0)+1 as kd from penjualan") or die('gagal pencarian data !');           
                $tmp = mysqli_fetch_assoc($cari_id); 
                $kd = $tmp['kd'];

                $id='0';    
                for($i=1; $i<=6-strlen($kd); $i++)
                { $id = '0'.$id; } 

            $id = 'FK-'.$id.$kd;  

        $edit_id='';
        $bukti= '';
        $ket='';
        $notaris= '';
        $tgl= '';
        $inv='';
    }             
?>


<div style="margin-top:-50;">
					<h3><center><strong>FORM PEMBELIAN OBAT </strong></center></h3><br>

<form id="formulir" action="man/m_pendapatan.php" method="post" >
<table width="90%" cellpadding="2%" style="border:0px;" align="center" >
	<tr >
		<td style="border:0px;"> <label>Id Trans</label></td>
		<td style="border:0px;"> : </td>
		<td style="border:0px;"> <input class="form-control" style="width:40%;" type='text' name='idp' value="<?php echo $id; ?>" required="required" readonly='readonly' size="16" /></td>
	</tr>
	<tr>
		<td style="border:0px;"> <label>Tgl Trans</label></td>
		<td style="border:0px;"> : </td>
		<td style="border:0px;"> <input class="form-control" style="width:40%;" type='date' name='tgl' placeholder="Kelas" id="tgl" value="<?php echo date('Y-m-d'); ?>" required="required"></td>
	</tr>
	<tr >
		<td style="border:0px;"> <label>Supplier</label></td>
		<td style="border:0px;"> : </td>
		<td style="border:0px;"> 
			<select style="margin-left:0; width:30%;" name="suplier" required=required class="form-control">
							<?php require_once "koneksi.php";
									$cari = mysqli_query($con,"select * from suplier") or die ('Pencarian Gagal !!!');
									if(mysqli_num_rows($cari)>0)
									{	
											while ($s = mysqli_fetch_assoc($cari))
											{	
												echo "<option value='".$s['id_suplier']."'";  echo"> 
                                                ".$s['nama']."</option>";
											}	
							    	} 
							 ?>
			</select></td>
	</tr>
	<!--tr >
		<td style="border:0px;"> <label>Dibayar</label></td>
		<td style="border:0px;"> : </td>
		<td style="border:0px;"> <input class="form-control" style="width:40%;" type='text' name='dibayar' id="dibayar" value="0" onkeyup="val_angka(this.id)"  size="16" /></td>
	</tr-->
	<tr>
		<td colspan="3" height="50" valign="bottom" style="border:0px;"><strong><label style="margin-left:110;"> Input Nama Obat yang dibeli : </label></strong></td>
	</tr>
	<tr>
		<td style="border:0px;"> <label>  </label></td>
		<td style="border:0px;">  </td>
		<td >
		<br>
		<input type="text" style="width:50%; margin-left:2%; float:left;" id="obat" class="form-control" name="obat" size="50" placeholder="Ketikkan nama obat.." >
		<label id="harga" style="font-size:30; margin-left:10; color:green;"></label><br>
		<input type='hidden' id="kd_obat" name="kd_obat" size="10" readonly="true"><br><br><br>
	<label style=" margin-left:16;"> Tgl Kadaluarsa </label>	
	<input class="form-control" style="width:20%; margin-left:16;" type='date' name='kadaluarsa' placeholder="Kelas" id="kadaluarsa" value="<?php echo date('Y-m-d'); ?>" required="required">
			<br>
			<label style="margin-left:2%;" >Jumlah dibeli :  </label><input style="width:10%; margin-left:2%;" class="form-control" type='text' name='qty' id='qty' value="0" onkeyup="val_angka(this.id)" > 
			<br>
			<label style="margin-left:2%;" >Total Bayar :  </label><input style="width:20%; margin-left:2%;" class="form-control" type='text' name='tot' id='tot' value="0" onkeyup="val_angka(this.id)" > 
		<br>	
		</td>
	</tr>
	<tr>
		<td style="border:0px;"></td>
		<td style="border:0px;"></td>
		<td style="border:0px;"> 
			<input type="button" class="btn btn-default" name="tambah" value=" Tambahkan " id="tambah" onClick="addTableRow($('#myTable')); " /><br>
		 </td>
	</tr>
	<tr>
		<td style="border:0px;"></td>
		<td style="border:0px;"></td>
		<td style="border:0px;"><br><br>
			<table width="100%" border="1" style="border-collapse:collapse" id="myTable">
				<thead>
				<tr align="center" class="head">
					<td width="20%">Kode Obat</td>
					<td width="30%">Nama Obat</td>
					<td width="15%">kadaluarsa</td>
					<td width="8%">jumlah</td>
					<td width="20%">Total Beli</td>
					<td>Aksi</td>
				</tr>
				</thead>
				<tfoot>

				<?php
				$tot_deb = 0;
				$tot_kred = 0;
				$edit_id = ''; 
				$n=0;

					if(!empty($_GET['id']))
					{	$edit_id = $_GET['id'];
					$cariju = mysqli_query($con,"select * from tb_ju j inner join tb_rekening r on r.no_rekening=j.no_rekening where id_trans='$edit_id' ") or die('gagal pencarian data !'); 
										if(mysqli_num_rows($cariju)>0)
										{	
										 $n=1;
											while($u = mysqli_fetch_assoc($cariju))
											{ 

				?>
					<tr class="dua">					
					<td align=center><?php echo $u['no_rekening']; ?><input type="hidden" name='rekening<?php echo $n; ?>' value="<?php echo $u['no_rekening']; ?>" /></td>
					<td '+gol+' ><?php echo $u['rekening']; ?></td>
					<td align=center><?php echo number_format($u['debit']); ?><input type="hidden" name="jdebit<?php echo $n; ?>" id="jdebit<?php echo $n; ?>" value="<?php echo $u['debit']; ?>" /></td>
					<td align=center><?php echo number_format($u['kredit']); ?><input type="hidden" name="jkredit<?php echo $n; ?>" id="jkredit<?php echo $n; ?>" value="<?php echo $u['kredit']; ?>" /></td>
					<td align=center onClick="$(this).parent().remove(); minTotal('<?php echo $u['debit']; ?>','<?php echo $u['kredit']; ?>')"><a href="#"><img src='icon/remove.png' width='20' height='20' align='center'/></a></td>
					</tr>
				<?php
					$tot_deb = $tot_deb+$u['debit'];
					$tot_kred = $tot_kred+$u['kredit'];
					$n++;
											}

										}
					}

				?>

				<tr align="center" bgcolor="skyblue" style="font-weight:bold;">
					<td ></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<b>
					<td id="t_qty"><?php   if(!empty($_GET['id'])){ echo number_format($tot_deb);  } else { ?> 0 <?php } ?></td></b>
					<td id="t_jml"><?php  if(!empty($_GET['id'])){ echo number_format($tot_kred); } else { ?> 0 <?php } ?></td>
					<td ></td>
					<input type="hidden" name="nomor" id="nomor" value="<?php echo $n; ?>" />
				</tr>
				</tfoot>
			</table>
		</td>
	</tr>
	<tr>
		<td style="border:0px;"> </td>
		<td style="border:0px;"> </td>
		<td style="border:0px;"> 
		<br>
			<input type='button' class="btn btn-primary" onclick="val_pembelian('');" name='simpan' id='simpan' value=' Simpan '/>  
			<input type='Reset' class="btn btn-danger" name='reset' value=' Reset ' onClick='deleteAllRows()' /> 
			<input type='button' class="btn btn-default" name='back' value=' Kembali ' onClick="tengah('tabelpembelian','','','')" /> 
		</td>
	</tr>
</table>
</form>	
</div>
