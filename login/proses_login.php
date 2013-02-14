<?php
session_start();

include("../conn/conn.php");

$choose  = $_POST['choose'];
$user	 = $_POST['username'];
$pass	 = md5($_POST['password']);

$row_admin 	= mysql_query("select *from admin where user='$user' and pass='$pass'");
$row_guru	= mysql_query("select *from guru where nip='$user' and pasword='$pass'");
$row_siswa 	= mysql_query("select *from siswa where nis='$user' and password='$pass'");

$array_admin = mysql_fetch_array($row_admin);
$array_guru  = mysql_fetch_array($row_guru);
$array_siswa = mysql_fetch_array($row_siswa);

if($choose == "guru" && $user == $array_guru["nip"] && $pass == $array_guru["pasword"]){
	$_SESSION["guru"] = $array_guru["No"];
	header("location:../index.php");
}

else if($choose == "siswa" && $user == $array_siswa["nis"] && $pass == $array_siswa["password"]){
	$_SESSION["user"]    = $array_siswa["id"];
	header("location:../index.php");
}
else if($choose == "admin" && $user == $array_admin["user"] && $pass == $array_admin["pass"]) {
	$_SESSION["admin"]  = $array_admin["user"];
	header("location:../index.php");
}
else{
	header("location:../index.php?login=failed");
}
?>
