<?php
include("../conn/conn.php");

$page = $_GET['page_karyawan'];
if( !isset($_GET['page_karyawan']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_karyawan'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;

$id = $_GET['id'];
$query = mysql_query("select *from karyawan where nup = '$id'");
if($_SESSION["admin"]){
?>
<script type="text/javascript">
  var idList = ";"
  document.getElementById('textbox1').value = idList;

  function dell(cek, id) {

    if (cek.checked == 1) {
      idList = idList + id + ";"
      document.getElementById('textbox1').value = idList;
    }

    if (cek.checked == 0) {
      var v;
      v = ";" + id + ";"
      idList = idList.replace(v, ";");
      document.getElementById('textbox1').value = idList;
    }

    if (idList == ";") {
      document.getElementById('submit2').disabled = true;
    } else {
      document.getElementById('submit2').disabled = false;
    }

  }

</script>
<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#table">Table Karyawan</a></li>
						<li><a href="#forms">Input Data Karyawan</a></li>
						
					</ul>
					
					<h2>Master Karyawan</h2>
				</div>
				
				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">			
					<!------------------------------------------------------------------------->
						<form method="GET" action="index.php">	
							<input type="hidden" name="page" value="Master_Karyawan">
							<input type="text" class="text fl" name="txt_search"  maxlength='5'/>&nbsp;
								<select name="jenis_search">
									<option value="nup">NUP</option>
									<option value="id_finger">Finger</option>
									<option value="nama">Nama</option>
								</select>&nbsp;
								<input type="submit" class="submit" value="Search"/>
						</form>	<p>
					<!------------------------------------------------------------------------->
						<form method="post" action="master/proses/delete_all.php">
						<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>
									
									<th>NUP</th>
									<th>Finger</th>
									<th>Nama</th>
									<th>Foto</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							
							<tbody>
							
							<?php
							//-------------------------------------------------------------------------------
							$txt_search = $_GET["txt_search"];
							$jenis_search = $_GET["jenis_search"];
							if(!empty($txt_search){
								$q = mysql_query("select *from karyawan where $jenis_search like '%$txt_search%' order by nama limit $offset, $rec_limit");
								$qc = mysql_query("select count(*) as tot3 from karyawan where $jenis_search like '%$txt_search%'");
							}else{
								$q = mysql_query("select *from karyawan order by nama limit $offset, $rec_limit");
								$qc = mysql_query("select count(*) as tot3 from karyawan");
							}
							$apake = 1 ;
							while($row = mysql_fetch_array($q)){
							?>
						
								<tr>
									
									<td><?php print $row["nup"];?></td>
									<td ><?php print $row["id_finger"];?></td>
									<td><?php print $row["nama"];?></td>
									<td><?php if($row["foto"] == "") {print"no image";} else{?><img src="master/foto-karyawan/<?php print $row['foto'];?>" width="30" height="30"></img><?php }?></td>
									<td>
										<a href="?page=Edit_Master_Karyawan&id=<?php print $row['id'];?>"><img src="UniAdmin_files/ico_edit_16.png" class="icon16 fl-space2" alt="" title="edit" /></a>
										<a href="master/proses_karyawan/delete.php?id=<?php print $row['id']?>&delete=delete" onclick="return confirm('Apakah anda ingin menghapus <?php echo $row["nama"]; ?> ?')"><img src="UniAdmin_files/ico_delete_16.png" class="icon16 fl-space2" alt="" title="delete" /></a>
									</td>
								</tr>
								<input type='hidden' id='textbox1' value=''/>
							<?php
								$apake++;}
							?>
							</tbody>
						</table>
						
						<div class="dataTables_paginate paging_full_numbers">

							<span>
								<?
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									if(!empty($txt_search)){
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Karyawan&page_karyawan=<?php echo $i; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}else{
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Karyawan&page_karyawan=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}
								?>
							</span>
						
						</div>
						</div>
						
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="delete_all" value="guru">
								</div>				
						</div>
						</form>
					</div><!-- /#table -->
					
					<!-- Custom Forms -->
						<div id="forms">
					`		<form action="master/proses_karyawan/add.php" method="post" class="form"  enctype="multipart/form-data">
								<div class="form-field clear">
									<label for="textfield" class="form-label fl-space2">NUP: <span class="required">*</span></label>
									<input type="text" id="textfield" class="text fl" name="nup" /><span class="required">&nbsp; (Tidak bisa diubah / diedit)</span>
								</div>
								<div class="form-field clear">
								<label for="id_finger" class="form-label fl-space2">Finger ID: <span class="required">*</span></label>
								<input type="text" id="id_finger" class="text fl" name="id_finger"  maxlength='5'/><span class="required">&nbsp; (Tidak bisa diubah / diedit)</span>
							</div><!-- /.form-field -->
								
								<div class="form-field clear">
									<label for="textfield" class="form-label fl-space2">Nama: <span class="required">*</span></label>
									<input type="text" id="textfield" class="text fl" name="nama" value='<?php echo $row['nama'];?>' />
								</div><!-- /.form-field -->
							
															<div class="form-field clear">
								<label for="tempat_lahir" class="form-label fl-space2">Tempat lahir: <span class="required">*</span></label>
								<input type="text" name="tempat_lahir" id="tempat_lahir" class="text fl"/>
								
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Tanggal Lahir: <span class="required">*</span></label>
								<input id="tanggal" type="text" name="tgllahir">
	
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
								<textarea rows=3 cols=20 id="alamat" class="text fl" name="alamat"> </textarea>
							</div><!-- /.form-field -->
							
								<?php /*<div class="form-field clear">
									<label for="textfield" class="form-label fl-space2">Mata Pelajaran: <span class="required">*</span></label>
									<input type="text" id="textfield" class="text fl" name="pass" />
								
									</div><!-- /.form-field -->*/
								?>
								<div class="form-field clear">
									<label for="file" class="form-label fl-space2">Unggah Foto:</label>
									<input type="file" id="file" class="form-file fl" name="foto" />
								</div><!-- /.form-field -->							
								<div class="form-field clear">
									<input type="submit" class="submit fr" value="Submit" />
								</div><!-- /.form-field -->																								
							</form>
							<!-- /#forms -->
						</div> <!-- end of box-body -->
				</div>
			</div> <!-- end of content-box -->			
</body>
<?php
}
else {
								include("home.php");
							}
?>
