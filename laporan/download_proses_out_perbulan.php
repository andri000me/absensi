<?php
date_default_timezone_set("Asia/Jakarta");
//koneksi ke database
//ini_set('display_errors',FALSE);
include("../conn/conn.php");
 

$id_kls=$_POST['kelas'];
$nis=$_POST['nis'];
$bulan=$_POST['bulan'];
$nama_kelas=$_POST['nama_kelas'];
$tanggal_bulan=$_POST['tanggal_bulan'];

//-------------------------------------
$togel = "1-".$tanggal_bulan;
$tgl_bln = strtotime($togel);
$bulan_report=date("M Y", $tgl_bln);

//-------------------------------------

//akhir koneksi
 
#ambil data di tabel dan masukkan ke array
$query = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal FROM absensi_siswa, siswa, kelas where siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.bulan='$tanggal_bulan' and absensi_siswa.in_out='out_auto' order by absensi_siswa.tanggal";
$sql = mysql_query ($query) or die (mysql_error());
$data = array();


while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$judul = "Laporan Tidak Absen Bulan Bulan $bulan_report";
$header = array(
		array("label"=>"NIS", "length"=>20, "align"=>"L"),
		array("label"=>"Absen", "length"=>14, "align"=>"L"),
		array("label"=>"Nama Siswa", "length"=>80, "align"=>"L"),
		array("label"=>"Nama Kelas", "length"=>30, "align"=>"L"),
		array("label"=>"Tanggal", "length"=>40, "align"=>"L"),
	);
 
#sertakan library FPDF dan bentuk objek
require_once ("fpdf/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
 
#tampilkan judul laporan
$pdf->SetFont('Arial','B','16');
$pdf->Cell(0,20, $judul, '0', 1, 'C');
 
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
 
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
	$i = 0;
	foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
		$i++;
	}
	$fill = !$fill;
	$pdf->Ln();
}
 
#output file PDF
$pdf->Output();
?>