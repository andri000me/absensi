<?php 
require('fpdf.php'); // file fpdf.php harus diincludekan  
include "../../conn/conn.php";
$kelas		   = $_POST["kelas"];
$bulan		   = $_POST["bulan"];
$nama_kelas    = $_POST["nama_kelas"];
$q_logo	= mysql_query("select *from title");
$a_logo = mysql_fetch_array($q_logo);
$logo	= $a_logo["logo"];
$bln = strtotime("1-".$bulan);
$bulan_report=date("M Y", $bln);

$query = mysql_query("select Nama_Kelas,nis,Nama_siswa,absen from siswa,kelas where siswa.id_kelas=kelas.id and siswa.id_kelas='$kelas' order by absen") or die (mysql_error());
$pdf=new FPDF('P','mm','A4');
$pdf->SetMargins(10,20,30); 
$pdf->AddPage();  
// setting jenis font Times New Roman, standard, size 12  
$pdf->SetFont('Times','B',18); 
$pdf->Cell(200,6,'REKAP PRESENSI KELAS BULAN '.$bulan_report,0,1,'C');
$pdf->Cell(10,6,'',0,1);
$pdf->SetFillColor(99,141,234);
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Times','B',13);
$pdf->Cell(10,6,'No',1,0,'C',1);
$pdf->Cell(60,6,'Nama',1,0,'C',1);      
$pdf->Cell(25,6,'Kelas',1,0,'C',1);  
$pdf->Cell(10,6,'H',1,0,'C',1);   
$pdf->Cell(10,6,'S',1,0,'C',1);  
$pdf->Cell(10,6,'I',1,0,'C',1);  
$pdf->Cell(10,6,'A',1,0,'C',1);  
$pdf->Cell(10,6,'T',1,0,'C',1); 
$pdf->Cell(45,6,'Waktu Terlambat',1,1,'C',1); 
$pdf->Image('../../master/logo/'.$logo,10,10,24,19);   
$x=1;
$j=0;
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Times','',12);
while($array = mysql_fetch_array($query)){
	$h = mysql_query("select *from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='h' and bulan='$bulan'");
	$s = mysql_query("select *from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='s' and bulan='$bulan'");
	$i = mysql_query("select *from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='i' and bulan='$bulan'");
	$a = mysql_query("select *from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='a' and bulan='$bulan'");
	$t = mysql_query("select *from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='h' and terlambat='y' and bulan='$bulan'");
	$d = mysql_query("select sum(detik_telat) as detik_telat from absensi_siswa where no_siswa='".$array["nis"]."' and keterangan='h' and terlambat='y' and bulan='$bulan'");
	
	$total_h = mysql_num_rows($h);
	$total_s = mysql_num_rows($s);
	$total_i = mysql_num_rows($i);
	$total_a = mysql_num_rows($a);
	$total_t = mysql_num_rows($t);
	
	$detik_telat = mysql_fetch_array($d);
	$total_detik = $detik_telat["detik_telat"];
	$hours   	 = floor($total_detik / 3600);
	$minutes 	 = floor(($total_detik / 60) % 60);
	$seconds 	 = $total_detik % 60;
	

	$nama = $array["Nama_siswa"];
	$ax=$j%2;
	if ($ax == 0){  
		$pdf->SetFillColor(255,255,255);
	} 
	else{  
		$pdf->SetFillColor(224,235,255);
	}
	$pdf->Cell(10,6,$array["absen"],1,0,'C',1);
	$pdf->Cell(60,6,$array["Nama_siswa"],1,0,'L',1);        
	$pdf->Cell(25,6,$array["Nama_Kelas"],1,0,'C',1);   
	$pdf->Cell(10,6,$total_h,1,0,'C',1);   
	$pdf->Cell(10,6,$total_s,1,0,'C',1);   
	$pdf->Cell(10,6,$total_i,1,0,'C',1);   
	$pdf->Cell(10,6,$total_a,1,0,'C',1);   
	$pdf->Cell(10,6,$total_t,1,0,'C',1);
	$pdf->Cell(45,6,$hours.' Jam, '.$minutes.' Menit',1,1,'C',1);
	$x++;
	$j++;
}

$pdf->Output(); 
 
?>