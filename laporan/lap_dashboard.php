<?php
include "libchart/libchart/classes/libchart.php";

	$chart = new LineChart(450, 200);

$serie1 = new XYDataSet();
for($x=1;$x<=12;$x++){
	if($x>=10){
	$t_bulan= $x."-".$tahun;
	}
	else{
	$t_bulan= "0".$x."-".$tahun;
	}
	$laporan_hadir=mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$t_bulan' and keterangan='h' and keterangan<>'out'");
	$total_hadir = mysql_num_rows($laporan_hadir);	
		$serie1->addPoint(new Point("$t_bulan", $total_hadir));
}

$serie2 = new XYDataSet();
for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_sakit=mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$t_bulan' and keterangan='s'");
$total_sakit = mysql_num_rows($laporan_sakit);	
	$serie2->addPoint(new Point("$t_bulan", $total_sakit));
	

}

$serie3 = new XYDataSet();
for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_izin=mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$t_bulan' and keterangan='i'");
$total_izin = mysql_num_rows($laporan_izin);	
	$serie3->addPoint(new Point("$t_bulan", $total_izin));
	

}

$serie4 = new XYDataSet();
for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_alpa=mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$t_bulan' and keterangan='a'");
$total_alpa = mysql_num_rows($laporan_alpa);	
	$serie4->addPoint(new Point("$t_bulan", $total_alpa));
	

}

	


	
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Hadir", $serie1);
	$dataSet->addSerie("Sakit", $serie2);
	$dataSet->addSerie("Izin", $serie3);
	$dataSet->addSerie("Alpha", $serie4);
	
	$chart->setDataSet($dataSet);

	$chart->setTitle("Grafik Kehadiran $nama_siswa - Tahun $tahun");
	$chart->getPlot()->setGraphCaptionRatio(0.62);
	$chart->render("libchart/demo/generated/dash_kehadiran.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="libchart/demo/generated/dash_kehadiran.png" style="border: 1px solid gray;"/>
</body>
</html>
