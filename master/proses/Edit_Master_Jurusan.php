<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$q_jurusan 	= mysql_query("select *from jurusan where id='$id'");

//$q2 = mysql_query("select *from guru");
$array 		 = mysql_fetch_array($q_jurusan);
$nama  		 = $array["nama"];
$keterangan  = $array["keterangan"];

if($_SESSION["admin"]){
?>

<body>
				<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Jurusan <?php print $nama;?></a></li>
						
					</ul>
					
					<h2>Master Jurusan</h2>
				</div>
				<div class="box-body clear">
			<!-- Custom Forms -->
					<div id="forms">
						<form onsubmit="o();" action="master/proses/Master_Jurusan.php"<?php } ?>  method="post" class="form"  enctype="multipart/form-data">
						<input type='hidden' name='id' value='<?php print $array['id']?>'/>
						<input type='hidden' name='include' value='edit'/>
							<?php if($_SESSION["admin"]){?>
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Kode Jurusan: <span class="required">*</span></label>
								<input type="text" id="nama" class="text fl" name="nama"  value="<?php print $nama;?>"/><span class="required">&nbsp;&nbsp; (Contoh : TKJ)</span>
								
							</div>
							<div class="form-field clear">
								<label for="ket" class="form-label fl-space2">Nama Jurusan: <span class="required">*</span></label>
								<input type="text" id="ket" class="text fl" name="keterangan" value='<?php print $keterangan;?>' />
							</div>
							<!-- /.form-field -->
								<input type="hidden" name="id" value="<?php print $array["id"];?>"></input>
							
							
								<input type="submit" class="submit fr" value="Submit" /><br/><br/><a href="index.php?page=Master_Jurusan" class="submit fr">Cancel editing</a>
								
								
							</div><!-- /.form-field -->		
										
						</div>			
							
						</form>
						
					</div><!-- /#forms -->			
</script>
</body><?php
}
else {
								include("home.php");
							}
?>
