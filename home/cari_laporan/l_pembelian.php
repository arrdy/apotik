<script type="text/javascript">		
	function filter_pembelian(){  // UNTUK CONTENT
		var t1 = document.getElementById('t1').value;
		var t2 = document.getElementById('t2').value;
		var tarik_file = "laporan/t_laporan_pembelian.php?t1="+t1+"&t2="+t2;
		$('#viewlap').load(tarik_file);
	}
</script>
<h2 style="margin-left:50;"> LAPORAN PEMBELIAN OBAT </h2> <br>
<div style="margin-left:50;">
<form>
Mulai : <input type="date" style="margin-left:25; margin-bottom:5;" name='tgl1' id="t1" value='<?php echo date('Y-m-d'); ?>' /><br>
Sampai : <input type="date" style="margin-left:11; margin-bottom:5;" name='tgl2' id="t2" value='<?php echo date('Y-m-d'); ?>' /><br>
<br><input style="margin-left:5;" class="btn btn-outline btn-success" type='button' onclick="filter_pembelian();" value='Preview' class='button'>
</form>
</div>
  
<div id='viewlap'>
</div>