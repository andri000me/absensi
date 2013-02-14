
<?php
date_default_timezone_set('Asia/Jakarta');

$usr=$_SESSION['user'];
$q4=mysql_query("select *from siswa where id='$usr'");
$array4 = mysql_fetch_array($q4);
$nis_siswa = $array4["nis"];
$nama_siswa = $array4['Nama_siswa'];
$tahun=date("Y");
//------------------refresh-phpFP-----------------------------------------------------
//include("absen_fp/proses_fp.php");
//------------------------------------------------------------------------------------

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>	
	<table>
		<tr>
			<td colspan='2' align='center'><h2 style='color:red'>Absensi <?php echo  $nama_siswa;?></h2></td>
		</tr>
	
		<tr>
			<td align = "center">
			<br>
				<?php include "laporan/dashboardSiswaChart1.php";?><br><br>
			</td>
	
		</tr>
	</table>
</body>
</html>