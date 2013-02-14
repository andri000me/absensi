<?php 

$hadir = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='h' and tanggal='$tanggal' and keterangan<>'out'");
$alpa = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='a' and tanggal='$tanggal'");
$sakit = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='s' and tanggal='$tanggal'");
$izin = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='i' and tanggal='$tanggal'");
$total_hadir = mysql_num_rows($hadir);
$total_alpa = mysql_num_rows($alpa);
$total_sakit = mysql_num_rows($sakit);
$total_izin = mysql_num_rows($izin);
$query_kelass = mysql_query("select * from kelas where id='$id_kelas'");
$row_kelass = mysql_fetch_array($query_kelass);
$nama_kelass=$row_kelass["Nama_Kelas"];

include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("Pie2D","370", "270");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Kehadiran Kelas $nama_kelass ($tanggal);decimalPrecision=0";
$grafik->setChartParams($strParam);

$grafik->addCategory("ABSENSI");
$grafik->addChartData($total_hadir,"name=" . "Hadir" . ";" .$strParam,"" );
$grafik->addChartData($total_sakit,"name=" . "Sakit" . ";" .$strParam,"" );
$grafik->addChartData($total_izin,"name=" . "Izin" . ";" .$strParam,"" );
$grafik->addChartData($total_alpa,"name=" . "Alpa" . ";" .$strParam,"" );
$grafik->renderChart();
?>







