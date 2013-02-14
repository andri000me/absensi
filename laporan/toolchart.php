
	<?php
						$nis_s=$row_siswa["nis"];
					//	$query = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and bulan='$tanggal_bulan'");
						$hadir_s = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='h' and bulan='$tanggal_bulan' and no_siswa='$nis_s'");
						$alpa_s = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='a' and bulan='$tanggal_bulan' and no_siswa='$nis_s'");
						$sakit_s = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='s' and bulan='$tanggal_bulan' and no_siswa='$nis_s'");
						$izin_s = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='i' and bulan='$tanggal_bulan' and no_siswa='$nis_s'");
						$total_hadir_s = mysql_num_rows($hadir_s);
						$total_alpa_s = mysql_num_rows($alpa_s);
						$total_sakit_s = mysql_num_rows($sakit_s);
						$total_izin_s = mysql_num_rows($izin_s);
						//$query_kelass = mysql_query("select * from kelas where id='$id_kelas'");
						//$row_kelass = mysql_fetch_array($query_kelass);
						//$nama_kelass=$row_kelass["Nama_Kelas"];
					//echo $total_izin;
				//	$id_siswa = $query_siswa["id"];
					?>

<?php

	include "libchart/libchart/classes/libchart.php";

	$chart = new VerticalBarChart(350, 200);

	$dataSet = new XYDataSet();
	$dataSet->addPoint(new Point("Hadir", $total_hadir_s));
	$dataSet->addPoint(new Point("Sakit", $total_sakit_s));
	$dataSet->addPoint(new Point("Izin", $total_izin_s));
	$dataSet->addPoint(new Point("Alpa", $total_alpa_s));
	$chart->setDataSet($dataSet);

	$chart->setTitle("kehadiran ".$row_siswa['Nama_siswa']);
	$chart->render("libchart/demo/generated/toolchart".$row_siswa['id'].".png");
?>
<center>	<img src='libchart/demo/generated/toolchart<?php echo $row_siswa['id']; ?>.png' style='border: 1px solid gray;' width='97%'/></center>
