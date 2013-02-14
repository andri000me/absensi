<?php
include("conn/conn.php");
//--------------------------------------------------------------------

$page = $_GET['page_laporan'];
if( !isset($_GET['page_laporan']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_laporan'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;
//--------------------------------------------------------------------
$default_bulan = date('m');
$default_tahun = date('Y');

//echo $default_tahun;

$tahun = $_POST["tahun"];
if($tahun=="") $tahun=$default_tahun;

$bulan = $_POST["bulan"];
if($bulan=="") $bulan=$default_bulan;

if($_SESSION['admin']){
	/*$id_kelas = $_POST["id_kelas"];	
	if($id_kelas=="") {
						$id_kelas=$_GET["id_kelas"];
						if($id_kelas=="") {	$q_q = mysql_query("select *from kelas order by Nama_Kelas");
							$a_a = mysql_fetch_array($q_q);
						$id_kelas=$a_a["id"];
						}
					}
*/
					}
else{
/*
$kelas_wali=mysql_query("select *from kelas where id_guru='$guru'");
$array_kelas_wali=mysql_fetch_array($kelas_wali);
$id_kelas=$array_kelas_wali["id"];
*/
}

$nis_siswa = $_POST["nis_siswa"];

$tanggal_bulan=$bulan."-".$tahun;
//echo $tanggal_bulan;
?>

<head>
<link rel="stylesheet" href="UniAdmin_files/tooltip.css" type="text/css"></link>
</head>
<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
					
						
					</ul>
					
					<h2>Laporan Absensi Siswa Periode Bulan</h2>
				</div>
				
				<div class="box-body clear">
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=absen_siswa_perbulan">
				<?php if($_SESSION['admin']){// $query_kelas=mysql_query("select*from kelas order by Nama_Kelas"); ?>NIS Siswa :
				<input type='text' name='nis_siswa' placeholder='NIS' value='<?php print $nis_siswa?>'></input>

				<!-------------------------------------------------------------------------------------------------------------------->
					<!--<select name="id_kelas">
						<?php /*while($array_kelas=mysql_fetch_array($query_kelas)){
						echo "<option ";
						//----------------------------------------------------------------
						if($id_kelas == ""){ echo "&nbsp;"; } 
						else if($id_kelas != $array_kelas['id']){echo "&nbsp; "; } 
						else if($id_kelas == $array_kelas['id']){ echo "selected='true' ";} 

						//----------------------------------------------------------------
						echo "value='".$array_kelas['id']."'>".$array_kelas['Nama_Kelas']."</option>";
						}*/
						?>
						
					</select>-->
				<!-------------------------------------------------------------------------------------------------------------------->
					<?php	}?>
					<select name="bulan">
						<option <?php if($bulan == "01")echo "selected='true' "; ?> value='01'>Januari</option>
						<option <?php if($bulan == "02")echo "selected='true' "; ?> value='02'>Februari</option>
						<option <?php if($bulan == "03")echo "selected='true' "; ?> value='03'>Maret</option>
						<option <?php if($bulan == "04")echo "selected='true' "; ?> value='04'>April</option>
						<option <?php if($bulan == "05")echo "selected='true' "; ?> value='05'>Mei</option>
						<option <?php if($bulan == "06")echo "selected='true' "; ?> value='06'>Juni</option>
						<option <?php if($bulan == "07")echo "selected='true' "; ?> value='07'>Juli</option>
						<option <?php if($bulan == "08")echo "selected='true' "; ?> value='08'>Agustus</option>
						<option <?php if($bulan == "09")echo "selected='true' "; ?> value='09'>September</option>
						<option <?php if($bulan == "10")echo "selected='true' "; ?> value='10'>Oktober</option>
						<option <?php if($bulan == "11")echo "selected='true' "; ?> value='11'>November</option>
						<option <?php if($bulan == "12")echo "selected='true' "; ?> value='12'>Desember</option>
					</select>
					<select name="tahun">
					<?php
				
					for($i=2011; $i<=2030; $i++){
					echo "<option ";
					if($tahun == $i)echo "selected='true' ";
					echo "value='".$i."'>".$i."</option>";
					}
					?>
					</select>&nbsp;<input type="submit"  class="submit" value="pilih"></form>
					
<?php //----------------------------------------------------------------------------------------------------------------------------?>
					<p>
					<!-- TABLE -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<?php 
$query_download=mysql_query("select*from siswa WHERE nis='$nis_siswa'"); 
$array_download=mysql_fetch_array($query_download);
$id_kelas = $array_download["id_kelas"];

$q_kelasById = mysql_query("select *from kelas where id='$id_kelas'");
$a_kelasById = mysql_fetch_array($q_kelasById);
//print "<br>".$id_kelas."<br>".$nis_siswa."<br>".$tanggal_bulan."<br>".$a_kelasById["Nama_Kelas"]."<br>".$array_download["Nama_siswa"]."<br>";
?>
		<div id='downloadini'>
		<div id='downloadkiri'>
			<form method="post" action="laporan/download_perbulan.php">
			
			<input type="hidden" name="kelas" value="<?php echo  $id_kelas; ?>">
			<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $a_kelasById["Nama_Kelas"]; ?>">
			<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
			<input type="hidden" name="tanggal_bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
			</form>
		</div>
		<div id='downloadkanan'>
			<form method="post" action="laporan/download_proses_perbulan.php" target=_blank>
			<input type="hidden" name="kelas" value="<?php echo  $id_kelas; ?>">
			<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $a_kelasById["Nama_Kelas"]; ?>">
			<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
			<input type="hidden" name="tanggal_bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type='submit' class='submit3' width='300' value="&nbsp;"><p>
			</form>
		</div>
		</div>

</table>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$tanggal_bulan' and keterangan<>'out' ORDER BY tanggal limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where no_siswa='$nis_siswa' and bulan='$tanggal_bulan'");
						$hadir = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='h' and bulan='$tanggal_bulan'");
						$alpa = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='a' and bulan='$tanggal_bulan'");
						$sakit = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='s' and bulan='$tanggal_bulan'");
						$izin = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='i' and bulan='$tanggal_bulan'");
						$total_hadir = mysql_num_rows($hadir);
						$total_alpa = mysql_num_rows($alpa);
						$total_sakit = mysql_num_rows($sakit);
						$total_izin = mysql_num_rows($izin);
						$query_kelass = mysql_query("select * from kelas where id='$id_kelas'");
						$query_siswaa = mysql_query("select * from siswa where nis='$nis_siswa'");
						
						$row_kelass = mysql_fetch_array($query_kelass);
						$row_siswaa = mysql_fetch_array($query_siswaa);
						$nama_kelass=$row_kelass["Nama_Kelas"];
						$nama_siswaa=$row_siswaa["Nama_siswa"];
					//echo $total_izin;
					?>
					
					<table>
						<tr>
							<td align="Center"><?php include("absensiChartPerBulan.php"); ?></td>
							<td align="Center"><?php include("absensiChartPerBulan2.php"); ?></td>
						</tr>

	
					</table>
						<p>
						
						</form>
					</div><!-- /#table -->	
</body>
