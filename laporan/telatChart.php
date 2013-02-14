<?php 

include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("Pie2D","820", "500");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Perbandingan Keterlambatan Siswa Tahun $tahun;decimalPrecision=0";
$grafik->setChartParams($strParam);

$kelas_chart=mysql_query("select*from kelas order by id");
$grafik->addCategory("ABSENSI");
while($row_kelas=mysql_fetch_array($kelas_chart)){

$kelas=$row_kelas['Nama_Kelas'];
$id_kelas_chart=$row_kelas['id'];	
$query_chart_kelas = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas_chart' and keterangan='h' and terlambat='y' and bulan like '%$tahun'");
$chart_kelas = mysql_num_rows($query_chart_kelas);

$grafik->addChartData($chart_kelas,"name=" . "$kelas" . ";" .$strParam,"" );


}
$grafik->renderChart();
?>






