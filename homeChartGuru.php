<?php 

date_default_timezone_set('Asia/Jakarta');
$q_toptelat_guru1 	= mysql_query("select *from top_telat where id=2");
$top_guru1			= mysql_fetch_array($q_toptelat_guru1);
$guruvalue1			= $top_guru["value"];


$hari_ini	= 	date("d-m-Y");
$bulan		= 	date("m-Y");
							
$q_telat_hari_ini_guru 			= mysql_query("select * from absensi_guru where terlambat='y' and tanggal='$hari_ini'");
$array_telat_hari_ini_guru	    = mysql_num_rows($q_telat_hari_ini_guru);
			
$q_telat_guru =  mysql_query("SELECT count(*) as t,nama,nip from absensi_guru,guru where absensi_guru.guru_nip=guru.nip  and bulan='$today233' and absensi_guru.terlambat='y' group by `guru_nip` order by t desc limit 0,$guruvalue1") or die (mysql_error());

include "chart/class/FusionCharts_Gen.php";

if($array_telat_hari_ini_guru > 0){
	$grafik=new FusionCharts("Pie2D","500", "299");
}
else{
	$grafik=new FusionCharts("Pie2D","100%", "550");
}


$grafik->setSWFPath("chart/Charts/");
$strParam="caption=Top $guruvalue guru Terlambat;decimalPrecision=0";
$grafik->setChartParams($strParam);

while($array_telat2 = mysql_fetch_array($q_telat_guru)){
	$nama	 = $array_telat2["nama"];
	$nip	 = $array_telat2["nip"];
	$telat	 = $array_telat2["t"];
	
	$grafik->addCategory($array_telat2["Nama_siswa"]);
	$grafik->addChartData($telat,"name=" . "$nip-$nama" . ";" .$strParam,"" );
} 


$grafik->renderChart();

?>




