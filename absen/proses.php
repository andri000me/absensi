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

$kd_kelas=$_POST["no_kelas"];
header("location:../index.php?page=absen_ini&id_kelas=$kd_kelas");	
$q_waktu_telat = mysql_query("select $hari from kelas where id='$kd_kelas'");
$a_waktu_masuk = mysql_fetch_array($q_waktu_telat);
$waktu_hari_ini= $a_waktu_masuk["$hari"];

		$masuk_kelas		= strtok($waktu_hari_ini, "-");
		$pulang_kelas		= strtok("-");
		//echo $pulang_kelas;

	//------------------------------------------------------------------------------	
		$masuk1 = explode(':', $masuk_kelas);
		$masuk2 = ($masuk1[0] * 3600 ) + ($masuk1[1] * 60 ) + $masuk1[2];
	//------------------------------------------------------------------------------	
	//------------------------------------------------------------------------------	
		$keluar1 = explode(':', $pulang_kelas);
		$keluar2 = ($keluar1[0] * 3600 ) + ($keluar1[1] * 60 ) + $keluar1[2];
	//------------------------------------------------------------------------------		


$waktu = date('H:i:s');
$date_waktu = date($waktu_telat);
$stamp = strtotime($waktu);
$stamp_waktu = strtotime($date_waktu);
$tanggal = date('d-m-Y');
$bulan = date('m-Y');

for($d=1;$d<$_POST["jumlah"];$d++){

$y="absen".$d;
$no_siswa=$_POST["nis".$d];
$id_finger=$_POST["id_finger".$d];
$nomor=$_POST[$d];
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
$detik_telat="-";
}
else{
$detik=($jam*3600)+($menit*60);
$detik_telat = $detik - $waktu_telat;
}
//echo $ket;

//mysql_query("insert into absensi_siswa(no_siswa,kd_kelas,keterangan,tanggal,selesai,waktu) values('$no_siswa','$kd_kelas','$ket','$tanggal','yes','$waktu')");

//--------------------------------------------------------------------------------------------------------------------------
				$bulan_semester = date("m");
				if($bulan_semester == "6" || $bulan_semester == "7" || $bulan_semester == "8" || $bulan_semester == "9" || $bulan_semester == "10" || $bulan_semester == "11" || $bulan_semester == "12"){
					$semester_sekarang = "1";
				}
				else{
					$semester_sekarang = "2";
				}
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
	$query=mysql_query("select*from absensi_siswa where no_siswa='$no_siswa' AND id_finger='$id_finger' AND tanggal='$tanggal' AND kd_kelas='$kd_kelas'");
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
			
			
			mysql_query("insert into absensi_siswa(no_siswa,id_finger,kd_kelas,keterangan,tanggal,bulan,selesai,waktu,terlambat,in_out,tahun_ajaran,semester,minggu,hari,detik_telat) values('$no_siswa','$id_finger','$kd_kelas','$ket','$tanggal','$bulan','yes','$waktu','$telat','in','$tahun_ajaran_sekarang','$semester_sekarang','$mingguke','$hari','$detik_telat')") or die (mysql_error());
		}
		else{
			echo "&nbsp;";
		}	
	}
}

}
		

?>