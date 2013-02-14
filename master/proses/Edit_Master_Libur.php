<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$q 	= mysql_query("select *from hari_libur where id='$id'");

//$q2 = mysql_query("select *from guru");
$array = mysql_fetch_array($q);


if($_SESSION["admin"]){
?>
<style>
	#ul1{
		float:left; padding:0; margin-top:20px;
	}
	#ul1 .li1{
		float:left; padding:0; margin-right:70px;
	}
	#ul li{
		margin-top:5px;	font-size:12px;
	}
</style>
<body>
				<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Hari Libur</a></li>
						
					</ul>
					
					<h2>Master Libur</h2>
				</div>
				<div class="box-body clear">
			<!-- Custom Forms -->
					<div id="forms">
						<form onsubmit="o();" action="master/proses/Master_Libur.php"<?php } ?>  method="post" class="form"  enctype="multipart/form-data">
						<input type='hidden' name='include' value='edit'/>
							<?php if($_SESSION["admin"]){?>
							
							<div class="form-field clear">
								<label for="nama" class="form-label fl-space2">Keterangan: <span class="required">*</span></label>
								<textarea type="text" id="keterangan" class="text fl" name="keterangan"  value="<? echo $array['keterangan'];?>" /><? echo STRIPSLASHES(TRIM($array['keterangan']))?></textarea>
							</div><!-- /.form-field -->
							<div class="form-field clear">
								<label for="absen" class="form-label fl-space2">Tanggal Mulai: <span class="required">*</span></label>
								<input type="text" id="tanggal2" class="text fl" name="tanggal_mulai" value=<?php print $array["tanggal_mulai"];?>></input>
							</div>
							
							<div class="form-field clear">
								<label for="absen" class="form-label fl-space2">Tanggal Akhir: <span class="required">*</span></label>
								<input type="text" id="tanggal3" class="text fl" name="tanggal_akhir" value=<?php print $array["tanggal_akhir"];?>></input>
							</div>	
							<div class="form-field clear">
								<label for="tipe" class="form-label fl-space2">Tipe : <span class="required">*</span></label>
								<select name='tipe' id='tipe' onchange='oo(this.value);'>
									<option value='sekolah'>Sekolah</option>
									<option value='kelas'>Kelas</option>
								</select>
							</div>
							<script>
							var idList = document.getElementById('id_kelas').value;
								function oo(a){
									if(a=="kelas"){
										//document.getElementById("kelas2").style.display='none';
										document.getElementById("kelas").style.display='block';
										idList = document.getElementById('id_kelas').value;
									}
									else if(a=="sekolah"){
										document.getElementById("kelas").style.display='none';
										//document.getElementById("kelas2").style.display='none';
									}
								}
								
								
								//document.getElementById('id_kelas').value = idList;
								
								  function dell(cek,id) {
										 //document.getElementById('id_kelas').value = id;
									if (document.getElementById(cek).checked == 1) {
									  idList = idList + id + ','
									  document.getElementById('id_kelas').value = idList;
									  
									}

									if (document.getElementById(cek).checked == 0) {
									  var v;
									  v = ',' + id + ','
									  idList = idList.replace(v, ',');
									  document.getElementById('id_kelas').value = idList;
									}

									

								}
								
								function aaaa(){
									alert(document.getElementById('id_kelas').value);
								}
							</script>
							<div id='kelas' style='display:none;'>
								<?php
									$q_libur = mysql_query("select *from hari_libur where id_kelas like '%$idkelas,%' and id='".$array["id"]."'");
									$a_libur = mysql_fetch_array($q_libur);
								?>
								<input type='hidden' onclick='aaaa();' name='id_kelas' id='id_kelas' value='<?php print $a_libur["id_kelas"];?>'></input>
								<ul id='ul1'>
									<li class='li1'>Kelas <b>X</b>
										<ul>
										<?php
											$q_kelas = mysql_query("select *from kelas where Nama_Kelas like '%X-%' order by Nama_Kelas") or die (mysql_error());
											while($a_kelas = mysql_fetch_array($q_kelas)){
												$namakelas = $a_kelas['Nama_Kelas'];
												$idkelas   = $a_kelas['id'];
												$q_liburbykelas = mysql_query("select *from hari_libur where id_kelas like '%$idkelas,%' and id='".$array["id"]."'");
												$a_liburbykelas = mysql_fetch_array($q_liburbykelas);
												if(!empty($a_liburbykelas)){
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);' checked></input>$namakelas</li>";
												}else{
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
												}
											}
										?>
										</ul>
									</li>
									<li class='li1'>Kelas <b>XI</b>
										<ul>
										<?php
											$q_kelas = mysql_query("select *from kelas where Nama_Kelas like '%XI-%' order by Nama_Kelas") or die (mysql_error());
											while($a_kelas = mysql_fetch_array($q_kelas)){
												$namakelas = $a_kelas['Nama_Kelas'];
												$idkelas   = $a_kelas['id'];
												$q_liburbykelas = mysql_query("select *from hari_libur where id_kelas like '%$idkelas,%' and id='".$array["id"]."'");
												$a_liburbykelas = mysql_fetch_array($q_liburbykelas);
												if(!empty($a_liburbykelas)){
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);' checked></input>$namakelas</li>";
												}else{
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
												}
											}
										?>
										</ul>
									</li>
									<li class='li1'>Kelas <b>XII</b>
										<ul>
										<?php
											$q_kelas = mysql_query("select *from kelas where Nama_Kelas like '%XII-%' order by Nama_Kelas") or die (mysql_error());
											while($a_kelas = mysql_fetch_array($q_kelas)){
												$namakelas = $a_kelas['Nama_Kelas'];
												$idkelas   = $a_kelas['id'];
												$q_liburbykelas = mysql_query("select *from hari_libur where id_kelas like '%$idkelas,%' and id='".$array["id"]."'x`x`");
												$a_liburbykelas = mysql_fetch_array($q_liburbykelas);
												if(!empty($a_liburbykelas)){
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);' checked></input>$namakelas</li>";
												}else{
													print "<li><input type='checkbox' id='$idkelas' value='$idkelas' onclick='dell(this.id,this.value);'></input>$namakelas</li>";
												}
											}
										?>
										</ul>
									</li>
								</ul>	
							</div>
								<input type="hidden" name="id2" value="<?php print $array["id"];?>"></input>
							
							
								<ul><input type="submit" class="submit fr" value="Submit" /><br/><br/><a href="index.php?page=Master_Libur" class="submit fr">Cancel editing</a>
								
								
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
