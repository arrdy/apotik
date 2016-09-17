
<?php  session_start(); 
if(empty($_SESSION['id'])){ header('location:../'); }
//if(empty($_SESSION['level'])){ header('location:../index.php'); }
?><html lang="en">
<!-- BEGIN HEAD-->
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">

<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/fungsi.js"></script>

<script type="text/javascript">

	function tengah(hal,kkunci,page){  // UNTUK CONTENT
		var tujuan = "tengah.php?hal="+hal+"&kk="+kkunci+"&page="+page; 
		//$('#judul').text('Data '+url);
		$('#tampil').load(tujuan);

        document.getElementById('cari').name=hal;
        document.getElementById('cari').hidden=false;


        if(hal.substr(0,5)=='tabel') { document.getElementById('cari').hidden=false; }else{ document.getElementById('cari').hidden=true; }
	}

    function konfir_hapus(manipulasi,id,reload,hal)  //ID YANG DIHAPUS ADA DI GET BARENG URL
    {
        pil = confirm("anda yakin ingin menghapus data '"+id+"' ?");
        if(pil==true)
            {  
                $.ajax({
                    type : 'POST',
                    url : manipulasi,
                    data : { hapus_id : id },
                            complete : function(){ 
                                       tengah(reload,'');  
                           } 
                 }); 
            }
    }

    function val_admin(edit_id){

    if(document.getElementById('nama').value=='')
        { alert('Silahkan isi Nama.. !'); 
            document.getElementById('nama').value =  '';
            document.getElementById('nama').focus(); 
    }
    else if(document.getElementById('username').value=='')
        { alert('Silahkan isi username.. !'); 
            document.getElementById('username').value =  '';
            document.getElementById('username').focus(); 
    }
    else if(document.getElementById('password').value=='')
        { alert('Silahkan isi password.. !'); 
            document.getElementById('password').value =  '';
            document.getElementById('password').focus(); 
    }
    else{   

            $.ajax({ 
                url:"man/m_admin.php?edit_id="+edit_id , 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabeladmin','');
                               } 
            });
       }    
    }


    function val_kategori(edit_id){

        if(document.getElementById('nama').value=='')
        {   alert('Silahkan Isi Nama kategori..!!');
            document.getElementById('nama').value='';
            document.getElementById('nama').focus();
        }
        else{
            $.ajax({ 
             url:"man/m_kategori.php?edit_id="+edit_id, 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabelkategori','');
                               } 
            });
        }
    }

    function val_karyawan(edit_id){

        if(document.getElementById('nama').value=='')
        {   alert('Silahkan Isi Nama karyawan...!!');
            document.getElementById('nama').value='';
            document.getElementById('nama').focus();
        }
      else{
            $.ajax({ 
             url:"man/m_karyawan.php?edit_id="+edit_id, 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabelkaryawan','');
                               } 
            });
        }
    }

     function val_satuan(edit_id){

        if(document.getElementById('nama').value=='')
        {   alert('Silahkan Isi Nama satuan...!!');
            document.getElementById('nama').value='';
            document.getElementById('nama').focus();
        }
      else{
            $.ajax({ 
             url:"man/m_satuan.php?edit_id="+edit_id, 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabelsatuan','');
                               } 
            });
        }
    }
    

     function val_suplier(edit_id){

        if(document.getElementById('nama').value=='')
        {   alert('Silahkan Isi Nama suplier...!!');
            document.getElementById('nama').value='';
            document.getElementById('nama').focus();
        }
      else{
            $.ajax({ 
             url:"man/m_suplier.php?edit_id="+edit_id, 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabelsuplier','');
                               } 
            });
        }
    }
        function val_obat(edit_id){

        if(document.getElementById('ido').value=='')
        {   alert('Silahkan Isi Nama obat...!!');
            document.getElementById('ido').value='';
            document.getElementById('ido').focus();
        }
      else{
            $.ajax({ 
             url:"man/m_obat.php?edit_id="+edit_id, 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                    tengah('tabelobat','');
                               } 
            });
        }
    }

    function val_penjualan(){
      var jml =  parseInt(document.getElementById('t_qty').innerHTML); 

      if(jml<=0)
        { 
            alert('Silahkan isi Jumlah dibeli.. !'); 
            document.getElementById('obat').focus(); 
        } 
        else
        {   

            $.ajax({ 
                url:"man/m_penjualan.php" , 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                           tengah('tabelpenjualan','','');  
                               } 
            });
       } 

    }

    function val_pembayaran(edit_id){
        if(document.getElementById('faktur').value=='')
        { 
            alert('Faktur pembayaran kosong.. !'); 
            document.getElementById('faktur').focus(); 
        } 
        else if(document.getElementById('tgl').value=='')
        { 
            alert('Silahkan isi tanggal Pembayaran.. !'); 
            document.getElementById('tgl').focus(); 
        } 
        else
        {   

            $.ajax({ 
                url:"man/m_pembayaran.php?edit_id="+edit_id , 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                           tengah('tabelpembayaran','','');  
                               } 
            });
       } 

    }

     function val_pembelian(){

      var jml =  parseInt(document.getElementById('t_qty').innerHTML); 
      var tot =  parseInt(document.getElementById('tot').value);
/*      var dibayar =  parseInt(document.getElementById('dibayar').value);   
     if(dibayar<0)
        { alert('Dibayar minimal nol.. !'); 
            document.getElementById('dibayar').value = '';
            document.getElementById('dibayar').focus(); 
        } 
*/
     if(jml<=0)
        { alert('Silahkan cari obat yang dibeli.. !'); 
            document.getElementById('obat').value = '';
            document.getElementById('obat').focus(); 
        }   
       else if(tot<=0)
        { alert('Silahkan Isi total Bayar.. !'); 
            document.getElementById('tot').value = '';
            document.getElementById('tot').focus(); 
        } 
    else{   

            $.ajax({ 
                url:"man/m_pembelian.php" , 
                type: 'POST',
                data: $("#formulir :input").serializeArray(),
                                success : function(){ 
                                           tengah('tabelpembelian','','');  
                               } 
            });
       } 

    }
