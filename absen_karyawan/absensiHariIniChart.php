<?php 

$hadir = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='h' and tanggal='$tanggal'");
$alpa = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='a' and tanggal='$tanggal'");
$sakit = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='s' and tanggal='$tanggal'");
$izin = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='i' and tanggal='$tanggal'");
$total_hadir = mysql_num_rows($hadir);
$total_alpa = mysql_num_rows($alpa);
$total_sakit = mysql_num_rows($sakit);
$total_izin = mysql_num_rows($izin);

include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("Pie2D","400", "270");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Kehadiran Karyawan Hari Ini ($tanggal);decimalPrecision=0";
$grafik->setChartParams($strParam);

$grafik->addCategory("ABSENSI");
$grafik->addChartData($total_hadir,"name=" . "Hadir" . ";" .$strParam,"" );
$grafik->addChartData($total_sakit,"name=" . "Sakit" . ";" .$strParam,"" );
$grafik->addChartData($total_izin,"name=" . "Izin" . ";" .$strParam,"" );
$grafik->addChartData($total_alpa,"name=" . "Alpa" . ";" .$strParam,"" );
$grafik->renderChart();
?>







