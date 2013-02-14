<?php	

//error_reporting(e_all);
include("../../conn/conn.php");
date_default_timezone_set('Asia/Jakarta');
include("parse.php");
$q2	=	mysql_query("select *from fp");


$id = $_GET["id"];


	$query_karyawan=mysql_query("select * from karyawan where id='$id'");
	$array_karyawan=mysql_fetch_array($query_karyawan);
	$PIN=$array_karyawan["id_finger"];
	$absen_karyawan=$array_karyawan["id_finger"];
	$jml_absen=mysql_query("select * from absensi_karyawan where id_finger='$absen_karyawan'");
	$total_absen=mysql_num_rows($jml_absen);
	
	for($a=1;$a<=$total_absen;$a++){
		mysql_query("delete from absensi_karyawan where id_finger='$absen_karyawan'");
	}
	
	mysql_query("delete from karyawan where id='$id'");
	

		header("location:../../index.php?page=Master_Karyawan");

	//untuk delete user fp-------------------------------------------------------------------------------------------------
	
	while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/delete_user.php");
			}
	//---------------------------------------------------------------------------------------------------------------------
?>