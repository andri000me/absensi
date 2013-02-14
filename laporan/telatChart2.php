<?php 


include "chart/class/FusionCharts_Gen12.php";

$grafik=new FusionCharts("MSColumn2D","820", "500");
$grafik->setSWFPath("chart/Charts/");

$grafik->setChartParams($strParam);
for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_telat=mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and bulan='$t_bulan' and terlambat='y'");
$total_telat = mysql_num_rows($laporan_telat);	
$grafik->addCategory("$t_bulan");
$grafik->addChartData($total_telat,"name=" . "" . ";" .$strParam,"" );
}
$grafik->renderChart();

?>






