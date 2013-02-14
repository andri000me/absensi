<?php 
require('fpdf.php');
include "../../conn/conn.php";
$q_logo	= mysql_query("select *from title");
$a_logo = mysql_fetch_array($q_logo);
$logo	= $a_logo["logo"];
if($_POST["jenis_laporan"] == "semester"){
	$semester = $_POST["semester"];
	$tahun_ajaran = $_POST["tahun_ajaran"];
	$in_out = $_POST["in_out"];
	$nis = $_POST["nis"];

	$select = mysql_query("SELECT siswa.nis, siswa.absen, siswa.foto, siswa.Nama_siswa, kelas.Nama_Kelas FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas");
	$bln = strtotime("1-".$tgl_bulan);
	$bulan_report=date("M Y", $bln);
	
	$h		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$s		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='s' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$i		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='i' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$a		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='a' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$t		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$tap	= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and in_out='out_auto' and semester='$semester' and tahun_ajaran='$tahun_ajaran'")or die(mysql_error());
	$d		= mysql_query("select sum(detik_telat) as detik_telat from absensi_siswa where no_siswa='$nis' and keterangan='h' and terlambat='y' and semester='$semester' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	
	$total_h   = mysql_num_rows($h);
	$total_s   = mysql_num_rows($s);
	$total_i   = mysql_num_rows($i);
	$total_a   = mysql_num_rows($a);
	$total_t   = mysql_num_rows($t);
	$total_tap = mysql_num_rows($t);
	
	$detik_telat = mysql_fetch_array($d);
	$total_detik = $detik_telat["detik_telat"];
	$hours   	 = floor($total_detik / 3600);
	$minutes 	 = floor(($total_detik / 60) % 60);
	$seconds 	 = $total_detik % 60;

	$a_select    = mysql_fetch_array($select);
	$nama		 = $a_select["Nama_siswa"];
	$nis		 = $a_select["nis"];
	$absen		 = $a_select["absen"];
	$kelas		 = $a_select["Nama_Kelas"];
	if(!empty($a_select["foto"])){
		$foto		 = $a_select["foto"];
	}else{
		$foto        = "ico_users_64.png";
	}
	
	$judul = "Rekap Presensi Semester $semester Tahun Ajaran $tahun_ajaran";
}

else if($_POST["jenis_laporan"] == "tahun_ajaran"){
	$tahun_ajaran = $_POST["tahun_ajaran"];
	$in_out = $_POST["in_out"];
	$nis = $_POST["nis"];

	$select = mysql_query("SELECT siswa.nis, siswa.absen, siswa.foto, siswa.Nama_siswa, kelas.Nama_Kelas FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas");
	$bln = strtotime("1-".$tgl_bulan);
	$bulan_report=date("M Y", $bln);
	
	$h		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$s		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='s' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$i		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='i' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$a		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='a' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$t		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	$tap	= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and in_out='out_auto' and tahun_ajaran='$tahun_ajaran'")or die(mysql_error());
	$d		= mysql_query("select sum(detik_telat) as detik_telat from absensi_siswa where no_siswa='$nis' and keterangan='h' and terlambat='y' and tahun_ajaran='$tahun_ajaran'") or die(mysql_error());
	
	$total_h   = mysql_num_rows($h);
	$total_s   = mysql_num_rows($s);
	$total_i   = mysql_num_rows($i);
	$total_a   = mysql_num_rows($a);
	$total_t   = mysql_num_rows($t);
	$total_tap = mysql_num_rows($t);
	
	$detik_telat = mysql_fetch_array($d);
	$total_detik = $detik_telat["detik_telat"];
	$hours   	 = floor($total_detik / 3600);
	$minutes 	 = floor(($total_detik / 60) % 60);
	$seconds 	 = $total_detik % 60;

	$a_select    = mysql_fetch_array($select);
	$nama		 = $a_select["Nama_siswa"];
	$nis		 = $a_select["nis"];
	$absen		 = $a_select["absen"];
	$kelas		 = $a_select["Nama_Kelas"];
	if(!empty($a_select["foto"])){
		$foto		 = $a_select["foto"];
	}else{
		$foto        = "ico_users_64.png";
	}

	$judul = "Rekap Presensi Periode Tahun Ajaran $tahun_ajaran";
}
else if($_POST["jenis_laporan"] == "perbulan"){

	$tgl_bulan = $_POST["bulan"];
	$nis = $_POST["nis"];
	$in_out = $_POST["in_out"];

	$select = mysql_query("SELECT siswa.nis, siswa.absen, siswa.foto, siswa.Nama_siswa, kelas.Nama_Kelas FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas");
	$bln = strtotime("1-".$tgl_bulan);
	$bulan_report=date("M Y", $bln);
	
	$h		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and bulan='$tgl_bulan'");
	$s		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='s' and bulan='$tgl_bulan'");
	$i		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='i' and bulan='$tgl_bulan'");
	$a		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='a' and bulan='$tgl_bulan'");
	$t		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and bulan='$tgl_bulan'");
	$tap	= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and in_out='out_auto' and bulan='$tgl_bulan'");
	$d		= mysql_query("select sum(detik_telat) as detik_telat from absensi_siswa where no_siswa='$nis' and keterangan='h' and terlambat='y' and bulan='$tgl_bulan'");
	
	$total_h   = mysql_num_rows($h);
	$total_s   = mysql_num_rows($s);
	$total_i   = mysql_num_rows($i);
	$total_a   = mysql_num_rows($a);
	$total_t   = mysql_num_rows($t);
	$total_tap = mysql_num_rows($t);
	
	$detik_telat = mysql_fetch_array($d);
	$total_detik = $detik_telat["detik_telat"];
	$hours   	 = floor($total_detik / 3600);
	$minutes 	 = floor(($total_detik / 60) % 60);
	$seconds 	 = $total_detik % 60;

	$a_select    = mysql_fetch_array($select);
	$nama		 = $a_select["Nama_siswa"];
	$nis		 = $a_select["nis"];
	$absen		 = $a_select["absen"];
	$kelas		 = $a_select["Nama_Kelas"];
	if(!empty($a_select["foto"])){
		$foto		 = $a_select["foto"];
	}else{
		$foto        = "ico_users_64.png";
	}
	
	$judul = "Rekap Presensi Bulan $bulan_report";
}
else if($_POST["jenis_laporan"] == "pertanggal"){
	$tgl_bulan = $_POST["bulan"];
	$tgl_start = $_POST["mulai"];
	$tgl_finish = $_POST["akhir"];
	$nis = $_POST["nis"];
	$in_out = $_POST["in_out"];
	
	$select = mysql_query("SELECT siswa.nis, siswa.absen, siswa.foto, siswa.Nama_siswa, kelas.Nama_Kelas FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas");
	$h		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$s		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='s' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$i		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='i' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$a		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='a' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$t		= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and keterangan='h' and terlambat='y' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$tap	= mysql_query("select keterangan from absensi_siswa where no_siswa='$nis' and in_out='out_auto' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	$d		= mysql_query("select sum(detik_telat) as detik_telat from absensi_siswa where no_siswa='$nis' and keterangan='h' and terlambat='y' and tanggal between '$tgl_start' and '$tgl_finish' and bulan='$tgl_bulan'");
	
	$total_h   = mysql_num_rows($h);
	$total_s   = mysql_num_rows($s);
	$total_i   = mysql_num_rows($i);
	$total_a   = mysql_num_rows($a);
	$total_t   = mysql_num_rows($t);
	$total_tap = mysql_num_rows($t);
	
	$detik_telat = mysql_fetch_array($d);
	$total_detik = $detik_telat["detik_telat"];
	$hours   	 = floor($total_detik / 3600);
	$minutes 	 = floor(($total_detik / 60) % 60);
	$seconds 	 = $total_detik % 60;

	$a_select    = mysql_fetch_array($select);
	$nama		 = $a_select["Nama_siswa"];
	$nis		 = $a_select["nis"];
	$absen		 = $a_select["absen"];
	$kelas		 = $a_select["Nama_Kelas"];
	if(!empty($a_select["foto"])){
		$foto		 = $a_select["foto"];
	}else{
		$foto        = "ico_users_64.png";
	}
	
	
	$judul = "Rekap Presensi Periode $tgl_start s/d $tgl_finish";
}


$pdf=new FPDF('P','mm','A4');
$pdf->SetMargins(10,20,30);
$pdf->AddPage();  
$pdf->SetFont('Times','',18); 
$pdf->Cell(200,6,$judul,0,1,'C');
$pdf->MultiCell(10,20,'',0,1);
 $pdf->SetFillColor(255,255,255);
 $pdf->SetFont('Times','',12);
$pdf->Cell(60,80,'photo',1,1,'C',1);   
$pdf->Cell(10,5,'',0,2,'C',0);  
$pdf->Cell(20,8,'Nis',0,0,'L',0);  
$pdf->Cell(3,8,':',0,0,'L',0);  
$pdf->MultiCell(120,8,$nis,0,1,'L',0);  
$pdf->Cell(20,8,'Nama',0,0,'L',0);  
$pdf->Cell(3,8,':',0,0,'L',0);  
$pdf->MultiCell(120,8,$nama,0,1,'L',0);  
$pdf->Cell(20,8,'Kelas',0,0,'L',0);   
$pdf->Cell(3,8,':',0,0,'L',0);  
$pdf->MultiCell(120,8,$kelas,0,1,'L',0);  
$pdf->Cell(20,8,'Absen',0,0,'L',0); 
$pdf->Cell(3,8,':',0,0,'L',0);  
$pdf->MultiCell(120,8,$absen,0,1,'L',0);  
 
$pdf->SetFillColor(99,141,234);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Times','B',13);
$pdf->Cell(30,6,'',0,1,'C',0);  
$pdf->Cell(30,6,'Hadir',1,0,'C',1);  
$pdf->Cell(30,6,'Sakit',1,0,'C',1);  
$pdf->Cell(30,6,'Izin',1,0,'C',1);  
$pdf->Cell(30,6,'Alpha',1,0,'C',1);  
$pdf->Cell(30,6,'Terlambat',1,0,'C',1); 
$pdf->Cell(30,6,'TAP',1,1,'C',1);



$pdf->SetFillColor(245,245,245);
$pdf->SetFont('Times','B',30);
$pdf->SetTextColor(122,255,147);
$pdf->Cell(30,20,$total_h,1,0,'C',1); 
$pdf->SetTextColor(255,252,0);
$pdf->Cell(30,20,$total_s,1,0,'C',1); 
$pdf->SetTextColor(154,164,255);
$pdf->Cell(30,20,$total_i,1,0,'C',1);
$pdf->SetTextColor(255,91,91); 
$pdf->Cell(30,20,$total_a,1,0,'C',1);
$pdf->SetTextColor(255,183,69); 
$pdf->Cell(30,20,$total_t,1,0,'C',1);
$pdf->SetTextColor(179,0,00); 
$pdf->Cell(30,20,$total_tap,1,1,'C',1);

$pdf->SetTextColor(255,11,11);
$pdf->SetFont('Times','I',10); 
$pdf->Cell(100,6,'Note* : TAP = Tidak Absen Pulang',0,1,'L',0); 

$pdf->SetFillColor(99,141,234);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Times','B',13);
$pdf->Cell(30,6,'',0,1,'C',0);

$pdf->Cell(100,6,'Total Waktu Terlambat',1,1,'C',1);
$pdf->SetFillColor(245,245,245);
$pdf->SetFont('Times','B',17);
$pdf->SetTextColor(255,91,91); 
$pdf->Cell(100,12,$hours.' Jam, '.$minutes.' Menit',1,1,'C',1);
$pdf->Image('../../master/logo/'.$logo,10,10,24,19);   
$pdf->Image('../../master/foto-siswa/'.$foto,11,47,58,78);

$pdf->Output(); 
 
?>