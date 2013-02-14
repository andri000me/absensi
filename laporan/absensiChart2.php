<?php 
include "chart/class/FusionCharts_Gen2.php";

$grafik=new FusionCharts("MSColumn2D","290", "250");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Absensi Kelas;decimalPrecision=0";
$grafik->setChartParams($strParam);

$grafik->addCategory("KEHADIRAN");


$grafik->addDataset("H");
$grafik->addChartData($total_hadir);
$grafik->addDataset("S");
$grafik->addChartData($total_sakit);
$grafik->addDataset("I");
$grafik->addChartData($total_izin);
$grafik->addDataset("A");
$grafik->addChartData($total_alpa);

$grafik->renderChart();
?>







