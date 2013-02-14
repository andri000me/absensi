<?php

$page = $_GET['page_siswa'];
if( !isset($_GET['page_siswa']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_siswa'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;


$kls = $_GET["kls"];
include("../conn/conn.php");
$q=mysql_query("select *from kelas,siswa where id=id_kelas");
$q2=mysql_query("select *from kelas where id=$kls");
$array=mysql_fetch_array($q2);
if($_SESSION["admin"]){
?>
<head>
<link rel="stylesheet" href="UniAdmin_files/tooltip2.css" type="text/css"></link>


</head>

</head>

<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#table">Table Siswa</a></li>
						<li><a href="#forms">Input Data Siswa</a></li>
						
					</ul>
					
					<h2>Master Siswa <?php print $array["Nama_Kelas"]; ?></h2>
				</div>
				
				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">
					<!------------------------------------------------------------------------->
						<?php
						if($kls > 0){ ?>
							<form method="post" action="index.php?page=Master_Siswa&kls=<?php echo $kls; ?>">
						<?php }else{ ?>
							<form method="post" action="index.php?page=Master_Siswa">
						<?php } ?>	
							<input type="text" class="text fl" name="txt_search" value='<?php print $txt_search;?>' maxlength='5'/>&nbsp;
								<select name="jenis_search">
									<option value="nis">NIS</option>
									<option value="id_finger">Finger</option>
									<option value="Nama_siswa">Nama</option>
								</select>&nbsp;
								<input type="submit" class="submit" value="Search"/>
							</form>	<p>
					<!------------------------------------------------------------------------->
						<form method="post"  action="master/proses/delete_all.php">
						<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>
									<!--<th><input type="checkbox" class="checkbox select-all" onclick="javacript:dell(this,5000);" id="cek"/></th>-->
									<th>NIS</th>
									<th>Finger</th>
									<th>Absen</th>
									<th>Nama</th>
									<?php
									if($kls > 0){
										print"";
									}
									else {
										print"<th>kelas</th>";
									}
									?>
									<th>Foto</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
							$txt_search = $_POST["txt_search"];
							if( $txt_search==""){
									$txt_search="";
									}
									else{
									$txt_search=$txt_search;
									}
							$jenis_search = $_POST["jenis_search"];
							if(!empty($txt_search)){
								if($kls > 0){
									$q3 = mysql_query("select *from siswa where id_kelas = '$kls' AND $jenis_search like '%$txt_search%' limit $offset, $rec_limit");
									$qc = mysql_query("select count(*) as tot3 from siswa where id_kelas = '$kls' AND $jenis_search like '%$txt_search%'");
								}
								else{
									$q3 = mysql_query("select *from kelas, siswa where kelas.id=siswa.id_kelas AND siswa.$jenis_search like '%$txt_search%' order by Nama_Kelas limit $offset, $rec_limit");
									$qc = mysql_query("select count(*) as tot3 from siswa where $jenis_search like '%$txt_search%'");
								}
							}
							else{
								if($kls > 0){
									$q3 = mysql_query("select *from siswa where id_kelas = '$kls' limit $offset, $rec_limit");
									$qc = mysql_query("select count(*) as tot3 from siswa where id_kelas = '$kls'");
								}
								else{
									$q3 = mysql_query("select *from kelas, siswa where kelas.id=siswa.id_kelas order by Nama_Kelas limit $offset, $rec_limit");
									$qc = mysql_query("select count(*) as tot3 from siswa");
								}
							}
							
							$apake = 1 ;
							while($row = mysql_fetch_array($q3)){
							?>
								<tr>
									<!--<td><input name="checkbox[]" type="checkbox" id="cek" onclick="javacript:dell(this,<?php print $apake; ?>);" value="<?php echo $row["id"]; ?>"></td>-->
									<td class='gatau' title="<div class=content-box'><div class='box-header1 clear'><h2><center>Info <?php print $row['Nama_siswa']?></center></h2></div><div class='box-body clear'><div id='table'><table width='900'><tr><th rowspan='7' title='foto siswa'><?php if($row['foto'] == ''){print 'tidak ada foto';} else{ ?><img src='master/foto-siswa/<?php print $row['foto']; ?>' width='120' height='150'></img><?php } ?></th><th colspan='2'><center>Profil Siswa</center></th></tr><tr><th>NIS</th><td><?php print $row["nis"];?></td></tr><tr><th>Nama Siswa</th><td><?php print $row["Nama_siswa"];?></td></tr><tr><th>Kelamin</th><td><?php print $row["kelamin"];?></td></tr><tr><th>Agama</th><td><?php print $row["agama"];?></td></tr><tr><th>Tempat Tanggal Lahir</th><td><?php print $row["tempat_lahir"]." ".$row["tgl_lahir"];?></td></tr><tr><th>Alamat</th><td><?php print $row["alamat"];?></td></tr></table></div></div></div></div>"><?php print $row["nis"];?></td>
									<td ><?php print $row["id_finger"];?></td>
									<td class='gatau' title="<div class=content-box'><div class='box-header1 clear'><h2><center>Info <?php print $row['Nama_siswa']?></center></h2></div><div class='box-body clear'><div id='table'><table width='900'><tr><th rowspan='7' title='foto siswa'><?php if($row['foto'] == ''){print 'tidak ada foto';} else{ ?><img src='master/foto-siswa/<?php print $row['foto']; ?>' width='120' height='150'></img><?php } ?></th><th colspan='2'><center>Profil Siswa</center></th></tr><tr><th>NIS</th><td><?php print $row["nis"];?></td></tr><tr><th>Nama Siswa</th><td><?php print $row["Nama_siswa"];?></td></tr><tr><th>Kelamin</th><td><?php print $row["kelamin"];?></td></tr><tr><th>Agama</th><td><?php print $row["agama"];?></td></tr><tr><th>Tempat Tanggal Lahir</th><td><?php print $row["tempat_lahir"]." ".$row["tgl_lahir"];?></td></tr><tr><th>Alamat</th><td><?php print $row["alamat"];?></td></tr></table></div></div></div></div>"><?php print $row["absen"];?></td>
									<td class='gatau' title="<div class=content-box'><div class='box-header1 clear'><h2><center>Info <?php print $row['Nama_siswa']?></center></h2></div><div class='box-body clear'><div id='table'><table width='900'><tr><th rowspan='7' title='foto siswa'><?php if($row['foto'] == ''){print 'tidak ada foto';} else{ ?><img src='master/foto-siswa/<?php print $row['foto']; ?>' width='120' height='150'></img><?php } ?></th><th colspan='2'><center>Profil Siswa</center></th></tr><tr><th>NIS</th><td><?php print $row["nis"];?></td></tr><tr><th>Nama Siswa</th><td><?php print $row["Nama_siswa"];?></td></tr><tr><th>Kelamin</th><td><?php print $row["kelamin"];?></td></tr><tr><th>Agama</th><td><?php print $row["agama"];?></td></tr><tr><th>Tempat Tanggal Lahir</th><td><?php print $row["tempat_lahir"]." ".$row["tgl_lahir"];?></td></tr><tr><th>Alamat</th><td><?php print $row["alamat"];?></td></tr></table></div></div></div></div>">
										<?php print $row["Nama_siswa"];?>
									</td>
									<?php
									if($kls > 0){
										print"";
									}
									else { ?>
										<td class='gatau' title="<div class=content-box'><div class='box-header1 clear'><h2><center>Info <?php print $row['Nama_siswa']?></center></h2></div><div class='box-body clear'><div id='table'><table width='900'><tr><th rowspan='7' title='foto siswa'><?php if($row['foto'] == ''){print 'tidak ada foto';} else{ ?><img src='master/foto-siswa/<?php print $row['foto']; ?>' width='120' height='150'></img><?php } ?></th><th colspan='2'><center>Profil Siswa</center></th></tr><tr><th>NIS</th><td><?php print $row["nis"];?></td></tr><tr><th>Nama Siswa</th><td><?php print $row["Nama_siswa"];?></td></tr><tr><th>Kelamin</th><td><?php print $row["kelamin"];?></td></tr><tr><th>Agama</th><td><?php print $row["agama"];?></td></tr><tr><th>Tempat Tanggal Lahir</th><td><?php print $row["tempat_lahir"]." ".$row["tgl_lahir"];?></td></tr><tr><th>Alamat</th><td><?php print $row["alamat"];?></td></tr></table></div></div></div></div>"><?php echo $row['Nama_Kelas']; ?></td>
									<?php	}
									?>
									
									<td>
										<?php
											if($row["foto"] == ""){
												print"tidak ada foto";
											}
											else{
										?>
										<img src="master/foto-siswa/<?php print $row['foto'];?>" width="30" height="30"></img>
										<?php } ?>
									</td>
									<td>
										<a href="?page=Edit_Master_Siswa&id=<?php print $row['id']?>"><img src="UniAdmin_files/ico_edit_16.png" class="icon16 fl-space2" alt="" title="edit" /></a>
										<a href="master/proses/Master_Siswa.php?id=<?php print $row['id']?>&delete=delete<?php if ($kls>0){print "&kls=".$kls; };?>" onclick="return confirm('Apakah anda ingin menghapus <?php echo $row["Nama_siswa"]; ?> ?')"><img src="UniAdmin_files/ico_delete_16.png" class="icon16 fl-space2" alt="" title="delete" /></a>
									</td>
								</tr>
							<?php
								$apake++;
									}
							?>
							<input type='hidden' id='textbox1' value=''/>
							</tbody>
						</table>
							<div class="dataTables_paginate paging_full_numbers">

							<span>
								<?php
								if($kls > 0){
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									for($i=1;$i<=$jumhal;$i++){
								?>
								<a href='index.php?page=Master_Siswa&page_siswa=<?php echo $i; ?>&kls=<?php echo $kls; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?php
									}
								}
								else{
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									for($i=1;$i<=$jumhal;$i++){
								?>
								<a href='index.php?page=Master_Siswa&page_siswa=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?php
									}
								}
								?>
							</span>
						
						</div>
						</div>
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="delete_all" value="siswa">
								</div>				
						</div>							
					
						</form>
					</div><!-- /#table -->
				
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Siswa.php" method="post" class="form"  enctype="multipart/form-data">
						<div class="form-field clear">
								<label for="nis" class="form-label fl-space2">NIS: <span class="required">*</span></label>
								<input type="text" id="nis" class="text fl" name="nis" /><span class="required">&nbsp; (Tidak bisa diubah / diedit)</span>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="id_finger" class="form-label fl-space2">Finger ID: <span class="required">*</span></label>
								<input type="text" id="id_finger" class="text fl" name="id_finger"  maxlength='5'/><span class="required">&nbsp; (Tidak bisa diubah / diedit)</span>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="absen" class="form-label fl-space2">Absen: <span class="required">*</span></label>
								<input type="text" id="absen" class="text fl" name="absen" />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Nama Siswa: <span class="required">*</span></label>
								<input type="text" id="nama" class="text fl" name="nama"maxlength='21' />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Nama Panggilan: <span class="required">*</span></label>
								<input type="text" id="nama" class="text fl" name="nama_panggilan" maxlength='10'/>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="kelamin" class="form-label fl-space2">Jenis Kelamin: <span class="required">*</span></label>
								<input type="radio" name="kelamin" id="kelamin" value="L" checked>Laki - Laki
								<input type="radio" name="kelamin" id="kelamin" value="P">Perempuan
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="password" class="form-label fl-space2">Password: <span class="required">*</span></label>
								<input type="password" id="password" class="text fl" name="password" />
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="tempat_lahir" class="form-label fl-space2">Tempat lahir: <span class="required">*</span></label>
								<input type="text" name="tempat_lahir" id="tempat_lahir" class="text fl"/>
								
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Tanggal Lahir: <span class="required">*</span></label>
								<input id="tanggal" type="text" name="tgllahir"></p>
	
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
								<textarea rows=3 cols=20 id="alamat_ortu" class="text fl" name="alamat"> </textarea>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Kelas: <span class="required">*</span></label>
								<?php 
						
									
									if($kls > 0){
										$query = mysql_query("select *from kelas where id='$kls'");
										$row = mysql_fetch_array($query);
										print "<label class='form-label fl-space2'>&nbsp; <b>".$row['Nama_Kelas']."</b></label>
									
										";
									
									
										
									}
									else {
										$query = mysql_query("select *from kelas order by Nama_Kelas");
										echo "<select class='choose' name='kelas'>";
										while($row = mysql_fetch_array($query)){
											echo "<option  value=".$row["id"].">".$row['Nama_Kelas']."</option> ";
											}
										echo "</select>";
									}
								?>
								
							</div>
							
							<div class="form-field clear">
								<label for="file" class="form-label fl-space2">Unggah Foto:</label>
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
								?>
								<input type="submit" class="submit fr" value="Submit" />
							</div><!-- /.form-field -->																								
						</form>
					</div><!-- /#forms -->
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</script>
</body>
<?php
}
else {
								include("home.php");
							}
?>
