<?php
include("../../conn/conn.php");
date_default_timezone_set('Asia/Jakarta');

include("parse.php");
$q2	=	mysql_query("select *from fp");
$nama_panggilan = "";
$id 	= $_GET["id"];
$delete = $_GET["delete"];
$nip 	= $_POST["nip"];
$nama 	= $_POST["nama"];
$id_finger 	= $_POST["id_finger"];
$pass 	= md5($_POST["pass"]);
$file 	= $_FILES["foto"]["tmp_name"];
$foto 	= $_FILES["foto"]["name"]; 
$id2	= $_POST["id"];

$q_guru = mysql_query("select *from guru where No='$id'");
$a_guru = mysql_fetch_array($q_guru);
$nip2    = $a_guru["nip"];
$id_finger2    = $a_guru["id_finger"];
$PIN = $id_finger2;


if($id == $id && $delete == "delete"){
	
	mysql_query("delete from guru where No='$id'");
	mysql_query("delete from absensi_guru where id_finger='$id_finger2'");
	header("location:../../index.php?page=Master_Guru");	
		//untuk delete user fp-------------------------------------------------------------------------------------------------
	while($array2=mysql_fetch_array($q2)){
			$IP=$array2["ip"];
			$Key=$array2["key"];
			include("../../absen_fp/delete_user.php");		
		}
//---------------------------------------------------------------------------------------------------------------------
}

else if($nip == "" || $nama == "" || $pass == "")
{	
	header("location:../../index.php?page=input_error_guru");
}
else if($id2 > 0){

if(!empty($foto))
{
		//untuk input mesin fp-------------------------------------------------------------------------------------------------
		while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
		}
		//---------------------------------------------------------------------------------------------------------------------
	mysql_query("update guru set nip='$nip', id_finger='$id_finger', nama='$nama', pasword='$pass', foto='$foto' where No='$id2'");
 	
	move_uploaded_file($file,"../foto/".$foto) ;	
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Guru");
	}
	else{
		header("location:../../index.php?page=Master_Guru");
	}
}
else
{
		//untuk input mesin fp-------------------------------------------------------------------------------------------------
		while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
		}
		//---------------------------------------------------------------------------------------------------------------------
	mysql_query("update guru set nip='$nip', id_finger='$id_finger',nama='$nama', pasword='$pass' where No='$id2'");
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Guru");
	}
	else{
		header("location:../../index.php?page=Master_Guru");
	}
}
}

else{
mysql_query("insert into guru(nip,id_finger,nama,pasword,foto) values('$nip','$id_finger','$nama','$pass','$foto')") or die(mysql_error());

//----input fp-----
while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
}
			//=================

move_uploaded_file($file,"../foto/".$foto) ;
	if(mysql_affected_row>0){
		header("location:Master_Guru");
	}
	else{
		header("location:../../index.php?page=Master_Guru");
	}
}
?>