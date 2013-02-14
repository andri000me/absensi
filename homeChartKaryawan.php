<?php 

date_default_timezone_set('Asia/Jakarta');
$q_toptelat_karyawan1 	= mysql_query("select *from top_telat where id=3");
$top_karyawan1			= mysql_fetch_array($q_toptelat_karyawan1);
$karyawanvalue1			= $top_karyawan1["value"];


$hari_ini	= 	date("d-m-Y");
$bulan		= 	date("m-Y");
							
$q_telat_hari_ini_karyawan 			= mysql_query("select * from absensi_karyawan where terlambat='y' and tanggal='$hari_ini'");
$array_telat_hari_ini_karyawan	    = mysql_num_rows($q_telat_hari_ini_karyawan);
			
$q_telat_karyawan =  mysql_query("SELECT count(*) as t,nama,nup from absensi_karyawan,karyawan where absensi_karyawan.karyawan_nup=karyawan.nup  and bulan='$today233' and absensi_karyawan.terlambat='y' group by `karyawan_nup` order by t desc limit 0,$karyawanvalue1") or die (mysql_error());

include "chart/class/FusionCharts_Gen.php";

if($array_telat_hari_ini_karyawan > 0){
	$grafik=new FusionCharts("Pie2D","500", "299");
}
else{
	$grafik=new FusionCharts("Pie2D","500", "550");
}


$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Top $karyawanvalue1 Karyawan Terlambat;decimalPrecision=0";
$grafik->setChartParams($strParam);

while($array_telat2 = mysql_fetch_array($q_telat_karyawan)){
	$nama	 = $array_telat2["nama"];
	$nup	 = $array_telat2["nup"];
	$telat	 = $array_telat2["t"];
	
	$grafik->addCategory($array_telat2["nama"]);
	$grafik->addChartData($telat,"name=" . "$nama" . ";" .$strParam,"" );
} 


$grafik->renderChart();

?>