</script>
     <meta charset="UTF-8" />
    <title>APOTIK</title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.css" /> 
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/theme.css" />
    <link rel="stylesheet" href="assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="assets/plugins/Font-Awesome/css/font-awesome.css" />	
	<link rel="stylesheet" href="assets/css/tabel.css"/>
	<link rel="stylesheet" href="assets/plugins/social-buttons/social-buttons.css" />
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="padTop53 " >
     <!-- MAIN WRAPPER -->
    <div id="wrap">
        <!-- MENU SECTION -->
		
       <div id="left">
            <div class="media user-media well-small">
			<div class="media user-media well-small" style="margin-left:10%;">
                     <img class="media-object img-thumbnail user-img" src="icon/logo.PNG" width='90%' height='90%' /> 
            </div>    
				<br /><br />
                <div class="media-body" style="margin-left:20%;">
                    <h5 class="media-heading"> <?php echo ucfirst($_SESSION['nama'])." (".ucfirst($_SESSION['level'])." )"; ?> </br></h5> <a href='logout.php'>Logout </a></br></br>
					</br>
                </div>
                <br />
            </div>

            <ul id="menu" class="collapse">			
				<li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#keg">
                        <i class="icon-calendar"></i> Master Data 
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success"></span>&nbsp;
                    </a>
                    <ul class="collapse" id="keg">
<?php if ($_SESSION['level']=='Admin'){ ?>  
					    <li class="" onclick="tengah('tabeladmin','')"><a href="#"><i class="icon-angle-right"></i> Admin</a></li>
                        <li class="" onclick="tengah('tabelkaryawan','')"><a href="#"><i class="icon-angle-right"></i> Karyawan</a></li>
<?php }
if ($_SESSION['level']=='Karyawan'){  ?>                        
                        <li class="" onclick="tengah('tabelkategori','')" ><a href="#"><i class="icon-angle-right"></i> kategori</a></li>					
				        <li class="" onclick="tengah('tabelsatuan','')"><a href="#"><i class="icon-angle-right"></i> Satuan</a></li>
                        <li class="" onclick="tengah('tabelsuplier','')"><a href="#"><i class="icon-angle-right"></i> Suplier</a></li> 
                        <li class="" onclick="tengah('tabelobat','')"><a href="#"><i class="icon-angle-right"></i> Obat</a></li>   
<?php } ?>                                            
                    </ul>
                </li>	
