<!--<meta http-equiv="refresh" content="20">-->

<?php
date_default_timezone_set('Asia/Jakarta');
$q2	=	mysql_query("select *from fp where id='1'");
$array2=mysql_fetch_array($q2);
$IP=$array2["ip"];
$Key=$array2["key"];

 function time2telat($time="00:00:00")
									{
									list($hours, $mins, $secs) = explode(':', $time);
									return ($hours * 3600 ) + ($mins * 60 ) + $secs;
									}

$waktu = date('h:i:s A');
$tanggal = date('d-m-Y');

if($IP!=""){?>

	<?php
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
	}else echo "<p align='center'><span class='required'>*Koneksi Ke Mesin Absen Gagal</span></p>";
	
//	print_r(htmlentities($buffer));

	include("parse.php");
	$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
	$buffer=explode("\r\n",$buffer);
	//-----------------------------------------------------------------------------------------------------------------------------------------------

	

	
	
	//mysql_query("insert into absensi_siswa(no_siswa,kd_kelas,keterangan,tanggal,selesai) values('$PIN1','1','h','$DateTime1','yes')");
	//-----------------------------------------------------------------------------------------------------------------------------------------------
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
		//print "$pecah <br>";

		//print $pecah2;
	
	
		$stamp = strtotime($pecah);
		$hari=date("D", $stamp);
	
		//if($hari = "Sun" || $hari = "Sat"){
		//echo "&nbsp;";
		//echo "select*from absensi_siswa where no_siswa='$PIN' AND tanggal='$pecah'";
		//}
		//else{
		//echo "select*from absensi_siswa where no_siswa='$PIN' AND tanggal='$pecah'";
	
	$query_a=mysql_query("select*from absensi_guru where karyawan_nup='$PIN' AND tanggal='$pecah'");
	$isi=mysql_fetch_array($query_a);
	//$tanggal="11-11-11";
	$check_query=mysql_query("select*from guru where nip='$PIN'");
	$check_array=mysql_fetch_array($check_query);
	if($check_array['nip'] == $PIN){
		if($isi['tanggal'] == $tanggal &&  $isi['waktu'] == $waktu){

			echo "&nbsp;";

	}
	else{
		if($nup == 0 || $tanggal == 0){
			echo "&nbsp;";
		}
		else if($nup == $isi['guru_nip'] && $tanggal == $isi['tanggal']){
			echo "&nbsp;";
		}
		else if( $isi['guru_nip'] != $nup || $isi['tanggal'] != $tanggal){
			$init = time2telat($pecah2);
									
			
				if($init >= 23460){
					$telat = "y";
				}
				else if($init < 23460){
					$telat = "n";
				}
				else{
					$telat = "-";
				}
			mysql_query("insert into absensi_guru(guru_nip,keterangan,tanggal,bulan,selesai,waktu,terlambat) values('$PIN','h','$pecah','$bulan','yes','$pecah2','$telat')");
		}
		else{
			echo "&nbsp;";
		}	
	}
	}	
		
	}
}
 ?>