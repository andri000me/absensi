<?php 


include "chart/class/FusionCharts_Gen.php";

$grafik=new FusionCharts("MSColumn2D","920", "500");
$grafik->setSWFPath("chart/Charts/");

$strParam="caption=Persentasi Perbandingan Semester tahun ajaran ;decimalPrecision=0";
$grafik->setChartParams($strParam);

	$tahun1=strtok($tahun_ajaran, "-");
	$tahun2=strtok("-");
if($semester == "1"){
	for($bln=7;$bln<=12;$bln++){
		if($bln<10){
			$bln_b = "0".$bln;
		}
		else{
			$bln_b = $bln;
		}
		$bulan = $bln_b."-".$tahun1;
		if($bln == 1){
			$grafik->addCategory("Jan");
		}
		else if($bln == 2){
			$grafik->addCategory("Feb");
		}
		else if($bln == 3){
			$grafik->addCategory("Mar");
		}
		else if($bln == 4){
			$grafik->addCategory("Apr");
		}
		else if($bln == 5){
			$grafik->addCategory("Mei");
		}
		else if($bln == 6){
			$grafik->addCategory("Jun");
		}
		else if($bln == 7){
			$grafik->addCategory("Jul");
		}
		else if($bln == 8){
			$grafik->addCategory("Agu");
		}
		else if($bln == 9){
			$grafik->addCategory("Sep");
		}
		else if($bln == 10){
			$grafik->addCategory("Okt");
		}
		else if($bln == 11){
			$grafik->addCategory("Nov");
		}
		else if($bln == 12){
			$grafik->addCategory("Des");
		}	
	}
	
	$query_kelas = mysql_query("select*from kelas order by Nama_Kelas");
	while($array_kelas=mysql_fetch_array($query_kelas)){
		$id_kelas = $array_kelas["id"];
		$nama_kelas = $array_kelas["Nama_Kelas"];
		$grafik->addDataset($nama_kelas);
		for($bln_b=7;$bln_b<=12;$bln_b++){
			if($bln_b<10){
				$bln_bb = "0".$bln_b;
			}
			else{
				$bln_bb = $bln_b;
			}
			$bulan_b = $bln_bb."-".$tahun1;
			$query_absen_kelas = mysql_query("select count(*) as jml_hadir from absensi_siswa where kd_kelas='$id_kelas' and bulan='$bulan_b' and semester='$semester' and tahun_ajaran='$tahun_ajaran' and keterangan='h' and in_out='out_auto'");
			$array_absen_kelas = mysql_fetch_array($query_absen_kelas);
			$total = $array_absen_kelas["jml_hadir"];
			$grafik->addChartData($total,"name=" ."". ";" .$strParam,"" );
		}
	}
}	

else if($semester == "2"){
	for($bln=1;$bln<=6;$bln++){
		if($bln<10){
			$bln_b = "0".$bln;
		}
		else{
			$bln_b = $bln;
		}
		$bulan = $bln_b."-".$tahun2;
		if($bln == 1){
			$grafik->addCategory("Jan");
		}
		else if($bln == 2){
			$grafik->addCategory("Feb");
		}
		else if($bln == 3){
			$grafik->addCategory("Mar");
		}
		else if($bln == 4){
			$grafik->addCategory("Apr");
		}
		else if($bln == 5){
			$grafik->addCategory("Mei");
		}
		else if($bln == 6){
			$grafik->addCategory("Jun");
		}
		else if($bln == 7){
			$grafik->addCategory("Jul");
		}
		else if($bln == 8){
			$grafik->addCategory("Agu");
		}
		else if($bln == 9){
			$grafik->addCategory("Sep");
		}
		else if($bln == 10){
			$grafik->addCategory("Okt");
		}
		else if($bln == 11){
			$grafik->addCategory("Nov");
		}
		else if($bln == 12){
			$grafik->addCategory("Des");
		}	
	}
	
	$query_kelas = mysql_query("select*from kelas order by Nama_Kelas");
	while($array_kelas=mysql_fetch_array($query_kelas)){
		$id_kelas = $array_kelas["id"];
		$nama_kelas = $array_kelas["Nama_Kelas"];
		$grafik->addDataset($nama_kelas);
		for($bln_b=1;$bln_b<=6;$bln_b++){
			if($bln_b<10){
				$bln_bb = "0".$bln_b;
			}
			else{
				$bln_bb = $bln_b;
			}
			$bulan_b = $bln_bb."-".$tahun2;
			$query_absen_kelas = mysql_query("select count(*) as jml_hadir from absensi_siswa where kd_kelas='$id_kelas' and bulan='$bulan_b' and semester='$semester' and tahun_ajaran='$tahun_ajaran' and keterangan='h' and in_out='out_auto'");
			$array_absen_kelas = mysql_fetch_array($query_absen_kelas);
			$total = $array_absen_kelas["jml_hadir"];
			$grafik->addChartData($total,"name=" ."". ";" .$strParam,"" );
		}
	}
}			
	
	
	
		




	

$grafik->renderChart();

?>







