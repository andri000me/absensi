<?php 
date_default_timezone_set('Asia/Jakarta');
include "../conn/conn.php";
include "../conn/minggu.php";
$q_waktu = mysql_query("select *from waktu_telat");
$array_waktu=mysql_fetch_array($q_waktu);
$waktu_telat = $array_waktu["waktu"];

$hari= date("D");
if($hari == "Sun"){
header("location:../index.php");	
}
else{
date_default_timezone_set("Asia/Jakarta");


header("location:../index.php?page=laporan_karyawan_hari_ini");	


$q_waktu_telat	   = mysql_query("select *from waktu_telat where hari='$hari'");
$array_waktu_telat = mysql_fetch_array($q_waktu_telat);
$jam_telat		   = $array_waktu_telat["jam"];
$menit_telat	   = $array_waktu_telat["menit"];
$detik_telat	   = $array_waktu_telat["detik"];
$waktu_telat	   = ($jam_telat*3600)+($menit_telat*60);
$jam_out		   = $array_waktu_telat["jam_pulang"];
$menit_out	  	   = $array_waktu_telat["menit_pulang"];
$detik_out	       = $array_waktu_telat["detik_pulang"];
$waktu_out	       = ($jam_out*3600)+($menit_out*60);

$tanggal = date('d-m-Y');
$bulan = date('m-Y');



for($d=1;$d<$_POST["jumlah"];$d++){

$y="absen".$d;
$nup=$_POST["nup".$d];
$id_finger=$_POST["id_finger".$d];
//echo $nup;
$nomor=$_POST[$d];
//echo $nomor;
$ket=$_POST[$d];
$telat=$_POST["t".$d];
$jam=$_POST["jam_masuk_".$d];
$menit=$_POST["menit_masuk_".$d];

if($jam<10){
	$jam2= "0".$jam;
}else{
	$jam2= $jam;
}
if($menit<10){
	$menit2= "0".$menit;
}else{
	$menit2= $menit;
}
if(empty($telat)){
$telat="n";
$waktu='-';
}else{
$waktu=$jam2.":".$menit2.":00";
$detik=($jam*3600)+($menit*60);
$detik_telat = $detik - $waktu_telat;
}

echo $ket;



//--------------------------------------------------------------------------------------------------------------------------
	$query=mysql_query("select*from absensi_karyawan where karyawan_nup='$nup' AND id_finger='$id_finger' AND tanggal='$tanggal'");
	$isi=mysql_fetch_array($query);

	
	if($isi['tanggal'] == $tanggal){

			echo "&nbsp;";

	}
	
	else{
		if($id_finger == 0 || $tanggal == 0){
			echo "&nbsp;";
		}
		else if($id_finger == $isi['id_finger'] && $tanggal == $isi['tanggal']){
			echo "&nbsp;";
		}
		else if( $isi['id_finger'] != $id_finger || $isi['tanggal'] != $tanggal){
		
			mysql_query("insert into absensi_karyawan(karyawan_nup,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari,detik_telat) values('$nup','$id_finger','$ket','$tanggal','$bulan','yes','$waktu','$telat','in','$mingguke','$hari','$detik_telat')") or die (mysql_error());
		}
		else{
			echo "&nbsp;";
		}	
	}
}

}
		
?>