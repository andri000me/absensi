<?php
include("../../conn/conn.php");
$id 			= $_GET["id"];
$delete 		= $_GET["delete"];
$id2 			= $_POST["id"];
$nama 			= $_POST["nama"];
$keterangan 	= $_POST["keterangan"];

$q_jurusan 		= mysql_query("select *from jurusan where nama = '$nama'");
$array_jurusan	= mysql_fetch_array($q_jurusan);

if($id == $id && $delete == "delete"){
	mysql_query("delete from jurusan where id='$id'");
	header("location:../../index.php?page=Master_Jurusan");	
}

else if($nama == "")
{	
	header("location:../../index.php?page=input_error_jurusan");
}
if($id2>0){
	
	mysql_query("update jurusan set nama='$nama', keterangan='$keterangan' where id='$id2'");
	mysql_query("update kelas set Nama_Kelas='X-$nama' where id_jurusan='$id2 X'") or die (mysql_error());
	mysql_query("update kelas set Nama_Kelas='XI-$nama' where id_jurusan='$id2 XI'")or die (mysql_error());
	mysql_query("update kelas set Nama_Kelas='XII-$nama' where id_jurusan='$id2 XII'")or die (mysql_error());
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Jurusan");
	}
	else{
		header("location:../../index.php?page=Master_Jurusan");
	}
}
else if($array_jurusan["nama"]==$nama&&$delete==""){
	header("location:../../index.php?page=Master_Jurusan_err");
}
else if($nama!="" && $id=="" && $delete=="")
{
	mysql_query("insert into jurusan(nama,keterangan) values('$nama','$keterangan')");
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Jurusan");
	}
	else{
		header("location:../../index.php?page=Master_Jurusan");
	}
	
}
?>