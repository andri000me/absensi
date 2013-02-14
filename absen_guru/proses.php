<?php 
date_default_timezone_set('Asia/Jakarta');
include "../conn/conn.php";
include "../conn/minggu.php";



$hari= date("D");
if($hari == "Sun"){
header("location:../index.php");	
}
else{
date_default_timezone_set("Asia/Jakarta");
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

header("location:../index.php?page=laporan_guru_hari_ini");	

$waktu = date('H:i:s');
$date_waktu = date($waktu_telat);
$stamp = strtotime($waktu);
$stamp_waktu = strtotime($date_waktu);
$tanggal = date('d-m-Y');
$bulan = date('m-Y');



for($d=1;$d<$_POST["jumlah"];$d++){

$y="absen".$d;
$nip=$_POST["nip".$d];
//echo $nup;
$id_finger=$_POST["id_finger".$d];
echo $id_finger;
$nomor=$_POST[$d];
//echo $nomor;
$ket=$_POST[$d];
$telat=$_POST["t".$d];
$jam=$_POST["jam_masuk_".$d];
$menit=$_POST["menit_masuk_".$d];

if($jam<10){
	$jam2= "0".$jam;
}
else{
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

//--------------------------------------------------------------------------------------------------------------------------
	$query=mysql_query("select*from absensi_guru where guru_nip='$nip' AND id_finger='$id_finger' AND tanggal='$tanggal'");
	$isi=mysql_fetch_array($query);

	
	if($isi['tanggal'] == $tanggal){

			echo "6";

	}
	
	else{
		if($id_finger == 0 || $tanggal == 0){
			echo "5";
		}
		else if($id_finger == $isi['id_finger'] && $tanggal == $isi['tanggal']){
			echo "4";
		}
		else if( $isi['id_finger'] != $id_finger || $isi['tanggal'] != $tanggal){
		
			mysql_query("insert into absensi_guru(guru_nip,id_finger,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,minggu,hari,detik_telat) values('$nip','$id_finger','$ket','$tanggal','$bulan','yes','$waktu','$telat','in','$mingguke','$hari','$detik_telat')") or die (mysql_error());
			echo "1";
		}
		else{
			echo "2";
		}	
	}
}

}
		
?>