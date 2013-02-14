<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$q 	= mysql_query("select *from siswa where id='$id'");

//$q2 = mysql_query("select *from guru");
$array = mysql_fetch_array($q);
$tempat_lahir=$array['tempat_lahir'];
$nama_panggilan=$array['nama_panggilan'];
$klssiswa = $array["id_kelas"];
$tahun = $_POST["tahun"];
$ttl = $array["tgl_lahir"];
$hari = strtok($ttl, " ");
$bulan = strtok(" ");
$tahun = strtok(" ");
$agama = $array["agama"];

if($_SESSION["admin"]){
?>

<body>
				<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Siswa <?php print $array["Nama_siswa"];?> </a></li>
						
					</ul>
					
					<h2>Master Siswa</h2>
				</div>
				<div class="box-body clear">
			<!-- Custom Forms -->
					<div id="forms">
						<form onsubmit="o();" <?php if($_SESSION["admin"]){?> action="master/proses/Master_Siswa.php"<?php } ?> <?php if($_SESSION["user"]){?> action="master/proses/Master_Siswa2.php"<?php } ?> method="post" class="form"  enctype="multipart/form-data">
						<input type='hidden' name='id' value='<?php print $array['id']?>'/>
						<input type='hidden' name='include' value='edit'/>
							<?php if($_SESSION["admin"]){?>
							
							<div class="form-field clear">
								<label for="nis" class="form-label fl-space2">NIS: <span class="required">*</span></label>
								<input type="text"  value="<?php print $array['nis']?>" disabled />
								<input type="hidden" id="nis" class="text fl" name="nis" value="<?php print $array['nis']?>"  />
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="id_finger" class="form-label fl-space2">Finger ID: <span class="required">*</span></label>
								<input type="text"  value="<?php print $array['id_finger']?>" disabled />
								<input type="hidden" id="id_finger" class="text fl" name="id_finger" value="<?php print $array['id_finger']?>"  />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="absen" class="form-label fl-space2">Absen: <span class="required">*</span></label>
								<input type="text" id="absen" class="text fl" name="absen" value="<?php print $array['absen']?>"/>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Nama Siswa: <span class="required">*</span></label>
								<input type="text" id="nama" class="text fl" name="nama" maxlength='21' value="<?php print $array['Nama_siswa']?>"/>
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Nama Panggilan: <span class="required">*</span></label>
								<input type="text" id="nama" class="text fl" name="nama_panggilan"  value="<?php print $nama_panggilan;?>"/>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="kelamin" class="form-label fl-space2">Jenis Kelamin: <span class="required">*</span></label>
								<?php 

									if($array["kelamin"] == "L")
									{
										echo "
										<input type=radio name=kelamin value=L checked>Laki - Laki
										<input type=radio name=kelamin value=P>Perempuan
										";
									}
									else if($array["kelamin"] == "P")
									{
										echo "
										<input type=radio name=kelamin value=L>Laki - Laki
										<input type=radio name=kelamin value=P checked>Perempuan
										";
									}
								?>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="tempat_lahir" class="form-label fl-space2">Tempat lahir: <span class="required">*</span></label>
								<select name="tempat_lahir">
								<option value="<?php echo $tempat_lahir; ?>" selected='true'> <?php echo $tempat_lahir; ?></option>
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
								<label for="textfield" class="form-label fl-space2">Tanggal Lahir: <span class="required">*</span></label>
								<input id="tanggal" type="text" name="tgllahir" value="<?php print $array['tgl_lahir'];?>"></p>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="agama" class="form-label fl-space2">Agama: <span class="required">*</span></label>
								<select name="agama">
									<option value='Islam' <?php if($agama == "Islam")echo "selected='true'";?>>Islam</option>
									<option value='Kristen Katolik' <?php if($agama == "Kristen Katolik")echo "selected='true'";?>>Kristen Katolik</option>
									<option value='Kristen Protestan' <?php if($agama == "Kristen Protestan")echo "selected='true'";?>>Kristen Protestan</option>
									<option value='Budha' <?php if($agama == "Budha")echo "selected='true'";?>>Budha</option>
									<option value='Hindu' <?php if($agama == "Hindu")echo "selected='true'";?>>Hindu</option>
								</select>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="alamat_ortu" class="form-label fl-space2">Alamat: </label>
								<textarea type="text" id="alamat" class="text fl" name="alamat"  value="<? echo $array['alamat'];?>" /><? echo STRIPSLASHES(TRIM($array['alamat']))?></textarea>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2" onclick='ar();' id="ubah">Ubah Password</label>
							</div>
							<?php } ?>
	
							<div class="form-field clear" <?php if($_SESSION["admin"]){?>id="ab"<?php } ?>>
								<label for="password" class="form-label fl-space2">Password Baru: <span class="required">*</span></label>
								<input type="password" id="password" class="text fl" name="password" />
							</div><!-- /.form-field -->
							
							
							
							<?php if($_SESSION["admin"]){?>
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Kelas: <span class="required">*</span></label>
								<?php 
						
									
									if($kls > 0){
										$query = mysql_query("select *from kelas where id='$kls'");
										$row = mysql_fetch_array($query);
										print "&nbsp; <b>".$row['Nama_Siswa']."</b>";
									}
									else {
										$query2 = mysql_query("select *from kelas where id = '$klssiswa' ");
										$row2 = mysql_fetch_array($query2);
										echo "<select class='choose' name='kelas'>
										
												<option  value=".$row2["id"].">".$row2['Nama_Kelas']."</option> ";
										$query = mysql_query("select *from kelas order by Nama_Kelas");
										while($row = mysql_fetch_array($query)){
											echo "<option  value=".$row["id"].">".$row['Nama_Kelas']."</option> ";
											}
										echo "</select>";
									}
								?>
								
							</div>
							
							<div class="form-field clear" id="ab2">
								<label for="file" class="form-label fl-space2" >Unggah Foto:</label>
								<input type="file" id="file" class="form-file fl" name="foto" />
							</div><!-- /.form-field -->	
							
							<div class="form-field clear">
								<?php
									if($kls > 0){
										print"<input type='hidden' class='submit fr' name='idkls' value='$kls'/>
										";
									}
									//else{
									//	print"<input type='submit' class='submit fr' value='Submit'/>";
									//}
								}
								?>
								<input type="submit" class="submit fr" value="Submit" />
								
							</div><!-- /.form-field -->		
							<a href="index.php?page=Master_Siswa" class="submit fr">Cancel editing</a>
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
