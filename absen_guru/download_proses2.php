<?php
date_default_timezone_set("Asia/Jakarta");
//koneksi ke database
//ini_set('display_errors',FALSE);
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "absensi";
 
$conn = mysql_connect($host, $user, $pass);
$bulan=$_POST['bulan'];
$tanggal=$_POST['tanggal'];

//-------------------------------------

$tgl_bln = strtotime($tanggal);
$bulan_report=date("d M Y", $tgl_bln);

//-------------------------------------

if ($conn) {
	$open = mysql_select_db("$dbnm");
	if (!$open) {
		die ("Database tidak dapat dibuka karena ".mysql_error());
	}
} else {
	die ("Server MySQL tidak terhubung karena ".mysql_error());
}
//akhir koneksi
 
#ambil data di tabel dan masukkan ke array
$query = "SELECT guru.nip, guru.nama, absensi_guru.tanggal, absensi_guru.waktu, absensi_guru.keterangan FROM absensi_guru, guru where absensi_guru.guru_nip=guru.nip and absensi_guru.tanggal='$tanggal' order by guru.nip";
$sql = mysql_query ($query);
$data = array();


while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$judul = "Laporan Data Guru Tanggal $bulan_report";
$header = array(
		array("label"=>"NIP", "length"=>20, "align"=>"L"),
		array("label"=>"Nama", "length"=>70, "align"=>"L"),
		array("label"=>"Tanggal", "length"=>25, "align"=>"L"),
		array("label"=>"Waktu Hadir", "length"=>35, "align"=>"L"),
		array("label"=>"Ket", "length"=>20, "align"=>"L"),
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