<?php
include("../conn/conn.php");
$id = $_GET['id'];
$query = mysql_query("select *from karyawan where id = '$id'");
$array = mysql_fetch_array($query);
?>
<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Karyawan</a></li>
						
					</ul>
					
					<h2>Master Karyawan</h2>
				</div>
				
				<div class="box-body clear">
					
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses_karyawan/edit.php" method="post" class="form"  enctype="multipart/form-data">
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">NUP: <span class="required">*</span></label>
								<input type="text" id="textfield" class="text fl" name="nup" value="<?php echo $array['nup'];?>" disabled />
								<input type="hidden" id="nis" class="text fl" name="nup" value="<?php echo $array['nup'];?>" />
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="id_finger" class="form-label fl-space2">Finger ID: <span class="required">*</span></label>
								<input type="text"  value="<?php print $array['id_finger']?>" disabled />
								<input type="hidden" id="id_finger" class="text fl" name="id_finger" value="<?php print $array['id_finger']?>"  />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Nama: <span class="required">*</span></label>
								<input type="text" id="textfield" class="text fl" name="nama" maxlength='22' value="<?php echo $array['nama'];?>"/>
								
							</div>
							
							<div class="form-field clear">
								<label for="tempat_lahir" class="form-label fl-space2">Tempat lahir: </label>
								<select name="tempat_lahir">
								<option value="<?php  echo $array['tempat_lahir']; ?>" selected='true'> <?php echo $array['tempat_lahir']; ?></option>
								<?php $query_prov=mysql_query("select*from mp_kabkot order by id_kabkot");
								     
										while($array_prov=mysql_fetch_array($query_prov)){
										$kabkota=$array_prov['nama_kabkot'];
										?>
											<option value="<?php echo $array_prov['nama_kabkot']; ?>"> <?php echo $array_prov['nama_kabkot']; ?></option>
										
										<?php
										
										}
									  
								?>
								
								</select>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Tanggal Lahir: </label>
								<input id="tanggal" type="text" name="tgllahir" value="<?php print $array['tanggal_lahir'];?>">
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="agama" class="form-label fl-space2">Agama: </label>
								<select name="agama">
									<option value='Islam' <?php if($array['agama'] == "Islam")echo "selected='true'";?>>Islam</option>
									<option value='Kristen Katolik' <?php if($array['agama'] == "Kristen Katolik")echo "selected='true'";?>>Kristen Katolik</option>
									<option value='Kristen Protestan' <?php if($array['agama'] == "Kristen Protestan")echo "selected='true'";?>>Kristen Protestan</option>
									<option value='Budha' <?php if($array['agama'] == "Budha")echo "selected='true'";?>>Budha</option>
									<option value='Hindu' <?php if($array['agama'] == "Hindu")echo "selected='true'";?>>Hindu</option>
								</select>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="alamat_ortu" class="form-label fl-space2">Alamat: </label>
								<textarea type="text" id="alamat" class="text fl" name="alamat"  value="<? echo $array['alamat'];?>" /><? echo STRIPSLASHES(TRIM($array['alamat']))?></textarea>
							</div><!-- /.form-field -->
							
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Foto: </label>
								<?php if($array["foto"] == "") {print"no image";} else{?><img src="master/foto-karyawan/<?php print $array['foto'];?>" width="30" height="30"></img><?php }?>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="file" class="form-label fl-space2">Unggah Foto:</label>
								<input type="file" id="file" class="form-file fl" name="foto" />
							</div><!-- /.form-field -->							
							<div class="form-field clear">
								<input type="hidden" name="id" value=<?php print $array["id"]; ?>>
								
								<input type="submit" class="submit fr" value="Submit" />
								
								
							</div><!-- /.form-field -->							
							<a href="index.php?page=Master_Karyawan" class="submit fr">Cancel editing</a>					
						</form>
					</div><!-- /#forms -->
					
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</script>
</body>
