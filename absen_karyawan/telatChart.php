<?php 



//-----------------------------------------------------------------------------------------------------------------------

include "chart/class/FusionCharts_Gen.php";


$bulan_title= date("F");
$tahun_title= date("Y");

$grafik=new FusionCharts("Pie2D","900", "500");
$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Persentasi Perbandingan Keterlambatan Karyawan Bulan $bulan_title Tahun $tahun_title;decimalPrecision=0";
$grafik->setChartParams($strParam);

/*$karyawan_chart=mysql_query("select*from karyawan order by id");
$grafik->addCategory("ABSENSI");
while($row_karyawan=mysql_fetch_array($karyawan_chart)){

$nama=$row_karyawan['nama'];
$bulan = date('m-Y');
$laporan_telat=mysql_query("select * from absensi_karyawan where bulan='$t_bulan' and terlambat='y'");
$total = mysql_num_rows($laporan_telat);

$grafik->addChartData($total,"name=" . "$nama" . ";" .$strParam,"" );


}*/

$karyawan_chart=mysql_query("select*from karyawan order by id");
$grafik->addCategory("ABSENSI");
while($row_karyawan=mysql_fetch_array($karyawan_chart)){

$karyawan=$row_karyawan['nama'];
$bulan = date('m-Y');
$query_chart_karyawan = mysql_query("select * from absensi_karyawan where keterangan='h' and terlambat='y' and bulan='$bulan'");
$total = mysql_num_rows($query_chart_karyawan);

$grafik->addChartData($total ,"name=" . "$karyawan" . ";" .$strParam,"" );


}
$grafik->renderChart();
?>






