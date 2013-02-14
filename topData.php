<?php
include "conn/conn.php";
$i=1;
$today233 	= $_GET["tanggal"];
$value 		= $_GET['value'];
$homeValue  = $_GET['homeValue'];
$folderFoto = $_GET['folderFoto'];
$xx		    = 1;
$totalTOP   = Array();
if($homeValue == "guru"){
	$queryTop   = "SELECT count(*) as t,nama,nip,foto,sum(detik_telat) as total_detik from absensi_guru,guru where absensi_guru.guru_nip=guru.nip  and bulan='$today233' and absensi_guru.terlambat='y' group by `guru_nip` order by t desc limit 0,$value";
	$queryTotal = "SELECT sum(detik_telat) as total_detik from absensi_guru where bulan='$today233' and terlambat='y'";
	}
else if($homeValue == "karyawan"){
	$queryTop   = "SELECT count(*) as t,nama,nup,foto,sum(detik_telat) as total_detik from absensi_karyawan,karyawan where absensi_karyawan.karyawan_nup=karyawan.nup  and bulan='$today233' and absensi_karyawan.terlambat='y' group by `karyawan_nup` order by t desc limit 0,$value";
	$queryTotal = "SELECT sum(detik_telat) as total_detik from absensi_karyawan where bulan='$today233' and terlambat='y'";
}
else if($homeValue != "karyawan" || $homeValue != "guru"){
	$queryTop   = "SELECT count(*) as t,foto,Nama_siswa,nama_panggilan,Nama_Kelas,nis,sum(detik_telat) as total_detik from absensi_siswa,siswa,kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and bulan='$today233' and absensi_siswa.terlambat='y' group by `no_siswa` order by t desc limit 0,$value";
	
	$queryTotal = "SELECT sum(detik_telat) as total_detik from absensi_siswa where bulan='$today233' and terlambat='y'";
}


$query = mysql_query($queryTop);
$total = mysql_num_rows($query);

$query2 = mysql_query($queryTotal);
$a_query2 = mysql_fetch_array($query2);
$detik_telat = $a_query2["total_detik"];
$hours2 = floor($detik_telat / 3600);
$minutes2 = floor(($detik_telat / 60) % 60);
$seconds2 = $detik_telat % 60;

print $total;
if($homeValue == "guru" || $homeValue=="karyawan"){
	while($b = mysql_fetch_array($query)){
		print "||";
		$total_detik = $b["total_detik"];
		$hours = floor($total_detik / 3600);
		$minutes = floor(($total_detik / 60) % 60);
		$seconds = $total_detik % 60;
		if($b['foto']==""){
			$foto="ico_users_64.png";
		}
		else{
			$foto=$b['foto'];
		}
		echo "<div id='isi_toptelat'><img src='master/".$folderFoto."/".$foto."' class='img_toptelat' align=left><label class='txt_toptelat'>";
		print"<b> NAMA &nbsp;: ".$b['nama']."";
		print"<br><font class='txt_toptelat'>TOTAL : ".$b['t']." ($hours jam, $minutes menit)</b></label> </font></div><div id='peringkat_toptelat'>#$i</div>";
		echo "<br>\n";
		$totalTOP[$i] = $b['t'];
		$i++;
		
	}
}
else {
	while($b = mysql_fetch_array($query)){
		print "||";
		$total_detik = $b["total_detik"];
		$hours = floor($total_detik / 3600);
		$minutes = floor(($total_detik / 60) % 60);
		$seconds = $total_detik % 60;
		if($b['foto']==""){
			$foto="ico_users_64.png";
		}
		else{
			$foto=$b['foto'];
		}
		echo "
		<div id='isi_toptelat'><img src='master/foto-siswa/".$foto."' class='img_toptelat' align=left><label class='txt_toptelat'>";
		print"<b> NAMA &nbsp;: ".$b['Nama_siswa']."";
		print"<br><font class='txt_toptelat'>KELAS : ".$b['Nama_Kelas']."</font>";
		print"<br><font class='txt_toptelat'>TOTAL : ".$b['t']." ($hours jam, $minutes menit)</b></label></font> </div><div id='peringkat_toptelat'>#$i</div>";
		echo "<br>\n";
		$totalTOP[$i] = $b['t'];
		$i++;
		

	}
	
}
print "||".array_sum($totalTOP)." ($hours2 jam, $minutes2 menit)";
?>