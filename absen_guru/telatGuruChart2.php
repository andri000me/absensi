<?php 


include "chart/class/FusionCharts_Gen.php";


$bulan_title= date("F");
$tahun_title= date("Y");

$grafik=new FusionCharts("MSColumn2D","900", "350");
$grafik->setSWFPath("chart/Charts/");

$grafik->setChartParams($strParam);


$strParam="caption=Grafik Keterlambatan Karyawan - Tahun $tahun_title;decimalPrecision=0";

$grafik->addDataSet("Terlambat");
for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_telat=mysql_query("select * from absensi_siswa where no_siswa='$nisn_siswa' and bulan='$t_bulan' and terlambat='y'");
$total_telat = mysql_num_rows($laporan_telat);	

$grafik->addCategory("$t_bulan");
$grafik->addChartData($total_telat,"name=" . "" . ";" .$strParam,"" );
}












$grafik->renderChart();

?>






