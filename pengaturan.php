<body>
<?php
include("conn/conn.php");
$q	=	mysql_query("select *from title");
$array=mysql_fetch_array($q);
$q2	=	mysql_query("select *from fp where id='1'");
$array2=mysql_fetch_array($q2);

$q_fp	=	mysql_query("select *from fp where id='2'");
$a_fp   =   mysql_fetch_array($q_fp);

$q_fp3	=	mysql_query("select *from fp where id='3'");
$a_fp3   =   mysql_fetch_array($q_fp3);

$q_fp4	=	mysql_query("select *from fp where id='4'");
$a_fp4   =   mysql_fetch_array($q_fp4);

$q_fp5	=	mysql_query("select *from fp where id='5'");
$a_fp5   =   mysql_fetch_array($q_fp5);
//-------------------------------------------------------------------------------------------------------------
$q_jam_senin = mysql_query("select *from waktu_telat where hari='Mon'");
$a_jam_senin = mysql_fetch_array($q_jam_senin);
$waktu_masuk_senin = $a_jam_senin["waktu"];
$jam_masuk_senin   = $a_jam_senin["jam"];
$menit_masuk_senin = $a_jam_senin["menit"];
$detik_masuk_senin = $a_jam_senin["detik"];
$waktu_pulang_senin = $a_jam_senin["waktu_pulang"];
$jam_pulang_senin   = $a_jam_senin["jam_pulang"];
$menit_pulang_senin = $a_jam_senin["menit_pulang"];
$detik_pulang_senin = $a_jam_senin["detik_pulang"];

$q_jam_selasa = mysql_query("select *from waktu_telat where hari='Tue'");
$a_jam_selasa = mysql_fetch_array($q_jam_selasa);
$waktu_masuk_selasa = $a_jam_selasa["waktu"];
$jam_masuk_selasa   = $a_jam_selasa["jam"];
$menit_masuk_selasa = $a_jam_selasa["menit"];
$detik_masuk_selasa = $a_jam_selasa["detik"];
$waktu_pulang_selasa = $a_jam_selasa["waktu_pulang"];
$jam_pulang_selasa   = $a_jam_selasa["jam_pulang"];
$menit_pulang_selasa = $a_jam_selasa["menit_pulang"];
$detik_pulang_selasa = $a_jam_selasa["detik_pulang"];

$q_jam_rabu = mysql_query("select *from waktu_telat where hari='Wed'");
$a_jam_rabu = mysql_fetch_array($q_jam_rabu);
$waktu_masuk_rabu = $a_jam_rabu["waktu"];
$jam_masuk_rabu   = $a_jam_rabu["jam"];
$menit_masuk_rabu = $a_jam_rabu["menit"];
$detik_masuk_rabu = $a_jam_rabu["detik"];
$waktu_pulang_rabu = $a_jam_rabu["waktu_pulang"];
$jam_pulang_rabu   = $a_jam_rabu["jam_pulang"];
$menit_pulang_rabu = $a_jam_rabu["menit_pulang"];
$detik_pulang_rabu = $a_jam_rabu["detik_pulang"];

$q_jam_kamis = mysql_query("select *from waktu_telat where hari='Thu'");
$a_jam_kamis = mysql_fetch_array($q_jam_kamis);
$waktu_masuk_kamis = $a_jam_kamis["waktu"];
$jam_masuk_kamis   = $a_jam_kamis["jam"];
$menit_masuk_kamis = $a_jam_kamis["menit"];
$detik_masuk_kamis = $a_jam_kamis["detik"];
$waktu_pulang_kamis = $a_jam_kamis["waktu_pulang"];
$jam_pulang_kamis   = $a_jam_kamis["jam_pulang"];
$menit_pulang_kamis = $a_jam_kamis["menit_pulang"];
$detik_pulang_kamis = $a_jam_kamis["detik_pulang"];

$q_jam_jumat = mysql_query("select *from waktu_telat where hari='Fri'");
$a_jam_jumat = mysql_fetch_array($q_jam_jumat);
$waktu_masuk_jumat = $a_jam_jumat["waktu"];
$jam_masuk_jumat   = $a_jam_jumat["jam"];
$menit_masuk_jumat = $a_jam_jumat["menit"];
$detik_masuk_jumat = $a_jam_jumat["detik"];
$waktu_pulang_jumat = $a_jam_jumat["waktu_pulang"];
$jam_pulang_jumat   = $a_jam_jumat["jam_pulang"];
$menit_pulang_jumat = $a_jam_jumat["menit_pulang"];
$detik_pulang_jumat = $a_jam_jumat["detik_pulang"];

