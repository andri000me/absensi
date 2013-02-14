<?php
include("../../conn/conn.php");
date_default_timezone_set('Asia/Jakarta');
include("parse.php");
$q2	=	mysql_query("select *from fp");



$id		= $_POST["id"];
$nup		= $_POST["nup"];
$nis		= $nup;
$nama    	= $_POST["nama"];
$tempat_lahir = $_POST["tempat_lahir"];
$tgl_lahir 	= $_POST["tgllahir"];
$agama		= $_POST["agama"];
$id_finger		= $_POST["id_finger"];
$alamat = $_POST["alamat"];
$file   	= $_FILES["foto"]["tmp_name"];
$foto   	= $_FILES["foto"]["name"]; 



if($nup=="" || $nama==""){
header("location:../../index.php?page=input_error_karyawan");
}

else{

	
	$query_karyawan=mysql_query("select * from karyawan where id='$id'");
	$array_karyawan=mysql_fetch_array($query_siswa);
	$absen_karyawan=$array_karyawan["id_finger"];
	$jml_absen=mysql_query("select * from absensi_karyawan where id_finger='$absen_karyawan'");
	$total_absen=mysql_num_rows($jml_absen);
	
	for($a=1;$a<=$total_absen;$a++){
	mysql_query("update absensi_karyawan set karyawan_nup='$nup' where id_finger='$absen_karyawan'");
	}
	
	if(!empty($foto)){
		//untuk input mesin fp-------------------------------------------------------------------------------------------------
			while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
			}
		//---------------------------------------------------------------------------------------------------------------------
		mysql_query("update karyawan set nup='$nup', id_finger='$id_finger', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tgl_lahir', agama='$agama', alamat='$alamat', foto='$foto' where id='$id'");
		move_uploaded_file($file,"../foto-siswa/".$foto) ;
	
	if(mysql_affected_row>0){
			header("location:Master_Karyawan");
		}
		else{
			header("location:../../index.php?page=Master_Karyawan");
		}
	}
	else{
		//untuk input mesin fp-------------------------------------------------------------------------------------------------
		while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
			}
		//---------------------------------------------------------------------------------------------------------------------
		mysql_query("update karyawan set nup='$nup', id_finger='$id_finger', nama='$nama', tempat_lahir='$tempat_lahir', tanggal_lahir='$tgl_lahir', agama='$agama',  alamat='$alamat' where id='$id'");

		if(mysql_affected_row>0){
			header("location:Master_Karyawan");
		}
		else{
			header("location:../../index.php?page=Master_Karyawan");
		}
	}				
}
?>