<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$q 	= mysql_query("select *from pengumuman where id='$id'");

//$q2 = mysql_query("select *from guru");
$array = mysql_fetch_array($q);


if($_SESSION["admin"]){
?>

<body>
				<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Pengumuman</a></li>
						
					</ul>
					
					<h2>Master Pengumuman</h2>
				</div>
				<div class="box-body clear">
			<!-- Custom Forms -->
					<div id="forms">
						<form onsubmit="o();" action="master/proses/Master_Pengumuman.php"<?php } ?>  method="post" class="form"  enctype="multipart/form-data">
						<input type='hidden' name='include' value='edit'/>
							<?php if($_SESSION["admin"]){?>
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Isi Pengumuman: <span class="required">*</span></label>
								<textarea type="text" id="keterangan" class="text fl" name="keterangan"  value="<? echo $array['isi'];?>" /><? echo STRIPSLASHES(TRIM($array['isi']))?></textarea>
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="absen" class="form-label fl-space2">Tanggal DiUmumkan: <span class="required">*</span></label>
								<input type="text" id="tanggal2" class="text fl" name="tanggal_mulai" value=<?php print $array["tanggal_mulai"];?>></input>
							</div>
							
							
								
								
								<input type="hidden" name="id2" value="<?php print $array["id"];?>"></input>
							
							
								<input type="submit" class="submit fr" value="Submit" /><br/><br/><a href="index.php?page=Master_Pengumuman" class="submit fr">Cancel editing</a>
								
								
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
