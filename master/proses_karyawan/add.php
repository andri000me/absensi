<?php
error_reporting(e_all);
include("../../conn/conn.php");
date_default_timezone_set('Asia/Jakarta');

include("parse.php");
$q2	=	mysql_query("select *from fp");



$nama_panggilan = "";
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

$q_karyawan = mysql_query("select *from karyawan where nup='$nup'");
$a_karyawan = mysql_fetch_array($q_karyawan);
if($nup=="" || $nama==""){
header("location:../../index.php?page=input_error_karyawan");
}
else if(!empty($a_karyawan)){
header("location:../../index.php?page=input_error_karyawan_nup");
}
else{
		
		//untuk input mesin fp-------------------------------------------------------------------------------------------------
		while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
		}
			//---------------------------------------------------------------------------------------------------------------------
		mysql_query("insert into karyawan(nup,id_finger,nama,tempat_lahir,tanggal_lahir,agama,alamat,foto) values('$nup','$id_finger','$nama','$tempat_lahir','$tgl_lahir','$agama','$alamat','$foto')") or die(mysql_error());
		move_uploaded_file($file,"../foto-karyawan/".$foto) ;
		if(mysql_affected_row>0){
			header("location:add");
		}
		else{
			header("location:../../index.php?page=Master_Karyawan");
		}
	}