<?php if ($_SESSION['level']=='Karyawan'){  ?> 				
                <li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#transaksi">
                        <i class="icon-pencil"></i> Transaksi
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success"></span>&nbsp;
                    </a>
                    <ul class="collapse" id="transaksi">
<?php // if ($_SESSION['level']=='admin' || $_SESSION['level']=='kepala'){ ?>   <li class="" onclick="tengah('tabelpenjualan','')"><a href="#"><i class="icon-angle-right"></i> Penjualan Obat</a></li>  <?php // } ?>
<?php // if ($_SESSION['level']=='admin' || $_SESSION['level']=='dev' || $_SESSION['level']=='kepala'){ ?>	    <li class="" onclick="tengah('tabelpembelian','')"><a href="#"><i class="icon-angle-right"></i> Pembelian Obat</a></li>    <?php // } ?>
<?php // if ($_SESSION['level']=='kepala'){ ?>		<li class="" onclick="tengah('tabelpembayaran','')"><a href="#"><i class="icon-angle-right"></i> Pembayaran pembelian</a></li> <?php // } ?>
                    </ul>
                </li>
<?php } ?>                

<?php if ($_SESSION['level']=='Admin'){  ?>  		
				<li class="panel ">
                    <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle collapsed" data-target="#laporan">
                        <i class="icon-file-alt"></i> Laporan
	   
                        <span class="pull-right">
                            <i class="icon-angle-left"></i>
                        </span>
                          &nbsp; <span class="label label-success"></span>&nbsp;
                    </a>
                    <ul class="collapse" id="laporan">	
                    <li  onclick="tengah('laporan_obat','')" class=""><a href="#"><i class="icon-angle-right"></i> Laporan Data Obat </a></li> 				
                        <li onclick="tengah('laporan_pembelian','')" class=""><a href="#"><i class="icon-angle-right"></i> Laporan Pembelian </a></li>
                        <li onclick="tengah('laporan_penjualan','')" class=""><a href="#"><i class="icon-angle-right"></i> Laporan Penjualan </a></li>
						<li  onclick="tengah('laporan_pembayaran','')" class=""><a href="#"><i class="icon-angle-right"></i> Laporan Pembayaran </a></li>       
                                     
                    </ul>
                </li>
<?php } ?>                
                   				
            </ul>
			
			
        </div>
        <!--END MENU SECTION -->
        <!--PAGE CONTENT -->

        <div id="content">

            <div class="inner" style="min-height:1200px; ">
                <div class="row" style="background-color:Aliceblue; "> 
                    <div class="col-lg-12">
                    <img src="icon/baner.JPG" style="float:left;" width="100%" height="10%">
                    <h2><b><font face="candara"> APOTEK AMBAL</font> </b></h2>
                    <h4><i>JL. Daendels ambal resmi, ambal Kebumen</i> </h4>
                        <h2><div id="judul" style='margin-left:1.1%;'> <?php if(!empty($_GET['id_sm'])){ echo "detail_surat_masuk.php";  } ?> </div></h2>
                    </div>
                </div>
                <hr />
                <input type="text" id='cari' hidden='true' name='' value="" onkeyup="tengah(this.name,this.value)" placeholder='Cari nama..' /></br></br>
    				<div id="tampil"> 
                    <?php require_once "koneksi.php"; 

                    ?>
                    </div>
    
            </div>
        </div>
       <!--END PAGE CONTENT -->
    </div>
     <!--END MAIN WRAPPER -->
   <!-- FOOTER -->
    <div id="footer"> 
        <p></p>
    </div> <img src="icon/baner.JPG" style="float:left;" width="100%" height="4%">
    <!--END FOOTER -->
     <!-- GLOBAL SCRIPTS -->    
     <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->
</body>
    <!-- END BODY-->
    
</html>

