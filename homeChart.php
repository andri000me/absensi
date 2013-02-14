<?php 


include "chart/class/FusionCharts_Gen.php";


$grafik=new FusionCharts("MSColumn2D","500", "357");
$grafik->setSWFPath("chart/Charts/");

$grafik->setChartParams($strParam);

$namahari  = Array("Mon","Tue","Wed","Thu","Fri","Sat");
$namahari2 = Array("Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
$total_telat   = Array();
$total_tidak_telat   = Array();
if($p2 == "guru"){
	$absen = "guru";
}
else if($p2 == "karyawan"){
	$absen = "karyawan";
	
}
else if($p2 != "karyawan" || $p2 != "guru"){
	$absen = "siswa";
}

for($lion=0;$lion<=5;$lion++){
$grafik->addCategory("$namahari2[$lion]");
}

for($anubseran=0;$anubseran<=5;$anubseran++){
	$q_telat		 = mysql_query("select *from absensi_".$absen." where hari='".$namahari[$anubseran]."' and keterangan='h' and terlambat='y' and minggu='$mingguke' and bulan='$today233'");
	$q_tidak_telat	 = mysql_query("select *from absensi_".$absen." where hari='".$namahari[$anubseran]."' and keterangan='h' and terlambat<>'y' and minggu='$mingguke' and bulan='$today233'");
	$total			 = mysql_num_rows($q_telat);
	$total2			 = mysql_num_rows($q_tidak_telat);
	$total_telat[$anubseran] = $total;
	$total_tidak_telat[$anubseran] = $total2;
}
$grafik->addDataSet("tidak telat");
for($naix=0;$naix<=5;$naix++){
$grafik->addChartData("$total_tidak_telat[$naix]","name=" . "" . ";" .$strParam,"" );
}
$grafik->addDataSet("telat");
for($troll=0;$troll<=5;$troll++){
$grafik->addChartData("$total_telat[$troll]","name=" . "" . ";" .$strParam,"" );
}

$grafik->renderChart();

?>