$q_jam_sabtu = mysql_query("select *from waktu_telat where hari='Sat'");
$a_jam_sabtu = mysql_fetch_array($q_jam_sabtu);
$waktu_masuk_sabtu = $a_jam_sabtu["waktu"];
$jam_masuk_sabtu   = $a_jam_sabtu["jam"];
$menit_masuk_sabtu = $a_jam_sabtu["menit"];
$detik_masuk_sabtu = $a_jam_sabtu["detik"];
$waktu_pulang_sabtu = $a_jam_sabtu["waktu_pulang"];
$jam_pulang_sabtu   = $a_jam_sabtu["jam_pulang"];
$menit_pulang_sabtu = $a_jam_sabtu["menit_pulang"];
$detik_pulang_sabtu = $a_jam_sabtu["detik_pulang"];



//--------------------------------------------------------------------------------------------------------------
$q_toptelat_siswa 	 = mysql_query("select *from top_telat where id=1");
$q_toptelat_guru 	 = mysql_query("select *from top_telat where id=2");
$q_toptelat_karyawan = mysql_query("select *from top_telat where id=3");
$top_siswa			 = mysql_fetch_array($q_toptelat_siswa);
$top_guru			 = mysql_fetch_array($q_toptelat_guru);
$top_karyawan		 = mysql_fetch_array($q_toptelat_karyawan);
$siswavalue			 = $top_siswa["value"];
$guruvalue			 = $top_guru["value"];
$karyawanvalue		 = $top_karyawan["value"];


