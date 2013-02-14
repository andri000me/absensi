<?php
	
	date_default_timezone_set('Asia/Jakarta');
	
	
	//include("parse.php");
	include("conn/conn.php");
	include "conn/minggu.php";	
	$hari= date("D");
				$bulan_semester = date("m");
				if($bulan_semester == "6" || $bulan_semester == "7" || $bulan_semester == "8" || $bulan_semester == "9" || $bulan_semester == "10" || $bulan_semester == "11" || $bulan_semester == "12"){
					$semester_sekarang = "1";
				}
				else{
					$semester_sekarang = "2";
				}
				
				$bulan = date("m");
				$today		= 	date("d-m-Y");
				
				$today233	= 	date("m-Y");
				$today2	= 	date("d F Y");
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
			$PIN = $a_siswa_all["id_finger"];
			
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
				
			}
			
			else if($tingkat_kelas == "XI"){
				$nama_kelas_baru = "XII"."-".$nama_kelas;
				
				$q_kelas_table = mysql_query("select *from kelas where Nama_Kelas = '$nama_kelas_baru'");
				$a_kelas_table = mysql_fetch_array($q_kelas_table);
				$kelas_table_id = $a_kelas_table["id"];
				print $kelas_table_id.";";
				mysql_query("update siswa set id_kelas='$kelas_table_id' where id='$siswa_all_id'");
				
				
			}
			else if($tingkat_kelas == "XII"){
				$nama_kelas_baru = "XII"."-".$nama_kelas;
				
				$q_kelas_table = mysql_query("select *from kelas where Nama_Kelas = '$nama_kelas_baru'");
				$a_kelas_table = mysql_fetch_array($q_kelas_table);
				$kelas_table_id = $a_kelas_table["id"];
				mysql_query("delete from siswa where id='$siswa_all_id'");
				include("absen_fp/delete_user.php");
				
				
			}
			else{
				print "";
			}
			mysql_query("delete from absensi_siswa where no_siswa='$siswa_all_nis'");
			
		}
		
		mysql_query("insert into tahun_ajaran(tahun) values('$tahun_ajaran_sekarang')");
	}
	else{
		print "";
	}
	
	
	//====================================================================================
	//------------------refresh-phpFP-----------------------------------------------------
	
	include("absen_fp/proses_fp.php");

	//====================================================================================

	//----------------AUTO INSERT ALPA-!OUT------------------------

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
			$finger_siswa = $array_q_siswa["id_finger"];
			$id_kelas_siswa = $array_q_siswa["id_kelas"];
			$hari=date("D");
			//---------------------------------------------
					$queri_kelas  = mysql_query("select $hari from kelas where id='$id_kelas_siswa'");
					$look_kelas  = mysql_fetch_array($queri_kelas);
					$waktu_kelas	    = $a_kelas2["$hari"];
					$waktu_masuk_kelas		= strtok($waktu_kelas, "-");
					$waktu_pulang_kelas		= strtok("-");
					$jam_pulang = explode(':', $waktu_pulang_kelas);
			//---------------------------------------------
					
			$q_absen_siswa = mysql_query("select *from absensi_siswa where no_siswa = '$nis_siswa' and tanggal='$tanggal2' and in_out='in'") or die (mysql_error());
			$q_out_siswa = mysql_query("select *from absensi_siswa where no_siswa = '$nis_siswa' and tanggal='$tanggal2' and in_out='out'") or die (mysql_error());
			$q_notOut_siswa = mysql_query("select *from absensi_siswa where no_siswa = '$nis_siswa' and tanggal='$tanggal2' and in_out='out_auto'") or die (mysql_error());
			$array_q_absen_siswa = mysql_fetch_array($q_absen_siswa);
			$array_q_out_siswa = mysql_fetch_array($q_out_siswa);
			$array_q_notOut_siswa = mysql_fetch_array($q_notOut_siswa);

			if(empty($array_q_absen_siswa) && $waktu2 == $jam_pulang[0]){
				mysql_query("insert into absensi_siswa(no_siswa,id_finger,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,tahun_ajaran,semester,minggu,hari) values('$nis_siswa','$finger_siswa','$id_kelas_siswa','a','$tanggal2','$bulan2','yes','-','-','-','$tahun_ajaran_sekarang','$semester_sekarang','$mingguke','$hari')");
				//print "a";
			}
			else if(!empty($array_q_notOut_siswa)){
				//print "c";
			}
			else if(!empty($array_q_absen_siswa) && $array_q_absen_siswa["keterangan"]=="h" && empty($array_q_out_siswa) && $waktu2 >= $jam_pulang[0]+3){
				mysql_query("insert into absensi_siswa(no_siswa,id_finger,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,tahun_ajaran,semester,minggu,hari) values('$nis_siswa','$finger_siswa','$id_kelas_siswa','-','$tanggal2','$bulan2','yes','-','-','out_auto','$tahun_ajaran_sekarang','$semester_sekarang','$mingguke','$hari')");
				//print "b";
			}
			
		}

		$q_guru = mysql_query("select *from guru");
	//----------------------------------------------------------------------------------------
		$query_in_out_guru_karyawan = mysql_query("select * from waktu_telat where hari='$hari'");
		$array_in_out_guru_karyawan = mysql_fetch_array($query_in_out_guru_karyawan);
		$waktu_karyawan_masuk = $array_in_out_guru_karyawan["waktu"];
		$waktu_karyawan_keluar = $array_in_out_guru_karyawan["waktu_pulang"];
		$jam_karyawan_pulang = explode(':', $waktu_karyawan_keluar);
	//----------------------------------------------------------------------------------------
		while($array_q_guru = mysql_fetch_array($q_guru)){
		$nip_guru = $array_q_guru["nip"];
		$id_finger_guru = $array_q_guru["id_finger"];
		$q_absen_guru = mysql_query("select *from absensi_guru where guru_nip = '$nip_guru' and tanggal='$tanggal2' and in_out='in'") or die (mysql_error());
		$q_out_guru = mysql_query("select *from absensi_guru where guru_nip = '$nip_guru' and tanggal='$tanggal2' and in_out='out'") or die (mysql_error());
		$q_notOut_guru = mysql_query("select *from absensi_guru where guru_nip = '$nip_guru' and tanggal='$tanggal2' and in_out='out_auto'") or die (mysql_error());
		$array_q_absen_guru = mysql_fetch_array($q_absen_guru);
		$array_q_out_guru = mysql_fetch_array($q_out_guru);
		$array_q_notOut_guru = mysql_fetch_array($q_notOut_guru);
		

		if(empty($array_q_absen_guru) && $waktu2 == $jam_karyawan_pulang[0]){
			mysql_query("insert into absensi_guru(guru_nip,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nip_guru','$id_finger_guru','a','$tanggal2','$bulan2','yes','-','-','-','$mingguke','$hari')") or die (mysql_error());
		}
		
		else if(!empty($array_q_notOut_guru)){
			//print "c";
		}
		
		else if(!empty($array_q_absen_guru) && $waktu2 >= $jam_karyawan_pulang[0]+3 && $array_q_absen_guru["keterangan"]=="h" && empty($array_q_out_guru) ){
			mysql_query("insert into absensi_guru(guru_nip,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nip_guru','$id_finger_guru','-','$tanggal2','$bulan2','yes','-','-','out_auto','$mingguke','$hari')") or die (mysql_error());
		}
		
		
		}
		
		$q_karyawan = mysql_query("select *from karyawan");
		while($array_q_karyawan = mysql_fetch_array($q_karyawan)){
		$nup = $array_q_karyawan["nup"];
		$id_finger_karyawan = $array_q_karyawan["id_finger"];
		$q_absen_karyawan = mysql_query("select *from absensi_karyawan where karyawan_nup = '$nup' and tanggal='$tanggal2' and in_out='in'") or die (mysql_error());
		$q_out_karyawan = mysql_query("select *from absensi_karyawan where karyawan_nup = '$nup' and tanggal='$tanggal2' and in_out='out'") or die (mysql_error());
		$q_notOut_karyawan = mysql_query("select *from absensi_karyawan where karyawan_nup = '$nup' and tanggal='$tanggal2' and in_out='out_auto'") or die (mysql_error());
		$array_q_absen_karyawan = mysql_fetch_array($q_absen_karyawan);
		$array_q_out_karyawan = mysql_fetch_array($q_out_karyawan);
		$array_q_notOut_karyawan = mysql_fetch_array($q_notOut_karyawan);
		

		if(empty($array_q_absen_karyawan) && $waktu2 == $jam_karyawan_pulang[0]){
			mysql_query("insert into absensi_karyawan(karyawan_nup,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nup','$id_finger','a','$tanggal2','$bulan2','yes','-','-','-','$mingguke','$hari')") or die (mysql_error());
		}
		else if(!empty($array_q_notOut_karyawan)){
			//print "c";
		}
		else if(!empty($array_q_absen_karyawan) && $waktu2 == $jam_karyawan_pulang[0]+3 && $array_q_absen_karyawan["keterangan"]=="h" && empty($array_q_out_karyawan) ){
			mysql_query("insert into absensi_karyawan(karyawan_nup,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nup','$id_finger','-','$tanggal2','$bulan2','yes','-','-','out_auto','$mingguke','$hari')") or die (mysql_error());
		}

		}
		

	}
	//============================================================

	//--------------KONFIG CLEAR LOG FP --------------------------
	if($jam > 23){
		include("absen_fp/clear-data.php");
	}
	
	//============================================================



	?>