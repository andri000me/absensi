<?php
include("../conn/conn.php");
//--------------------------------------------------------------------
$page = $_GET['page_kelas'];
if( !isset($_GET['page_kelas']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_kelas'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;
//--------------------------------------------------------------------
$txt_search = $_GET["txt_search"];
if( $txt_search==""){
$txt_search="";
}
else{
$txt_search=$txt_search;
}
$jenis_search = $_GET["jenis_search"];
if(!empty($txt_search)){
	$q = mysql_query("select *from kelas where $jenis_search like '%$txt_search%' order by Nama_Kelas limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from kelas where $jenis_search like '%$txt_search%'");
}else{
	$q = mysql_query("select *from kelas order by Nama_Kelas limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from kelas");
}
	$q2 = mysql_query("select *from guru");
	$q_jurusan = mysql_query("select *from jurusan order by nama");
	$q_jurusan2 = mysql_query("select *from jurusan order by nama");
//$row=mysql_fetch_array($q);
//$row1 = $row;
if($_SESSION["admin"]){
?>

<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#table">Table Kelas</a></li>
						<li><a href="#forms">Input Data Kelas</a></li>
						
					</ul>
					
					<h2>Master Kelas</h2>
				</div>
				
				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">					
					<!------------------------------------------------------------------------->
							<form method="GET" action="index.php">	
							<input type="hidden" name="page" value="Master_Kelas">
							<input type="text" class="text fl" name="txt_search" value='<?php print $txt_search;?>' maxlength='5'/>&nbsp;
								<select name="jenis_search">
									<option value="Nama_Kelas">Nama</option>
								</select>&nbsp;
								<input type="submit" class="submit" value="Search"/>
							</form>	<p>
					<!------------------------------------------------------------------------->
						<form method="post" action="master/proses/delete_all.php">
						<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>
									<th><input type="checkbox" class="checkbox select-all" onclick="javacript:dell(this,5000);" id="cek"/></th>
									<th>Nama Kelas</th>
									<th>Wali Kelas</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
							$apake = 1 ;
							
							// if( isset($_GET{'page_kelas'} ) ){
								// $apake =  $rec_limit * $_GET{'page_kelas'};
							// }
								while($row=mysql_fetch_array($q)){
									$namakelas = $row["Nama_Kelas"];
							?>
								<tr>
									<td><input name="checkbox[]" type="checkbox" id="cek" onclick="javacript:dell(this,<?php print $apake; ?>);" value="<?php echo $row["id"]; ?>"></td>
							
									<td><?php print $row['Nama_Kelas'];?></td>
									<td><?php
										$id_guru=$row["id_guru"];
										$guru_query=mysql_query("select*from guru where No='$id_guru'");
										$array_guru=mysql_fetch_array($guru_query);
										echo $array_guru["nama"];
										?>
									</td>
										
									<td>
										<a href="?page=Edit_Master_Kelas&id=<?php print $row['id']?>&id_guru=<?php print $row['id_guru'];?>"><img src="UniAdmin_files/ico_edit_16.png" class="icon16 fl-space2" alt="" title="edit" /></a>
										<a href="master/proses/Master_Kelas.php?id=<?php print $row['id']?>&delete=delete" onclick="return confirm('Apakah anda ingin menghapus kelas <?php print $namakelas; ?>?')"><img src="UniAdmin_files/ico_delete_16.png" class="icon16 fl-space2" alt="" title="delete" /></a>
									</td>
								</tr>
								
							<?php
							
								}
								
							?>
					
							<input type='hidden' id='textbox1' value=''/>
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
										<a href='index.php?page=Master_Kelas&page_kelas=<?php echo $i; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}else{
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Kelas&page_kelas=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}
								?>
							</span>
							
						</div>
						</div>
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="delete_all" value="kelas">
								<input disabled type="submit" onclick="return confirm('Are You Sure ?')" value="Delete All Checked" id="submit2" class="submit fl-space" name="delete"/></div>		
							</div>							
						
						</form>
						
					</div><!-- /#table -->
					
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Kelas.php" method="post" class="form"  enctype="multipart/form-data">
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Jurusan <span class="required">*</span></label>
								<select  name="jurusan">
								
									<?php
										while($row_jurusan=mysql_fetch_array($q_jurusan)){
										$nama=$row_jurusan["nama"];
										$id22=$row_jurusan["id"];
										print "<option value='$id22'>$nama</option>";
										
										}?>
								</select>	

								
								
							</div><!-- /.form-field -->
								<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Kelas <span class="required">*</span></label>
								<select name="kelas">
									<script>
										
										for(kelas = 1; kelas < 4; kelas++){
											document.write("<option value="+kelas+">"+kelas+"</option>");
										}
										
									</script>
								</select>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Wali Kelas: <span class="required">*</span></label>
								<select name="guru">
									<?php
										while($row2=mysql_fetch_array($q2)){
											print"<option value=".$row2["No"].">".$row2["nama"]."</option>";
										}
									?>
								</select>
								
							</div><!-- /.form-field -->
							<div>
							<div class="form-field clear">
							<label onclick="p3()"><h3><span class="required">•Pengaturan Waktu 'In Out'</span></h3></label>
							<div id='in_out'>
							<div class='form-field clear' id="p_3"><span class="required"> SENIN</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Mon">
									<?php
										//int $a;
										for($a=0;$a<24;$a++){
									?>
										<option value=<?php print $a; ?> <?php if($a==$jam_masuk_senin){print "selected='true'";} ?>><?php print $a; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Mon">
									<?php
										for($b=0;$b<60;$b++){
									?>
											<option value=<?php print $b; ?><?php if($b==$menit_masuk_senin){print " selected='true'";}?> ><?php print $b;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Mon">
									<?php
										//int $a;
										for($a_out=0;$a_out<24;$a_out++){
									?>
										<option value=<?php print $a_out; ?> <?php if($a_out==$jam_pulang_senin){print "selected='true'";} ?>><?php print $a_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Mon">
									<?php
										for($b_out=0;$b_out<60;$b_out++){
									?>
											<option value=<?php print $b_out; ?><?php if($b_out==$menit_pulang_senin){print " selected='true'";}?> ><?php print $b_out;?></option>
									<?php
										}
									?>
								</select>
								<input type='hidden' value='Mon' id='Mon'></input>
								<br><br><br>
							</div>
							<div class='form-field clear' id="p_3"><span class="required"> SELASA</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Tue">
									<?php
										//int $a;
										for($aa=0;$aa<24;$aa++){
									?>
										<option value=<?php print $aa; ?> <?php if($aa==$jam_masuk_selasa){print "selected='true'";} ?>><?php print $aa; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Tue">
									<?php
										for($bb=0;$bb<60;$bb++){
									?>
											<option value=<?php print $bb; ?><?php if($bb==$menit_masuk_selasa){print " selected='true'";}?> ><?php print $bb;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Tue">
									<?php
										//int $a;
										for($aa_out=0;$aa_out<24;$aa_out++){
									?>
										<option value=<?php print $aa_out; ?> <?php if($aa_out==$jam_pulang_selasa){print "selected='true'";} ?>><?php print $aa_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Tue">
									<?php
										for($bb_out=0;$bb_out<60;$bb_out++){
									?>
											<option value=<?php print $bb_out; ?><?php if($bb_out==$menit_pulang_selasa){print " selected='true'";}?> ><?php print $bb_out;?></option>
									<?php
										}
									?>
								</select>
								<br><br><br>
								<input type='hidden' value='Tue' id='Tue'></input>
							</div>
							<div class='form-field clear' id="p_3"><span class="required"> RABU</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Wed">
									<?php
										//int $a;
										for($a3=0;$a3<24;$a3++){
									?>
										<option value=<?php print $a3; ?> <?php if($a3==$jam_masuk_rabu){print "selected='true'";} ?>><?php print $a3; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Wed">
									<?php
										for($b3=0;$b3<60;$b3++){
									?>
											<option value=<?php print $b3; ?><?php if($b3==$menit_masuk_rabu){print " selected='true'";}?> ><?php print $b3;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Wed">
									<?php
										//int $a;
										for($a3_out=0;$a3_out<24;$a3_out++){
									?>
										<option value=<?php print $a3_out; ?> <?php if($a3_out==$jam_pulang_rabu){print "selected='true'";} ?>><?php print $a3_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Wed">
									<?php
										for($b2_out=0;$b2_out<60;$b2_out++){
									?>
											<option value=<?php print $b2_out; ?><?php if($b_out==$menit_pulang_rabu){print " selected='true'";}?> ><?php print $b2_out;?></option>2
									<?php
										}
									?>
								</select>
								<br><br><br>
								<input type='hidden' value='Wed' id='Wed'></input>
							</div>
							<div class='form-field clear' id="p_3"><span class="required"> KAMIS</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Thu">
									<?php
										//int $a;
										for($a4=0;$a4<24;$a4++){
									?>
										<option value=<?php print $a4; ?> <?php if($a4==$jam_masuk_kamis){print "selected='true'";} ?>><?php print $a4; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Thu">
									<?php
										for($b4=0;$b4<60;$b4++){
									?>
											<option value=<?php print $b4; ?><?php if($b4==$menit_masuk_kamis){print " selected='true'";}?> ><?php print $b4;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Thu">
									<?php
										//int $a;
										for($a4_out=0;$a4_out<24;$a4_out++){
									?>
										<option value=<?php print $a4_out; ?> <?php if($a4_out==$jam_pulang_kamis){print "selected='true'";} ?>><?php print $a4_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Thu">
									<?php
										for($b4_out=0;$b4_out<60;$b4_out++){
									?>
											<option value=<?php print $b4_out; ?><?php if($b4_out==$menit_pulang_kamis){print " selected='true'";}?> ><?php print $b4_out;?></option>
									<?php
										}
									?>
								</select>
								<br><br><br>
								<input type='hidden' value='Thu' id='Thu'></input>
							</div>
							<div class='form-field clear' id="p_3"><span class="required"> JUM'AT</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Fri">
									<?php
										//int $a;
										for($a5=0;$a5<24;$a5++){
									?>
										<option value=<?php print $a5; ?> <?php if($a5==$jam_masuk_jumat){print "selected='true'";} ?>><?php print $a5; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Fri">
									<?php
										for($b5=0;$b5<60;$b5++){
									?>
											<option value=<?php print $b5; ?><?php if($b5==$menit_masuk_jumat){print " selected='true'";}?> ><?php print $b5;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Fri">
									<?php
										//int $a;
										for($a5_out=0;$a5_out<24;$a5_out++){
									?>
										<option value=<?php print $a5_out; ?> <?php if($a5_out==$jam_pulang_jumat){print "selected='true'";} ?>><?php print $a5_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Fri">
									<?php
										for($b5_out=0;$b5_out<60;$b5_out++){
									?>
											<option value=<?php print $b5_out; ?><?php if($b5_out==$menit_pulang_jumat){print " selected='true'";}?> ><?php print $b5_out;?></option>
									<?php
										}
									?>
								</select>
								<br><br><br>
								<input type='hidden' value='Fri' id='Fri'></input>
							</div>
							<div class='form-field clear' id="p_3"><span class="required"> SABTU</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Sat">
									<?php
										//int $a;
										for($a6=0;$a6<24;$a6++){
									?>
										<option value=<?php print $a6; ?> <?php if($a6==$jam_masuk_sabtu){print "selected='true'";} ?>><?php print $a6; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Sat">
									<?php
										for($b6=0;$b6<60;$b6++){
									?>
											<option value=<?php print $b6; ?><?php if($b6==$menit_masuk_sabtu){print " selected='true'";}?> ><?php print $b6;?></option>
									<?php
										}
									?>
								</select>
								
							</div>
							<div class='form-field clear' id="p_3_1">
								<label for='' class='form-label fl-space2'>Waktu Pulang :<span class="required">*</span></label>
								Jam : <select name="jam_pulang_Sat">
									<?php
										//int $a;
										for($a6_out=0;$a6_out<24;$a6_out++){
									?>
										<option value=<?php print $a6_out; ?> <?php if($a6_out==$jam_pulang_sabtu){print "selected='true'";} ?>><?php print $a6_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Sat">
									<?php
										for($b6_out=0;$b6_out<60;$b6_out++){
									?>
											<option value=<?php print $b6_out; ?><?php if($b6_out==$menit_pulang_sabtu){print " selected='true'";}?> ><?php print $b6_out;?></option>
									<?php
										}
									?>
								</select>
								<br><br><br>
								</div>
							
								<input type='hidden' value='Sat' id='Sat'></input>
							</div>
							</div>
							<div class="form-field clear">
								<input type="submit" class="submit fr" value="Submit" />
							</div><!-- /.form-field -->
						</form>
					</div><!-- /#forms -->
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</body>
<?php
}
else {
								include("home.php");
							}
?>
