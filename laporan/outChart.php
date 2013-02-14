<?php 


include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("MSColumn2D","820", "500");
$grafik->setSWFPath("chart/Charts/");

$strParam="caption=Persentasi Perbandingan Tidak Absen Pulang ;decimalPrecision=0";
$grafik->setChartParams($strParam);

$q_kelas=mysql_query("select * from kelas");
while($a_kelas=mysql_fetch_array($q_kelas)){
$id_kelas = $a_kelas["id"];
$nama_kelas = $a_kelas["Nama_Kelas"];

$q_outAuto=mysql_query("SELECT count(*) as total from absensi_siswa where kd_kelas='$id_kelas' and bulan='$tanggal_bulan' and in_out='out_auto'");
$a_outAuto=mysql_fetch_array($q_outAuto);
$total = $a_outAuto["total"];

$grafik->addCategory($nama_kelas);
$grafik->addChartData($total,"name=" . "" . ";" .$strParam,"" );
}
$grafik->renderChart();


?>






