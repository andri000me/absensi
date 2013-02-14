<?php
include("../../conn/conn.php");
$id 	= $_GET["id"];
$id2 	= $_POST["id2"];
$delete = $_GET["delete"];
$include = $_POST["include"];
$keterangan 	= $_POST["keterangan"];
$tanggal_mulai 	= $_POST["tanggal_mulai"];



if($id == $id && $delete == "delete"){
	mysql_query("delete from pengumuman where id='$id'");
	header("location:../../index.php?page=Master_Pengumuman");	
}

else if($keterangan == "" || $tanggal_mulai == "")
{	
	header("location:../../index.php?page=input_error_pengumuman");
}
else if($include=="edit" ){

	mysql_query("update pengumuman set isi='$keterangan', tanggal_mulai='$tanggal_mulai' where id='$id2'") or die (mysql_error());
		
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Pengumuman");
	}
	else{
		header("location:../../index.php?page=Master_Pengumuman");
	}
	print $keterangan.$tanggal_mulai.$tanggal_akhir.$id2;
}

else{
mysql_query("insert into pengumuman(isi,tanggal_mulai) values('$keterangan','$tanggal_mulai')") or die(mysql_error());

	if(mysql_affected_row>0){
		header("location:Master_Pengumuman");
	}
	else{
		header("location:../../index.php?page=Master_Pengumuman");
	}
}
?>