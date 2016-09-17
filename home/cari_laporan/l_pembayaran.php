<script type="text/javascript">		
	function filter_pembayaran(){  // UNTUK CONTENT
		var not = document.getElementById('not').value;
		var tarik_file = "laporan/t_laporan_pembayaran.php?status="+not; 
		$('#viewlap').load(tarik_file);
	}
</script>
<h2 style="margin-left:50;"> LAPORAN PEMBAYARAN </h2> <br>
<div style="margin-left:50;">
<form>
<strong>
Status Pembayaran : </strong>
											<select name="investor" style="margin-left:3; width:15%;" id='not' class="form-control" >
                                                                                <option value='1' selected="selected"> Belum lunas </option>
																				<option value='2' selected="selected"> Sudah lunas </option>
																				<option value='3' selected="selected"> Semua </option>
                                            </select>  

<br><input style="margin-left:5;" class="btn btn-outline btn-success" type='button' onclick="filter_pembayaran();" value='Preview' class='button'>
</form>
</div>
	
<div id='viewlap'>
</div>

