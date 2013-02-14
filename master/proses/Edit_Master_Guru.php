<?php
include("../conn/conn.php");
$id = $_GET['id'];
$query = mysql_query("select *from guru where No = '$id'");
$array = mysql_fetch_array($query);
?>
<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Guru</a></li>
						
					</ul>
					
					<h2>Master Guru</h2>
				</div>
				
				<div class="box-body clear">
					
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Guru.php" method="post" class="form"  enctype="multipart/form-data">
							
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">NIP: <span class="required">*</span></label>
								<input type="text" name="nip" value="<?php echo $array['nip'];?>" disabled />
								<input type="hidden" id="" class="text fl" name="nip" value="<?php print $array['nip']?>"  />
								
							</div>
							<div class="form-field clear">
								<label for="id_finger" class="form-label fl-space2">Finger ID: <span class="required">*</span></label>
								<input type="text"  value="<?php print $array['id_finger']?>" disabled />
								<input type="hidden" id="id_finger" class="text fl" name="id_finger" value="<?php print $array['id_finger']?>"  />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Nama: <span class="required">*</span></label>
								<input type="text" id="textfield" class="text fl" maxlength='22' name="nama" value="<?php echo $array['nama'];?>"/>
							</div><!-- /.form-field -->
							
							
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Password: <span class="required">*</span></label>
								<input type="password" id="textfield" class="text fl" name="pass" />
								
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Foto: <span class="required">*</span></label>
								<?php if($array["foto"] == "") {print"no image";} else{?><img src="master/foto/<?php print $array['foto'];?>" width="30" height="30"></img><?php }?>
								
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="file" class="form-label fl-space2">Unggah Foto:</label>
								<input type="file" id="file" class="form-file fl" name="foto" />
							</div><!-- /.form-field -->							
							<div class="form-field clear">
								<input type="hidden" name="id" value=<?php print $array["No"]; ?>>
								
								<input type="submit" class="submit fr" value="Submit" />
								
							</div><!-- /.form-field -->							
							<a href="index.php?page=Master_Guru" class="submit fr">Cancel editing</a>
						</form>
						
					</div><!-- /#forms -->
					
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</script>
</body>
