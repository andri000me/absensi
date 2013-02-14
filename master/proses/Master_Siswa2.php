<?php
include("../../conn/conn.php");
$id 	    = $_GET["id"];
$id_edit	= $_POST["id"];

$password  	= md5($_POST["password"]);
$password2  = md5($_POST["password2"]);
//--------------------------------------------------------------------------



	$query_siswa=mysql_query("select * from siswa where id='$id_edit'");
		
		mysql_query("update siswa set password='$password2' where id='$id_edit'") or die (mysql_error());
		
				if(mysql_affected_row>0){
		header("location:../../index.php");
		}
		else{
			header("location:../../index.php");
}

?>
