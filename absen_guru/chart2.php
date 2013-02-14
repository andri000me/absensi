<?php

	include "libchart/libchart/classes/libchart.php";

	$chart = new VerticalBarChart(350, 200);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Hadir", $total_hadir. " orang"));
	$dataSet->addPoint(new Point("Sakit", $total_sakit. " orang"));
	$dataSet->addPoint(new Point("Izin", $total_izin. " orang"));
	$dataSet->addPoint(new Point("Alpa", $total_alpa. " orang"));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Jumlah Kehadiran Karyawan");
	$chart->render("libchart/demo/generated/lap_chart2_karyawan.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart vertical bars demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Vertical bars chart" src="libchart/demo/generated/lap_chart2_karyawan.png" style="border: 1px solid gray;"/>
</body>
</html>