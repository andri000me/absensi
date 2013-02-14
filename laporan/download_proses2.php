<?php
//koneksi ke database
ini_set('display_errors',FALSE);

include("../conn/conn.php");
//akhir koneksi
 
#ambil data di tabel dan masukkan ke array
$id_kelas=$_POST['id_kelas'];
$tanggal=$_POST['tanggal'];
//-------------------------------------

$tgl_bln = strtotime($tanggal);
$bulan_report=date("d M Y", $tgl_bln);

//-------------------------------------
$bulan=$_POST['bulan'];
$nama_kelas=$_POST['nama_kelas'];
$query = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and absensi_siswa.kd_kelas='$id_kelas' and absensi_siswa.tanggal='$tanggal' and absensi_siswa.keterangan<>'out' order by siswa.absen";
$sql = mysql_query ($query);
$data = array();
while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$judul = "LAPORAN DATA KELAS $nama_kelas TANGGAL $bulan_report";
$header = array(
		array("label"=>"NIS", "length"=>20, "align"=>"L"),
		array("label"=>"Absen", "length"=>14, "align"=>"L"),
		array("label"=>"Nama Siswa", "length"=>50, "align"=>"L"),
		array("label"=>"Kelas", "length"=>25, "align"=>"L"),
		array("label"=>"Tanggal", "length"=>25, "align"=>"L"),
		array("label"=>"Waktu", "length"=>25, "align"=>"L"),
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