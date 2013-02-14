<?php 
include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("Pie2D","270", "250");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Kehadiran $nama_siswaa;decimalPrecision=0";
$grafik->setChartParams($strParam);

$grafik->addCategory("ABSENSI");
$grafik->addChartData($total_hadir,"name=" . "H" . ";" .$strParam,"" );
$grafik->addChartData($total_sakit,"name=" . "S" . ";" .$strParam,"" );
$grafik->addChartData($total_izin,"name=" . "I" . ";" .$strParam,"" );
$grafik->addChartData($total_alpa,"name=" . "A" . ";" .$strParam,"" );
$grafik->renderChart();
?>






