<!--<meta http-equiv="refresh" content="20">-->

<?php
	include("conn/conn.php");
	include("parse.php");
	include "conn/minggu.php";	 	
	date_default_timezone_set('Asia/Jakarta');


	$q_libur=mysql_query("select *from hari_libur ");
	
	$hari    = date("D");
	$tanggal = date("d-m");
//--------------------------------------------------------------------------------------------------------------------------

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
//-----------------------------------------------------------------------------------------------------------------------------	

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

function time2telat($time="00:00:00"){
	list($hours, $mins, $secs) = explode(':', $time);
	return ($hours * 3600 ) + ($mins * 60 ) + $secs;
}

							
$q_waktu_telat	   = mysql_query("select *from waktu_telat where hari='$hari'");
$array_waktu_telat = mysql_fetch_array($q_waktu_telat);
$jam_telat		   = $array_waktu_telat["jam"];
$menit_telat	   = $array_waktu_telat["menit"];
$detik_telat	   = $array_waktu_telat["detik"];
$waktu_telat	   = ($jam_telat*3600)+($menit_telat*60)+($detik_telat);
$jam_out		   = $array_waktu_telat["jam_pulang"];
$menit_out	  	   = $array_waktu_telat["menit_pulang"];
$detik_out	       = $array_waktu_telat["detik_pulang"];
$waktu_out	       = ($jam_out*3600)+($menit_out*60)+($detik_out);
$waktu_out2	       = $jam_out.":".$menit_out.":".$detik_out;	

//print $waktu_telat."/".$waktu_out;
									
$waktu = date('h:i:s A');
$tanggal = date('d-m-Y');

