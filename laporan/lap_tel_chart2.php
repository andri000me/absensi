<?php
	include "libchart/libchart/classes/libchart.php";

	$chart = new LineChart(500, 200);

	$dataSet = new XYDataSet();

for($x=1;$x<=12;$x++){
if($x>=10){
$t_bulan= $x."-".$tahun;
}
else{
$t_bulan= "0".$x."-".$tahun;
}
$laporan_telat=mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and bulan='$t_bulan' and terlambat='y' and keterangan<>'out'");
$total_telat = mysql_num_rows($laporan_telat);	
	$dataSet->addPoint(new Point("$t_bulan", $total_telat));
}
$q_kelas = mysql_query("select * from kelas where id='$id_kelas'");
$ar_kelas = mysql_fetch_array($q_kelas);
$nama_kelas = $ar_kelas["Nama_Kelas"];

	$chart->setDataSet($dataSet);

	$chart->setTitle("Grafik Keterlambatan Kelas $nama_kelas - Tahun $tahun");
	$chart->render("libchart/demo/generated/lap_tel_chart2.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart line demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="libchart/demo/generated/lap_tel_chart2.png" style="border: 1px solid gray;"/>
</body>
</html>
