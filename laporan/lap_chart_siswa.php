<?php
	include "libchart/libchart/classes/libchart.php";
	$chart = new PieChart(270, 200);
	

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Hadir ($total_hadir)", $total_hadir));
	$dataSet->addPoint(new Point("Sakit ($total_sakit)", $total_sakit));
	$dataSet->addPoint(new Point("Izin ($total_izin)", $total_izin));
	$dataSet->addPoint(new Point("Alpa ($total_alpa)", $total_alpa));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Persentasi Kehadiran $nama_siswa");
	$chart->render("libchart/demo/generated/lap_chart.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart pie chart demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	
	<img alt="Pie chart"  src="libchart/demo/generated/lap_chart.png" style="border: 1px solid gray;"/>
	
	<p>
</body>
</html>