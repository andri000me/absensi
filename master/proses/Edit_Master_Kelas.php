<?php
include("../../conn/conn.php");
$id	= $_GET["id"];
$id_guru = $_GET["id_guru"];
$q 	= mysql_query("select *from kelas where id='$id'");
$q2 = mysql_query("select *from guru");
$q3 = mysql_query("select *from kelas where id_guru = '$id_guru' ");
$array = mysql_fetch_array($q);
$array_id_guru = mysql_fetch_array($q3);
$id_guru2 = $array_id_guru["id_guru"];
$days 	= Array("Mon","Tue","Wed","Thu","Fri","Sat");
$jam_masuk = Array();
$menit_masuk = Array();
$jam_pulang = Array();
$menit_pulang = Array();

for($ay=0;$ay<=5;$ay++){
$waktu 				= $array["$days[$ay]"];
$pecah				= strtok($waktu, " ");
$masuk				= strtok($pecah, "-");
$pulang				= strtok("-");

$pecah2 			= strtok($masuk," ");
$jam_masuk[$ay]		= strtok($pecah2, ":");
$menit_masuk[$ay]	= strtok(":");
$masuk_detik		= strtok(":");

$pecah3 			= strtok($pulang," ");
$jam_pulang[$ay]	= strtok($pecah3, ":");
$menit_pulang[$ay]	= strtok(":");
$pulang_detik		= strtok(":");


}		
			
?>

