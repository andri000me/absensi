
	<?php
	date_default_timezone_set('Asia/Jakarta');


				$bulan = date("m");
				$today		= 	date("d-m-Y");
				$today233	= 	date("m-Y");
				$h_i_s = date("H:i:s");
				$jam   = date("H");
				$q_siswa_all 	= mysql_query("select *from siswa");
				
				$siswa		= mysql_query("select * from siswa where id_kelas='$idkelas'");
				$array_siswa	= mysql_fetch_array($siswa);
								
				$telat 		= mysql_query("select * from absensi_siswa where terlambat='y' and tanggal='$today'");
				$telat2	    = mysql_num_rows($telat) ;
				
				$telatg 		= mysql_query("select * from absensi_guru where terlambat='y' and tanggal='$today'");
				$telat_guru	    = mysql_num_rows($telatg) ;
				
				$telatk 		= mysql_query("select * from absensi_karyawan where terlambat='y' and tanggal='$today'");
				$telat_karyawan	    = mysql_num_rows($telatk) ;
				$month = date ("F Y");
				//print $jam;
	//-------------------AUTO NAEK KELAS---------------------
	$tahun = date("Y");
	

	
	
	for($mulai = 2000; $mulai<2030;$mulai++){
		
		$angka = 1;
		$mulai = $mulai;
		$akhir = $mulai+1;

		$x	   = $mulai."-".$akhir;
		
		
		$pecahString = strtok($x," ");
		$tahun_awal  = strTok($pecahString,"-");
		$tahun_akhir = strTok("-");
		
		
		
		if($tahun == $tahun_awal && $bulan >= 7 && $bulan <= 12 || $tahun == $tahun_akhir && $bulan <= 6 ){
			$tahun_ajaran_sekarang = $x;
			//print $tahun_ajaran_sekarang;
		}

	}
	$q_tahun_ajaran = mysql_query("select *from tahun_ajaran order by id desc");
	$a_tahun_ajaran = mysql_fetch_array($q_tahun_ajaran);
	$tahun_ajaran   = $a_tahun_ajaran["tahun"];
	
	
	if($tahun_ajaran != $tahun_ajaran_sekarang){
		while($a_siswa_all	= mysql_fetch_array($q_siswa_all)){
			$siswa_all_id = $a_siswa_all["id"];
			$siswa_all_id_kelas = $a_siswa_all["id_kelas"];
			$siswa_all_nis = $a_siswa_all["nis"];
			
			$q_kelas_id = mysql_query("select *from kelas where id='$siswa_all_id_kelas'");
			$a_kelas_id = mysql_fetch_array($q_kelas_id);
			$kelas_id_nama = $a_kelas_id["Nama_Kelas"];
			$pecah_kelas = strtok($kelas_id_nama," ");
			$tingkat_kelas = strTok($pecah_kelas,"-");
			$nama_kelas = strTok("-");
			if($tingkat_kelas == "X"){
				$nama_kelas_baru = "XI"."-".$nama_kelas;
				
				$q_kelas_table = mysql_query("select *from kelas where Nama_Kelas = '$nama_kelas_baru'");
				$a_kelas_table = mysql_fetch_array($q_kelas_table);
				$kelas_table_id = $a_kelas_table["id"];
				print $kelas_table_id.";";
				mysql_query("update siswa set id_kelas='$kelas_table_id' where id='$siswa_all_id'");
				mysql_query("update absensi_siswa set kd_kelas='$kelas_table_id', no_siswa='$siswa_all_nis'");
			}
			else if($tingkat_kelas == "XI"){
				$nama_kelas_baru = "XII"."-".$nama_kelas;
				
				$q_kelas_table = mysql_query("select *from kelas where Nama_Kelas = '$nama_kelas_baru'");
				$a_kelas_table = mysql_fetch_array($q_kelas_table);
				$kelas_table_id = $a_kelas_table["id"];
				print $kelas_table_id.";";
				mysql_query("update siswa set id_kelas='$kelas_table_id' where id='$siswa_all_id'");
				mysql_query("update absensi_siswa set kd_kelas='$kelas_table_id', no_siswa='$siswa_all_nis'");
				
			}
			else if($tingkat_kelas == "XII"){
				$nama_kelas_baru = "XII"."-".$nama_kelas;
				
				$q_kelas_table = mysql_query("select *from kelas where Nama_Kelas = '$nama_kelas_baru'");
				$a_kelas_table = mysql_fetch_array($q_kelas_table);
				$kelas_table_id = $a_kelas_table["id"];
				mysql_query("delete from siswa where id='$siswa_all_id'");
				mysql_query("delete from absensi_siswa where no_siswa='$siswa_all_nis'");
				
			}
			else{
				print "";
			}
			
			
		}
		
		mysql_query("insert into tahun_ajaran(tahun) values('$tahun_ajaran_sekarang')");
	}
	else{
		print "";
	}
	
	
	//====================================================================================

	?>

	<div class="content-box">
	<?php
	//------------------refresh-phpFP-----------------------------------------------------
	include("absen_fp/proses_fp.php");
	//include("absen_karyawan/proses_fp.php");

	//====================================================================================

	//----------------AUTO INSERT ALPA------------------------

	$q_libur=mysql_query("select *from hari_libur ");
	$hari= date("D");

	$tanggal = date("d-m");


	while($array_libur = mysql_fetch_array($q_libur)){
		$mulai = $array_libur["tanggal_mulai"];
		$akhir = $array_libur["tanggal_akhir"];
		$pecahh=strtok($mulai, " ");
		$tanggal_mulai=strtok($pecahh, "-");
		$bulan_mulai=strtok("-");
		$tahun_mulai=strtok("-");
		
		
		$pecahhh=strtok($akhir, " ");
		$tanggal_akhir=strtok($pecahhh, "-");
		$bulan_akhir=strtok("-");
		$tahun_akhir=strtok("-");
		
		$pecahhhh=strtok($tanggal_mulai, " ");
		$tanggal_mulai_pecah = strtok($pecahhhh, "0");
		
		
		for($a = $tanggal_mulai_pecah ; $a<$tanggal_akhir+1 ; $a++){

			if($a<10){
				$b = "0".$a;
			}
			else{
				$b = $a;
			}
				
			
			$tanggal2=$b."-".$bulan;
			
		
			if($tanggal==$tanggal2){
				$hasil = 'endaycb';
			}
			else if($hari == "Sun"){
				$hasil = 'endaycb juga';
			}

			
			
		}

	}
	if($hasil){
	print "";
	}
	else{

		$waktu2 = date('H');
		$waktu3 = date("H:i:s");
		$tanggal2 = date("d-m-Y");
		$bulan2 = date("m-Y");



		$q_siswa = mysql_query("select *from siswa");
		while($array_q_siswa = mysql_fetch_array($q_siswa)){
		$nis_siswa = $array_q_siswa["nis"];
		$id_kelas_siswa = $array_q_siswa["id_kelas"];
		$q_absen_siswa = mysql_query("select *from absensi_siswa where no_siswa = '$nis_siswa' and tanggal='$tanggal2'") or die (mysql_error());
		$array_q_absen_siswa = mysql_fetch_array($q_absen_siswa );
		//print $array_q_absen_siswa["no_siswa"];

		if(empty($array_q_absen_siswa) && $waktu2>"15"){
			mysql_query("insert into absensi_siswa(no_siswa,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat) values('$nis_siswa','$id_kelas_siswa','a','$tanggal2','$bulan2','yes','$waktu3','-')");
		}

		}

		$q_guru = mysql_query("select *from guru");
		while($array_q_guru = mysql_fetch_array($q_guru)){
		$nip_guru = $array_q_guru["nip"];
		$q_absen_guru = mysql_query("select *from absensi_guru where guru_nip = '$nip_guru' and tanggal='$tanggal2'") or die (mysql_error());
		$array_q_absen_guru = mysql_fetch_array($q_absen_guru);
		//print $array_q_absen_siswa["no_siswa"];

		if(empty($array_q_absen_guru) && $waktu2>"18"){
			mysql_query("insert into absensi_guru(guru_nip,keterangan,tanggal,bulan,selesai,waktu,terlambat) values('$nip_guru','a','$tanggal2','$bulan2','yes','$waktu3','-')") or die (mysql_error());;
		}

		}

		$q_karyawan = mysql_query("select *from karyawan");
		while($array_q_karyawan = mysql_fetch_array($q_karyawan)){
		$nup = $array_q_karyawan["nup"];
		$q_absen_karyawan = mysql_query("select *from absensi_karyawan where karyawan_nup = '$nup' and tanggal='$tanggal2'") or die (mysql_error());
		$array_q_absen_karyawan = mysql_fetch_array($q_absen_karyawan);
		//print $array_q_absen_siswa["no_siswa"];

		if(empty($array_q_absen_karyawan) && $waktu2>"18"){
			mysql_query("insert into absensi_karyawan(karyawan_nup,keterangan,tanggal,bulan,selesai,waktu,terlambat) values('$nup','a','$tanggal2','$bulan2','yes','$waktu3','-')") or die (mysql_error());;
		}

		}

	}
	//============================================================

	//--------------KONFIG CLEAR LOG FP --------------------------
	if($jam > 10){
		include("absen_fp/clear-data.php");
	}
	
	//============================================================




	//----------------KONFIG TOP TELAT------------------------

	$q_toptelat_siswa 	= mysql_query("select *from top_telat where id=1");
	$q_toptelat_guru 	= mysql_query("select *from top_telat where id=2");
	$q_toptelat_karyawan= mysql_query("select *from top_telat where id=3");
	$top_siswa			= mysql_fetch_array($q_toptelat_siswa);
	$top_guru			= mysql_fetch_array($q_toptelat_guru);
	$top_karyawan		= mysql_fetch_array($q_toptelat_karyawan);
	$siswavalue			= $top_siswa["value"];
	$guruvalue			= $top_guru["value"];
	$karyawanvalue		= $top_karyawan["value"];
	//=======================================================

	?>
		<table>
		<tr class="aa" >
			<?php if($telat2 > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Siswa Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NIS</b></td>
								<td><b>Nama</b></td>
								<td width='50%'><b>Kelas</b></td>
							</thead>
						</tr>
							
						<?php
						$row = mysql_query("select * from absensi_siswa where tanggal='$today' and terlambat='y' order by kd_kelas") or die (mysql_error());
					
						while($array=mysql_fetch_array($row)){
							$nis_ini=$array['no_siswa'];
							$kelas_ini=$array['kd_kelas'];
							$row_siswa_ini=mysql_query("select * from siswa where nis='$nis_ini' and id_kelas='$kelas_ini'");
							$row_kelas_ini=mysql_query("select * from kelas where id='$kelas_ini'");
							$array_siswa_ini=mysql_fetch_array($row_siswa_ini);
							$array_kelas_ini=mysql_fetch_array($row_kelas_ini);
							print "<tr><td>".$array_siswa_ini['nis']."</td><td>".$array_siswa_ini['nama_panggilan']."</td><td>".$array_kelas_ini['Nama_Kelas']."</td></tr>";
						}
					?>
				</div>
				</table>
			</td>
			<?php
			}
			
			else{
				print"";
			}
			?>
			<td <?php if($telat_guru > 0 || $telat_karyawan > 0){print "colspan=2";} ?>>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=5><center><b>TOP <?php print $siswavalue;?> Siswa Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td <?php if($telat2 > 0){ echo "colspan=4align='center'"; } else { echo "rowspan=12 width=55%";}?>>
										<?php include "homeChart.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NIS</th>
									<th width=''>Nama</th>
									<th width=''>Kelas</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row = mysql_query("SELECT count(*) as t,Nama_siswa,nama_panggilan,Nama_Kelas,nis from absensi_siswa,siswa,kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and bulan='$today233' and absensi_siswa.terlambat='y' group by `no_siswa` order by t desc limit 0,$siswavalue") or die (mysql_error());
												
												while($array=mysql_fetch_array($row)){
												$nis = $array["nis"];
												$t = $array["t"];
												$s = $array["nama_panggilan"];
												$k = $array["Nama_Kelas"];
												print "<tr><td>$nis</td><td>$s</td><td>$k</td><td>$t</td></tr>";
												}
										?></tbody>
							</table>
						</div>
						
				</td>
				</tr>
				<tr class="aa" >
			<?php if($telat_guru > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Guru Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NIP</b></td>
								<td><b>Nama</b></td>
							</thead>
						</tr>
							
						<?php
						$row2 = mysql_query("select * from absensi_guru where tanggal='$today' and terlambat='y' order by guru_nip") or die (mysql_error());
					
						while($array2=mysql_fetch_array($row2)){
							$nip_ini=$array2['guru_nip'];
							$row_guru_ini=mysql_query("select * from guru where nip='$nip_ini'");
							$array_guru_ini=mysql_fetch_array($row_guru_ini);
							print "<tr><td>".$array_guru_ini['nip']."</td><td>".$array_guru_ini['nama']."</td></tr>";
						}
					?>
				</div>
				</table>
			</td>
			<?php
			}
			
			else{
				print"";
			}
			?>
			<td  <?php if($telat2 > 0 || $telat_karyawan > 0){print "colspan=2";} ?>>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=6><center><b>TOP <?php print $guruvalue;?> Guru Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td <?php if($telat_guru > 0){ echo "colspan=4align='center'"; } else { echo "rowspan=12 width=55%";}?>>
										<?php include "homeChartGuru.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NIP</th>
									<th width=''>Nama</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row2 = mysql_query("SELECT count(*) as t,nama,nip from absensi_guru,guru where absensi_guru.guru_nip=guru.nip  and bulan='$today233' and absensi_guru.terlambat='y' group by `guru_nip` order by t desc limit 0,$guruvalue") or die (mysql_error());
												
												while($array2=mysql_fetch_array($row2)){
												$nip = $array2["nip"];
												$t = $array2["t"];
												$s = $array2["nama"];
												print "<tr><td>$nip</td><td>$s</td><td>$t</td></tr>";
												}
										?></tbody>
							</table>
						</div>
						
				</td>
				</tr>
			<tr class="aa" >
			<?php if($telat_karyawan > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Karyawan Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NUP</b></td>
								<td><b>Nama</b></td>
							</thead>
						</tr>
							
						<?php
						$row33 = mysql_query("select * from absensi_karyawan where tanggal='$today' and terlambat='y' order by karyawan_nup") or die (mysql_error());
					
						while($array33=mysql_fetch_array($row33)){
							$nup_ini=$array33['karyawan_nup'];
							$row_karyawan_ini=mysql_query("select * from karyawan where nup='$nup_ini'");
							$array_karyawan_ini=mysql_fetch_array($row_karyawan_ini);
							print "<tr><td>".$array_karyawan_ini['nup']."</td><td>".$array_karyawan_ini['nama']."</td></tr>";
						}
					?>
				</div>
				</table>
			</td>
			<?php
			}
			
			else{
				print"";
			}
			?>
			<td  <?php if($telat2 > 0 || $telat_guru > 0){print "colspan=2";} ?>>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=6><center><b>TOP <?php print $karyawanvalue;?> Karyawan Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td <?php if($telat_karyawan > 0){ echo "colspan=4align='center'"; } else { echo "rowspan=12 width=55%";}?>>
										<?php include "homeChartKaryawan.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NUP</th>
									<th width=''>Nama</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row222 = mysql_query("SELECT count(*) as t,nama,nup from absensi_karyawan,karyawan where absensi_karyawan.karyawan_nup=karyawan.nup  and bulan='$today233' and absensi_karyawan.terlambat='y' group by `karyawan_nup` order by t desc limit 0,$karyawanvalue") or die (mysql_error());
												
												while($array222=mysql_fetch_array($row222)){
												$nup = $array222["nup"];
												$t = $array222["t"];
												$s = $array222["nama"];
												print "<tr><td>$nup</td><td>$s</td><td>$t</td></tr>";
												}
										?></tbody>
							</table>
						</div>
						
				</td>
				</tr>
			
		</table>
		
	</div>


		