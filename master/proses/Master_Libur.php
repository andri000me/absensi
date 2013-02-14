<?php
include("../../conn/conn.php");
$id 	= $_GET["id"];
$id2 	= $_POST["id2"];
$delete = $_GET["delete"];
$include = $_POST["include"];
$keterangan 	= $_POST["keterangan"];
$tanggal_mulai 	= $_POST["tanggal_mulai"];
$tanggal_akhir	= $_POST["tanggal_akhir"];
$id_kelas		= $_POST["id_kelas"];
$tipe			= $_POST["tipe"];


if($id == $id && $delete == "delete"){
	mysql_query("delete from hari_libur where id='$id'");
	header("location:../../index.php?page=Master_Libur");	
}

else if($keterangan == "" || $tanggal_mulai == "" || $tanggal_akhir == "")
{	
	header("location:../../index.php?page=input_error_libur");
}
else if($include=="edit" ){

	mysql_query("update hari_libur set keterangan='$keterangan', tanggal_mulai='$tanggal_mulai', tanggal_akhir='$tanggal_akhir',tipe='$tipe',id_kelas='$id_kelas' where id='$id2'") or die (mysql_error());
		
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Libur");
	}
	else{
		header("location:../../index.php?page=Master_Libur");
	}
	print $keterangan.$tanggal_mulai.$tanggal_akhir.$id2;
}

else{
mysql_query("insert into hari_libur(keterangan,tanggal_mulai,tanggal_akhir,tipe,id_kelas) values('$keterangan','$tanggal_mulai','$tanggal_akhir','$tipe','$id_kelas')") or die(mysql_error());

	if(mysql_affected_row>0){
		header("location:Master_Libur");
	}
	else{
		header("location:../../index.php?page=Master_Libur");
	}
}
?>