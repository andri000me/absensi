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
$tanggal_mulai = $_POST["tanggal_mulai"]."-".$_POST["bulan"]."-".$_POST["tahun"];
$tanggal_akhir = $_POST["tanggal_akhir"]."-".$_POST["bulan"]."-".$_POST["tahun"];
$search_tanggal_mulai = $_POST["tanggal_mulai"];
$search_tanggal_akhir = $_POST["tanggal_akhir"];
$search_bulan		  = $_POST["bulan"];
$search_tahun		  = $_POST["tahun"];

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
					
					<h2>Laporan Absensi Siswa Periode Tanggal - Bulan</h2>
				</div>
				
				<div class="box-body clear">
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=absen_siswa_pertanggal">
				<?php if($_SESSION['admin']){// $query_kelas=mysql_query("select*from kelas order by Nama_Kelas"); ?><p>NIS Siswa :
				<input type='text' name='nis_siswa' placeholder='NIS' value='<?php print $nis_siswa?>'></input>
				<select name="tanggal_mulai">
				<option >Mulai</option>
					<?php	}
					
					
					for($i=1; $i<=31; $i++){
						if($i<10){
							$b = "0".$i;
						}
						else{
							$b = $i;
						}
					
					?>
						<option value='<?php print $b;?>' <?php if($search_tanggal_mulai==$b){ print "selected=true"; }?> ><?php print $b; ?></option>
					<?php } ?>
					</select>
					<select name="tanggal_akhir">	
					<option >Akhir</option>
					<?php	
					
					
					for($i2=1; $i2<=31; $i2++){
						if($i2<10){
							$b2 = "0".$i2;
						}
						else{
							$b2 = $i2;
						}
					?>
					
						<option value='<?php print $b2;?>' <?php if($search_tanggal_akhir==$b2){ print "selected='true'"; }?>><?php print $b2; ?></option>
					<?php
					}
					
					?>
					</select>
					
					<select name="bulan">
						<option>Bulan</option>
						<option <?php if($search_bulan == "01")echo "selected='true' "; ?> value='01'>Januari</option>
						<option <?php if($search_bulan == "02")echo "selected='true' "; ?> value='02'>Februari</option>
						<option <?php if($search_bulan == "03")echo "selected='true' "; ?> value='03'>Maret</option>
						<option <?php if($search_bulan == "04")echo "selected='true' "; ?> value='04'>April</option>
						<option <?php if($search_bulan == "05")echo "selected='true' "; ?> value='05'>Mei</option>
						<option <?php if($search_bulan == "06")echo "selected='true' "; ?> value='06'>Juni</option>
						<option <?php if($search_bulan == "07")echo "selected='true' "; ?> value='07'>Juli</option>
						<option <?php if($search_bulan == "08")echo "selected='true' "; ?> value='08'>Agustus</option>
						<option <?php if($search_bulan == "09")echo "selected='true' "; ?> value='09'>September</option>
						<option <?php if($search_bulan == "10")echo "selected='true' "; ?> value='10'>Oktober</option>
						<option <?php if($search_bulan == "11")echo "selected='true' "; ?> value='11'>November</option>
						<option <?php if($search_bulan == "12")echo "selected='true' "; ?> value='12'>Desember</option>
					</select>
					<select name="tahun">
					<option>Tahun</option>
					<?php
				
					for($i=2011; $i<=2030; $i++){
					echo "<option ";
					if($search_tahun == $i)echo "selected='true' ";
					echo "value='".$i."'>".$i."</option>";
					}
					
					
					?>
					
					</select>&nbsp;<input type="submit"  class="submit" value="pilih" ></form>
					
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
			<form method="post" action="laporan/download_pertanggal.php">
			
			<input type="hidden" name="kelas" value="<?php echo  $id_kelas; ?>">
			<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
			<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
			<input type="hidden" name="tanggal_mulai_download" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal_akhir_download" value="<?php echo $tanggal_akhir; ?>">
			
			<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
			</form>
		</div>
		<div id='downloadkanan'>
			<form method="post" action="laporan/download_proses_pertanggal.php" target=_blank>
			<input type="hidden" name="kelas" value="<?php echo  $id_kelas; ?>">
			<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
			<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
			<input type="hidden" name="tanggal_mulai_download" value="<?php echo $tanggal_mulai; ?>">
			<input type="hidden" name="tanggal_akhir_download" value="<?php echo $tanggal_akhir; ?>">
			
			<input type='submit' class='submit3' width='300' value="&nbsp;"><p>
			</form>
		</div>
		</div>

</table>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and tanggal between '$tanggal_mulai' and '$tanggal_akhir' and keterangan<>'out' ORDER BY bulan limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where no_siswa='$nis_siswa' and tanggal between '$tanggal_mulai' and '$tanggal_akhir'");
						$hadir = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='h' and tanggal between '$tanggal_mulai' and '$tanggal_akhir'");
						$alpa = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='a' and tanggal between '$tanggal_mulai' and '$tanggal_akhir'");
						$sakit = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='s' and tanggal between '$tanggal_mulai' and '$tanggal_akhir'");
						$izin = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='i' and tanggal between '$tanggal_mulai' and '$tanggal_akhir'");
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
