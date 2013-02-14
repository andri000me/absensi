<?php
//koneksi ke database
ini_set('display_errors',FALSE);
include("../../conn/conn.php");
//akhir koneksi
 $nama = $_POST["nama_siswa"];
#ambil data di tabel dan masukkan ke array
//-----------------------------------------------------------------------------
if($_POST["jenis_laporan"] == "semester"){
$semester = $_POST["semester"];
$tahun_ajaran = $_POST["tahun_ajaran"];
$in_out = $_POST["in_out"];
$nis = $_POST["nis"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.semester='$semester' and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
$judul = "LAPORAN DATA SISWA $nama SEMESTER $semester TAHUN AJARAN = $tahun_ajaran";
}
else if($_POST["jenis_laporan"] == "out_semester"){
$semester = $_POST["semester"];
$tahun_ajaran = $_POST["tahun_ajaran"];
$in_out = $_POST["in_out"];
$nis = $_POST["nis"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.semester='$semester' and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='out_auto' order by absensi_siswa.tanggal";
$judul = "LAPORAN DATA SISWA $nama SEMESTER $semester TAHUN AJARAN = $tahun_ajaran";
}
else if($_POST["jenis_laporan"] == "tahun_ajaran"){
$tahun_ajaran = $_POST["tahun_ajaran"];
$in_out = $_POST["in_out"];
$nis = $_POST["nis"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
$judul = "LAPORAN DATA SISWA $nama TAHUN AJARAN = $tahun_ajaran";
}
else if($_POST["jenis_laporan"] == "perbulan"){
$tgl_bulan = $_POST["bulan"];
$nis = $_POST["nis"];
$in_out = $_POST["in_out"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.bulan='$tgl_bulan' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
$bln = strtotime("1-".$tgl_bulan);
$bulan_report=date("M Y", $bln);
$judul = "LAPORAN DATA SISWA $nama  BULAN $bulan_report";
}
else if($_POST["jenis_laporan"] == "pertanggal"){
$tgl_bulan = $_POST["bulan"];
$tgl_start = $_POST["mulai"];
$tgl_finish = $_POST["akhir"];
$nis = $_POST["nis"];
$in_out = $_POST["in_out"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.tanggal between '$tgl_start' and '$tgl_finish' and absensi_siswa.bulan='$tgl_bulan' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
$judul = "LAPORAN DATA SISWA $nama PERIODE TANGGAL $tgl_start s/d $tgl_finish";
}
//-----------------------------------------------------------------------------
$sql = mysql_query ($select);
$data = array();
while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}
 
#setting judul laporan dan header tabel
$header = array(
		array("label"=>"NIS", "length"=>20, "align"=>"C"),
		array("label"=>"Absen", "length"=>15, "align"=>"C"),
		array("label"=>"Nama Siswa", "length"=>50, "align"=>"C"),
		array("label"=>"Kelas", "length"=>30, "align"=>"C"),
		array("label"=>"Tanggal", "length"=>27, "align"=>"C"),
		array("label"=>"Waktu", "length"=>27, "align"=>"C"),
		array("label"=>"Ket", "length"=>20, "align"=>"C"),
	);
 
#sertakan library FPDF dan bentuk objek
require_once ("fpdf/fpdf.php");
$pdf = new FPDF();
$pdf->AddPage();
 
#tampilkan judul laporan
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,20, $judul, '0', 1, 'C');
 
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(30,100,100);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(30,100,100);
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