<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						
						<li><a href="#forms">Edit Data Kelas</a></li>
						
					</ul>
					
					<h2>Edit Kelas <?php print $array["Nama_Kelas"];?></h2>
				</div>
					<div class="box-body clear">
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Kelas.php" method="post" class="form"  enctype="multipart/form-data">
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Kelas <span class="required">*</span></label>
								<?php
									print "&nbsp; <b>".$array["Nama_Kelas"]."</b>";
								?>
								
							</div><!-- /.form-field -->
								
							
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Wali Kelas: <span class="required">*</span></label>
								<select name="guru">
									<?php
										while($row2=mysql_fetch_array($q2)){
										$no = $row2["No"];
									?>		
									<option value="<?php print $row2["No"];?>" <?php if($no == $id_guru2){print "selected='true'";}?>><?php print $row2["nama"];?></option>
									<?php
										}
									?>
								</select>
								
							</div><!-- /.form-field -->
					
						<label onclick="p3()"><h3><span class="required">•Pengaturan Waktu 'In Out'</span></h3></label>
							<div id='in_out'>
							<div class='form-field clear' id="p_3"><span class="required"> SENIN</span><br>
								 <label for='' class='form-label fl-space2'>Waktu Masuk :<span class="required">*</span></label>
								Jam : <select name="jam_masuk_Mon">
									<?php
										//int $a;
										for($a=0;$a<24;$a++){
									?>
										<option value=<?php print $a; ?> <?php if($a==$jam_masuk[0]){print "selected='true'";} ?>><?php print $a; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Mon">
									<?php
										for($b=0;$b<60;$b++){
									?>
											<option value=<?php print $b; ?><?php if($b==$menit_masuk[0]){print " selected='true'";}?> ><?php print $b;?></option>
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
										<option value=<?php print $a_out; ?> <?php if($a_out==$jam_pulang[0]){print "selected='true'";} ?>><?php print $a_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Mon">
									<?php
										for($b_out=0;$b_out<60;$b_out++){
									?>
											<option value=<?php print $b_out; ?><?php if($b_out==$menit_pulang[0]){print " selected='true'";}?> ><?php print $b_out;?></option>
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
										<option value=<?php print $aa; ?> <?php if($aa==$jam_masuk[1]){print "selected='true'";} ?>><?php print $aa; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Tue">
									<?php
										for($bb=0;$bb<60;$bb++){
									?>
											<option value=<?php print $bb; ?><?php if($bb==$menit_masuk[1]){print " selected='true'";}?> ><?php print $bb;?></option>
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
										<option value=<?php print $aa_out; ?> <?php if($aa_out==$jam_pulang[1]){print "selected='true'";} ?>><?php print $aa_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Tue">
									<?php
										for($bb_out=0;$bb_out<60;$bb_out++){
									?>
											<option value=<?php print $bb_out; ?><?php if($bb_out==$menit_pulang[1]){print " selected='true'";}?> ><?php print $bb_out;?></option>
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
										<option value=<?php print $a3; ?> <?php if($a3==$jam_masuk[2]){print "selected='true'";} ?>><?php print $a3; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Wed">
									<?php
										for($b3=0;$b3<60;$b3++){
									?>
											<option value=<?php print $b3; ?><?php if($b3==$menit_masuk[2]){print " selected='true'";}?> ><?php print $b3;?></option>
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
										<option value=<?php print $a3_out; ?> <?php if($a3_out==$jam_pulang[2]){print "selected='true'";} ?>><?php print $a3_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Wed">
									<?php
										for($b2_out=0;$b2_out<60;$b2_out++){
									?>
											<option value=<?php print $b2_out; ?><?php if($b2_out==$menit_pulang[2]){print " selected='true'";}?> ><?php print $b2_out;?></option>2
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
										<option value=<?php print $a4; ?> <?php if($a4==$jam_masuk[3]){print "selected='true'";} ?>><?php print $a4; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Thu">
									<?php
										for($b4=0;$b4<60;$b4++){
									?>
											<option value=<?php print $b4; ?><?php if($b4==$menit_masuk[3]){print " selected='true'";}?> ><?php print $b4;?></option>
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
										<option value=<?php print $a4_out; ?> <?php if($a4_out==$jam_pulang[3]){print "selected='true'";} ?>><?php print $a4_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Thu">
									<?php
										for($b4_out=0;$b4_out<60;$b4_out++){
									?>
											<option value=<?php print $b4_out; ?><?php if($b4_out==$menit_pulang[3]){print " selected='true'";}?> ><?php print $b4_out;?></option>
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
										<option value=<?php print $a5; ?> <?php if($a5==$jam_masuk[4]){print "selected='true'";} ?>><?php print $a5; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Fri">
									<?php
										for($b5=0;$b5<60;$b5++){
									?>
											<option value=<?php print $b5; ?><?php if($b5==$menit_masuk[4]){print " selected='true'";}?> ><?php print $b5;?></option>
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
										<option value=<?php print $a5_out; ?> <?php if($a5_out==$jam_pulang[4]){print "selected='true'";} ?>><?php print $a5_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Fri">
									<?php
										for($b5_out=0;$b5_out<60;$b5_out++){
									?>
											<option value=<?php print $b5_out; ?><?php if($b5_out==$menit_pulang[4]){print " selected='true'";}?> ><?php print $b5_out;?></option>
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
										<option value=<?php print $a6; ?> <?php if($a6==$jam_masuk[5]){print "selected='true'";} ?>><?php print $a6; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_Sat">
									<?php
										for($b6=0;$b6<60;$b6++){
									?>
											<option value=<?php print $b6; ?><?php if($b6==$menit_masuk[5]){print " selected='true'";}?> ><?php print $b6;?></option>
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
										<option value=<?php print $a6_out; ?> <?php if($a6_out==$jam_pulang[5]){print "selected='true'";} ?>><?php print $a6_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_pulang_Sat">
									<?php
										for($b6_out=0;$b6_out<60;$b6_out++){
									?>
											<option value=<?php print $b6_out; ?><?php if($b6_out==$menit_pulang[5]){print " selected='true'";}?> ><?php print $b6_out;?></option>
									<?php
										}
									?>
								</select>
								<br><br><br>
						
							</div></div>
							<div class="form-field clear">
								<input type="hidden" class="submit fr" name="id" value="<?php print $id;?>" />
								<input type="submit" class="submit fr" value="Submit" />
								
							
							</div><!-- /.form-field -->
							<a href="index.php?page=Master_Kelas" class="submit fr">Cancel editing</a>
							
						</form>
						
					</div><!-- /#forms -->
		
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</script>
</body>
