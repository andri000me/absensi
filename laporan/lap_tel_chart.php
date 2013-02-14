<?php
	include "libchart/libchart/classes/libchart.php";
//-----------------------------------------------------------------------------------------------------------------------
$kelas_chart=mysql_query("select*from kelas order by id");
//-----------------------------------------------------------------------------------------------------------------------
	
	
	$chart = new PieChart(800, 500);
	

	$dataSet = new XYDataSet();
	
	
//-----------------------------------------------------------------------------------------------------------------------
while($row_kelas=mysql_fetch_array($kelas_chart)){
$kelas=$row_kelas['Nama_Kelas'];
$id_kelas_chart=$row_kelas['id'];
$bulan = date('m-Y');
$query_chart_kelas = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas_chart' and keterangan='h' and terlambat='y' and bulan='$bulan' and keterangan<>'out'");
$chart_kelas = mysql_num_rows($query_chart_kelas);
$dataSet->addPoint(new Point("$kelas ($chart_kelas)", $chart_kelas));

}
//-----------------------------------------------------------------------------------------------------------------------



	$bulan_title= date("F");
	$tahun_title= date("Y");
	$chart->setDataSet($dataSet);

	$chart->setTitle("Persentasi Perbandingan Keterlambatan SMKN10 Bulan $bulan_title Tahun $tahun_title");
	$chart->render("libchart/demo/generated/lap_tel_chart.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart pie chart demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	
	<img alt="Pie chart"  src="libchart/demo/generated/lap_tel_chart.png" style="border: 1px solid gray;"/>
	
	<p>
</body>
</html>