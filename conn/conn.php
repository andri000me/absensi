<?php 
ini_set('display_errors',false);
$host="localhost";
$user="root";
$pass="";
$db="absensi";


$koneksi=mysql_connect($host,$user,$pass);
mysql_select_db($db,$koneksi);
$tanggal=date("d/m/Y");

if ($koneksi)
{
	//echo "berhasil : )";
}else{
	?><script language="javascript">alert("Gagal Koneksi Database MySql !!")</script><?php 
}

?>