?>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#forms">Form Pengaturan</a></li>
						
					</ul>
					
					<h2>Pengaturan</h2>
				</div>
				
				<div class="box-body clear">
					<!-- Custom Forms -->
					<div id="table">
						
						<form action="master/prosespengaturan.php" method="post" class="form"  enctype="multipart/form-data">
							<label onclick="p1();" ><h3>•Pengaturan Sekolah</h3></label>
							<div class="form-field clear" id="p_1">
								<label for="title" class="form-label fl-space2">Title: <span class="required">*</span></label>
								<input type="text" id="title" class="text fl" name="title" value="<?php print $array["title"];?>" />
							</div><!-- /.form-field -->			
							
							<div class="form-field clear" id="p_1_2">
								<label for="label" class="form-label fl-space2">Label Sekolah: <span class="required">*</span></label>
								<input type="text" id="label" class="text fl" name="label" value="<?php print $array["label"];?>" />
								
							</div>
							
							<!--<div class="form-field clear">
								<label for="label" class="form-label fl-space2">Jam Masuk: <span class="required">*</span></label>
								<select name='waktu1'>
									<?php
									for($x=1;$x<=24;$x++){
										if($x>=10){
											echo "<option value='".$x."'>".$x."</option>";
										}
										else{
										
											echo "<option value='0".$x."'>0".$x."</option>";
										}
									}
									?>
								</select> <span class="required"> : </span>
								<select name='waktu2'>
									<?php
									for($x=0;$x<=59;$x++){
										if($x>=10){
											echo "<option value='".$x."'>".$x."</option>";
										}
										else{
										
											echo "<option value='0".$x."'>0".$x."</option>";
										}
									}
									?>
								</select>  // Belum Dapat Digunakan
								
							</div>-->
							
							<?php /*<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Mata Pelajaran: <span class="required">*</span></label>
								<input type="text" id="textfield" class="text fl" name="pass" />
								
							</div><!-- /.form-field -->*/
							?>
							
							<div class="form-field clear" id="p_1_3">
								<label for="logo" class="form-label fl-space2">Foto: </label>
								<?php if($array["logo"] == "") {print"no image";} else{?><img src="master/logo/<?php print $array['logo'];?>" width="30" height="30"></img><?php }?>
								
							</div>
							
							<div class="form-field clear" id="p_1_4">
								<label for="logo" class="form-label fl-space2">Unggah Logo:</label>
								<input type="file" id="logo" class="form-file fl" name="logo" />
							</div><!-- /.form-field -->		
							
							<label onclick="p2();"><h3>•Pengaturan Finger Print</h3></label>
							
							<div class='form-field clear' id="p_2">
								<span class="required" >Isi Sesuai Mesin Yang Tersedia</span><br><br>
								<label for='ip' class='form-label fl-space2'>IP Mesin FP 1:<span class="required">*</span></label>
								<input type='text' value="<?php echo $array2["ip"]; ?>" id='ip' class='form-file fl' name='ip' maxlength='15'/>
							</div>
							<div class='form-field clear' id="p_2_2">
								<label for='key1' class='form-label fl-space2'>Key Mesin FP 1:<span class="required">*</span></label>
								
								<input type='text' id='key1' value="<?php print $array2["key"]; ?>" class='form-file fl' name='key' maxlength='3' width="3px"/>
								<br><br><br>
							</div>
							
							<div class='form-field clear' id="p_2_3">
								<label for='ip2' class='form-label fl-space2'>IP Mesin FP 2:<span class="required">*</span></label>
								<input type='text' value="<?php echo $a_fp["ip"]; ?>" id='ip2' class='form-file fl' name='ip2' maxlength='15'/>
								
							</div>
							<div class='form-field clear' id="p_2_4">
								<label for='key2' class='form-label fl-space2'>Key Mesin FP 2:<span class="required">*</span></label>
								<input type='text' id='key2' value="<?php print $a_fp["key"]; ?>" class='form-file fl' name='key2' maxlength='3'/>
								<br><br><br>
							
							</div>
							<div class='form-field clear' id="p_2_5">
								<label for='ip3' class='form-label fl-space2'>IP Mesin FP 3:<span class="required">*</span></label>
								<input type='text' value="<?php echo $a_fp3["ip"]; ?>" id='ip3' class='form-file fl' name='ip3' maxlength='15'/>
							</div>
							<div class='form-field clear' id="p_2_6">
								<label for='key3' class='form-label fl-space2'>Key Mesin FP 3:<span class="required">*</span></label>
								<input type='text' id='key3' value="<?php print $a_fp3["key"]; ?>" class='form-file fl' name='key3' maxlength='3'/>
								<br><br><br>
							
							</div>
							<div class='form-field clear' id="p_2_7">
								<label for='ip4' class='form-label fl-space2'>IP Mesin FP 4:<span class="required">*</span></label>
								<input type='text' value="<?php echo $a_fp4["ip"]; ?>" id='ip4' class='form-file fl' name='ip4' maxlength='15'/>
							</div>
							<div class='form-field clear' id="p_2_8">
								<label for='key4' class='form-label fl-space2'>Key Mesin FP 4:<span class="required">*</span></label>
								<input type='text' id='key4' value="<?php print $a_fp4["key"]; ?>" class='form-file fl' name='key4' maxlength='3'/>
								<br><br><br>
							
							</div>
							<div class='form-field clear' id="p_2_9">
								<label for='ip5' class='form-label fl-space2'>IP Mesin FP 5:<span class="required">*</span></label>
								<input type='text' value="<?php echo $a_fp5["ip"]; ?>" id='ip5' class='form-file fl' name='ip5' maxlength='15'/>
							</div>
							<div class='form-field clear' id="p_2_10">
								<label for='key5' class='form-label fl-space2'>Key Mesin FP 5:<span class="required">*</span></label>
								<input type='text' id='key5' value="<?php print $a_fp5["key"]; ?>" class='form-file fl' name='key5' maxlength='3'/>
								<br><br><br>
								
							</div>
							
							
							
							<label onclick="p3()"><h3>•Pengaturan Waktu 'In Out' Guru dan Karyawan</h3></label>
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
								<br><br>
								(<span class='required'>Note : </span><b> Untuk mengatur waktu masuk kelas berada di Form Kelas</b>)
								<br>
								<input type='hidden' value='Sat' id='Sat'></input>
							</div>
							
							</div>

							<label onclick="p4()"><h3>•Pengaturan 'Top Terlambat'</h3></label>
							<div class='form-field clear' id="p_4">
								<label for='top1' class='form-label fl-space2'>Top Siswa:<span class="required">*</span></label>
								<select name='top_siswa' id="top1">
									<?php
										for($angka = 1;$angka<101;$angka++){
									?>
										<option value="<?php print $angka;?>" <?php if($angka==$siswavalue){print " selected='true'";}?> ><?php print $angka;?></option>
									<?php
										}
									?>
								</select>
								<br><br><label for='top2' class='form-label fl-space2'>Top Guru:<span class="required">*</span></label>
								<select name='top_guru' id="top2">
									<?php
										for($angka2 = 1;$angka2<101;$angka2++){
									?>
										<option value="<?php print $angka2;?>"  <?php if($angka2==$guruvalue){print " selected='true'";}?> ><?php print $angka2;?></option>
									<?php
										}
									?>
								</select>
								<br><br><label for='top3' class='form-label fl-space2'>Top Karyawan:<span class="required">*</span></label>
								<select name='top_karyawan' id="top3">
									<?php
										for($angka3 = 1;$angka3<101;$angka3++){
									?>
										<option value="<?php print $angka3;?>"  <?php if($angka3==$karyawanvalue){print " selected='true'";}?> ><?php print $angka3;?></option>
									<?php
										}
									?>
								</select>
							</div>
							
							
							<div class="form-field clear">
								<input type="submit" class="submit fr" value="Submit" />
							</div><!-- /.form-field -->																								
							
						</form>
					</div><!-- /#forms -->
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</body>
