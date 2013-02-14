<?php
						//$query = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and bulan='$tanggal' ORDER BY tanggal");
						$hadir = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='h' and tanggal='$tanggal'");
						$alpa = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='a' and tanggal='$tanggal'");
						$sakit = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='s' and tanggal='$tanggal'");
						$izin = mysql_query("SELECT * FROM absensi_karyawan WHERE keterangan='i' and tanggal='$tanggal'");
						$total_hadir = mysql_num_rows($hadir);
						$total_alpa = mysql_num_rows($alpa);
						$total_sakit = mysql_num_rows($sakit);
						$total_izin = mysql_num_rows($izin);
						







	include "libchart/libchart/classes/libchart.php";
	$chart = new PieChart(350, 280);
	

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Hadir ($total_hadir)", $total_hadir));
	$dataSet->addPoint(new Point("Sakit ($total_sakit)", $total_sakit));
	$dataSet->addPoint(new Point("Izin ($total_izin)", $total_izin));
	$dataSet->addPoint(new Point("Alpa ($total_alpa)", $total_alpa));
	$chart->setDataSet($dataSet);

	$chart->setTitle("Persentasi Kehadiran Karyawan tanggal : $tanggal");
	$chart->render("libchart/demo/generated/lap_chart_ini_kar.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Libchart pie chart demonstration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	
	<img alt="Pie chart"  src="libchart/demo/generated/lap_chart_ini_kar.png" style="border: 1px solid gray;" width=90% height=90%/>
	
	<p>
</body>
</html>