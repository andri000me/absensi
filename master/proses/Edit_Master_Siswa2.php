<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$q 	= mysql_query("select *from siswa where id='$id'");
//$q2 = mysql_query("select *from guru");
$array = mysql_fetch_array($q);
$klssiswa = $array["id_kelas"]; //

						
?>

<body>
				<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Password</a></li>
						
					</ul>
					
					<h2>Edit Password  <?php print $array["Nama_siswa"];?> </h2>
				</div>
				<div class="box-body clear">
			<!-- Custom Forms -->
					<div id="forms">
						<form  action="master/proses/Master_Siswa2.php" method="post" class="form"  enctype="multipart/form-data">
						<input type='hidden' name='id' value='<?php print $array['id']?>'/>
						<input type='hidden' name='include' value='edit'/>
							
							<div class="form-field clear" >
								<label for="textfield" class="form-label fl-space2">Password baru: <span class="required">*</span></label>
								<input type="password" id="textfield2" class="text fl" name="password2" />
							</div><!-- /.form-field -->
							
								<input type="submit" class="submit fr" value="Submit" />
								<br><br>
								<a href="index.php?page=Master_Siswa" class="submit fr">Cancel editing</a>
							
							</div><!-- /.form-field -->		
								
						</div>							
						</form>
					
					</div><!-- /#forms -->			
</script>
</body>