$q2	=	mysql_query("select *from fp order by ip");
while($array2=mysql_fetch_array($q2)){
$IP=$array2["ip"];
$Key=$array2["key"];



if($IP!=""){
	$Connect = fsockopen($IP, "80", $errno, $errstr, 1);


	if($Connect){
		$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
			
		}
	}else {
	echo "<p align='center'><span class='required'>*Koneksi Ke Mesin Absen ($IP) Gagal</span></p>";
	
	}
	


		
	
	//-----------------------------
	
	$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	$buffer=explode("\r\n",$buffer);
	for($a=0;$a<count($buffer);$a++){
		$data=Parse_Data($buffer[$a],"<Row>","</Row>");
		$PIN=Parse_Data($data,"<PIN>","</PIN>");
		$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
		$Verified=Parse_Data($data,"<Verified>","</Verified>");
		$Status=Parse_Data($data,"<Status>","</Status>");
	
		$date=$DateTime;
		$pecahh=strtok($date, " ");
		$pecah2 = strtok(" ");

		$bulan1=strtok($pecahh, "-");
		$bulan2=strtok("-");
		$bulan3=strtok("-");
		$bulan=$bulan2."-".$bulan1;
		$pecah=$bulan3."-".$bulan2."-".$bulan1;
		
	
		$stamp = strtotime($pecah);
		$hari=date("D", $stamp);
		$tanggal_mesin = $pecah;
		
	
	//----------------------------------------------------------------------------------------
	$check_query_siswa=mysql_query("select*from siswa where id_finger='$PIN'");
	$check_query_guru=mysql_query("select*from guru where id_finger='$PIN'");
	$check_query_karyawan=mysql_query("select*from karyawan where id_finger='$PIN'");
	
	$check_array_siswa = mysql_fetch_array($check_query_siswa);
	$check_array_guru = mysql_fetch_array($check_query_guru);
	$check_array_karyawan = mysql_fetch_array($check_query_karyawan);
	
		$id_kelass = $check_array_siswa["id_kelas"];
		$q_kelas2  = mysql_query("select $hari from kelas where id='$id_kelass'");
		$a_kelas2  = mysql_fetch_array($q_kelas2);
		$waktu_kelas	    = $a_kelas2["$hari"];
	//----------------------------------------------------------------------------------------
		$query_waktu_in_out_guru_karyawan = mysql_query("select * from waktu_telat where hari='$hari'");
		$array_waktu_in_out_guru_karyawan = mysql_fetch_array($query_waktu_in_out_guru_karyawan);
		$masuk = $array_waktu_in_out_guru_karyawan["waktu"];
		$keluar = $array_waktu_in_out_guru_karyawan["waktu_pulang"];
	//----------------------------------------------------------------------------------------
		$id_kelass = $check_array_siswa["id_kelas"];
		$q_kelas2  = mysql_query("select $hari from kelas where id='$id_kelass'");
		$a_kelas2  = mysql_fetch_array($q_kelas2);
		$waktu_kelas	    = $a_kelas2["$hari"];
	//----------------------------------------------------------------------------------------
	
	//$query_a=mysql_query("select*from absensi_siswa where no_siswa='$PIN' AND tanggal='$pecah'");
	//$isi=mysql_fetch_array($query_a);
	//$tanggal="11-11-11";
	//$check_query=mysql_query("select*from siswa where nis='$PIN'");
	//$check_array=mysql_fetch_array($check_query);
	
	//------------------------------------------------------------------------------------------
	if($check_array_siswa['id_finger'] == $PIN){
		$query_a=mysql_query("select*from absensi_siswa where id_finger='$PIN' AND tanggal='$pecah' order by id desc");
		$isi=mysql_fetch_array($query_a);
		$init = time2telat($pecah2);
		
		$masuk_kelas		= strtok($waktu_kelas, "-");
		$pulang_kelas		= strtok("-");
		//echo $pulang_kelas;

	//------------------------------------------------------------------------------	
		$masuk1 = explode(':', $masuk_kelas);
		$masuk2 = ($masuk1[0] * 3600 ) + ($masuk1[1] * 60 ) + $masuk1[2];
		$masuk3 = $init - $masuk2;	
	//------------------------------------------------------------------------------	
	//------------------------------------------------------------------------------	
		$keluar1 = explode(':', $pulang_kelas);
		$keluar2 = ($keluar1[0] * 3600 ) + ($keluar1[1] * 60 ) + $keluar1[2];
		$keluar3 = $init - $keluar2;	
	//------------------------------------------------------------------------------		

		if($isi['tanggal'] == $pecah){
	
				//echo "&nbsp;897";

		}
		else{
			
			
			if($PIN == 0 || $pecah == 0){
				//echo "&nbsp;";
			}
			else if( $isi['id_finger'] != $PIN || $isi['tanggal'] != $pecah ){
				if($init >= $masuk2){
					$telat = "y";
				}
				else if($init < $masuk2){
					$telat = "n";
				}
				else{
					$telat = "-";
				}
				
				$kelas_query = mysql_query("select *from siswa where id_finger='$PIN'")or die (mysql_error());
				$kelas_array = mysql_fetch_array($kelas_query);
				$kelas = $kelas_array["id_kelas"];
				$no_siswa = $kelas_array["nis"];
				
				mysql_query("insert into absensi_siswa(no_siswa,id_finger,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,tahun_ajaran,semester,minggu,hari,detik_telat) values('$no_siswa','$PIN','$kelas','h','$tanggal_mesin','$bulan','yes','$pecah2','$telat','in','$tahun_ajaran_sekarang','$semester_sekarang','$mingguke','$hari','$masuk3')")or die (mysql_error());
			}
			else if($isi["in_out"] == 'in' && $init >= $keluar2){
				$kelas_query = mysql_query("select *from siswa where id_finger='$PIN'")or die (mysql_error());
				$kelas_array = mysql_fetch_array($kelas_query);
				$kelas = $kelas_array["id_kelas"];
				$no_siswa = $kelas_array["nis"];
				
				mysql_query("insert into absensi_siswa(no_siswa,id_finger,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,tahun_ajaran,semester,minggu,hari,detik_telat) values('$no_siswa','$PIN','$kelas','-','$tanggal_mesin','$bulan','yes','$pecah2','-','out','$tahun_ajaran_sekarang','$semester_sekarang','$mingguke','$hari','0')")or die (mysql_error());
				echo "b";
			}
			else if($isi["in_out"] == 'out' && $isi['tanggal'] == $pecah && $init >= $keluar2){
			//	echo "&nbsp; a";
			}
			else{
				//print "sadf";
			}
		}
	}
//------------------------------------------------------------------------Guru--------------------------------------------------------------------
//------------------------------------------------------------------------Guru--------------------------------------------------------------------
//------------------------------------------------------------------------Guru--------------------------------------------------------------------
	else if($check_array_guru['id_finger'] == $PIN){
		$query_a=mysql_query("select*from absensi_guru where id_finger='$PIN' AND tanggal='$pecah' order by id desc");
		$isi=mysql_fetch_array($query_a);
		$init = time2telat($pecah2);
	//------------------------------------------------------------------------------	
		$masuk1 = explode(':', $masuk);
		$masuk2 = ($masuk1[0] * 3600 ) + ($masuk1[1] * 60 ) + $masuk1[2];
		$masuk3 = $init - $masuk2;	
	//------------------------------------------------------------------------------	
	//------------------------------------------------------------------------------	
		$keluar1 = explode(':', $keluar);
		$keluar2 = ($keluar1[0] * 3600 ) + ($keluar1[1] * 60 ) + $keluar1[2];
		$keluar3 = $init - $keluar2;	
	//------------------------------------------------------------------------------
		if($isi['tanggal'] == $pecah &&  $isi['waktu'] == $pecah2){

				//echo "&nbsp;";

		}

		else{
			$init = time2telat($pecah2);
			
			
			if($PIN == 0 || $pecah == 0){
				//echo "&nbsp;";
				
			}
			
			else if( $isi['id_finger'] != $PIN || $isi['tanggal'] != $pecah){
				
				if($init >= $masuk2){
					$telat = "y";
				}
				else if($init < $masuk2){
					$telat = "n";
				}
				else{
					$telat = "-";
				}
				
				$q_guruByPin = mysql_query("select *from guru where id_finger='$PIN'");
				$a_guruByPin = mysql_fetch_array($q_guruByPin);
				$nip		 = $a_guruByPin["nip"];
				
				mysql_query("insert into absensi_guru(guru_nip,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari,detik_telat) values('$nip','$PIN','h','$pecah','$bulan','yes','$pecah2','$telat','in','$mingguke','$hari','$masuk3')")or die ((mysql_error));
				
			
			
			}	
			else if($PIN == $isi['id_finger'] && $isi["in_out"] == 'in' && $init >= $keluar2){
				$q_guruByPin = mysql_query("select *from guru where id_finger='$PIN'");
				$a_guruByPin = mysql_fetch_array($q_guruByPin);
				$nip		 = $a_guruByPin["nip"];
			
				mysql_query("insert into absensi_guru(guru_nip,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nip','$PIN','-','$pecah','$bulan','yes','$pecah2','-','out','$mingguke','$hari')")or die ((mysql_error));
				
			}
			else if($isi["in_out"] == 'out' && $isi['tanggal'] == $pecah && $init > $keluar2){
			//	echo "&nbsp; a";
	
			}
			else{
			//	echo "&nbsp; b guru";
			
			}
		}
	}
//------------------------------------------------------------------------Karyawan--------------------------------------------------------------------
//------------------------------------------------------------------------Karyawan--------------------------------------------------------------------
//------------------------------------------------------------------------Karyawan--------------------------------------------------------------------
	else if($check_array_karyawan['id_finger'] == $PIN){
		$query_a=mysql_query("select*from absensi_karyawan where id_finger='$PIN' AND tanggal='$pecah'  order by id desc");
		$isi=mysql_fetch_array($query_a);
		$init = time2telat($pecah2);
	//------------------------------------------------------------------------------	
		$masuk1 = explode(':', $masuk);
		$masuk2 = ($masuk1[0] * 3600 ) + ($masuk1[1] * 60 ) + $masuk1[2];
		$masuk3 = $init - $masuk2;	
	//------------------------------------------------------------------------------	
	//------------------------------------------------------------------------------	
		$keluar1 = explode(':', $keluar);
		$keluar2 = ($keluar1[0] * 3600 ) + ($keluar1[1] * 60 ) + $keluar1[2];
		$keluar3 = $init - $keluar2;	
	//------------------------------------------------------------------------------
		
		if($isi['tanggal'] == $pecah &&  $isi['waktu'] == $pecah2){

				//echo "&nbsp;";

		}
	
		else{
			$init = time2telat($pecah2);
			
			if($PIN == 0 || $pecah == 0){
				//echo "&nbsp;";
			}
			
			else if( $isi['id_finger'] != $PIN || $isi['tanggal'] != $pecah){
				
				
									
			
				if($init >= $masuk2){
					$telat = "y";
				}
				else if($init < $masuk2){
					$telat = "n";
				}
				else{
					$telat = "-";
				}
				$q_karyawanByPin = mysql_query("select *from karyawan where id_finger='$PIN'");
				$a_karyawanByPin = mysql_fetch_array($q_karyawanByPin);
				$nup		     = $a_karyawanByPin["nup"];
				mysql_query("insert into absensi_karyawan(karyawan_nup,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari,detik_telat) values('$nup','$PIN','h','$pecah','$bulan','yes','$pecah2','$telat','in','$mingguke','$hari','$masuk3')")or die ((mysql_error));
		
			}
			
			else if($PIN == $isi['id_finger'] && $isi["in_out"] == 'in' && $init > $keluar2){
				
				
				$q_karyawanByPin = mysql_query("select *from karyawan where id_finger='$PIN'");
				$a_karyawanByPin = mysql_fetch_array($q_karyawanByPin);
				$nup		     = $a_karyawanByPin["nup"];
				mysql_query("insert into absensi_karyawan(karyawan_nup,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari) values('$nup','$PIN','-','$pecah','$bulan','yes','$pecah2','-','out','$mingguke','$hari')")or die ((mysql_error));
			}
			else if($isi["in_out"] == 'out' && $isi['tanggal'] == $pecah && $init > $keluar2){
			//	echo "&nbsp; a";
			}
			else{
			//	echo "&nbsp; b".$waktu_out.">".$waktu_out;
			}
		}	
	}
	else{
		print "";
	}
	
}
}
}
}
 ?>