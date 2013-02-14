<?php 
include "chart/class/FusionCharts_Gen4.php";

$grafik=new FusionCharts("Pie2D","270", "200");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Kelas;decimalPrecision=0";
$grafik->setChartParams($strParam);

$grafik->addCategory("H");
$grafik->addChartData($total_hadir);
$grafik->addCategory("S");
$grafik->addChartData($total_sakit);
$grafik->addCategory("I");
$grafik->addChartData($total_izin);
$grafik->addCategory("A");
$grafik->addChartData($total_alpa);

$grafik->renderChart();
?>













