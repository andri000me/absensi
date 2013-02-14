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
//GET AND POST TAHUN--------------------------------------------------------
$default_tahun = date('Y');
if(!empty($_POST["tahun"])){
	$tahun = $_POST["tahun"];
}
else if(!empty($_GET["tahun"])){
	$tahun = $_GET["tahun"];
}
else{
	$tahun = $default_tahun;
}
//GET AND POST BULAN------------------------------------------------------------------
$default_bulan = date('m');
if(!empty($_POST["bulan"])){
	$bulan = $_POST["bulan"];
}
else if(!empty($_GET["bulan"])){
	$bulan = $_GET["bulan"];
}
else{
	$bulan = $default_bulan;
}
//GET AND POST IN/OUT--------------------------------------------------------------------
if(!empty($_POST["in_out"])){
	$in_out = $_POST["in_out"];
}
else if(!empty($_GET["in_out"])){
	$in_out = $_GET["in_out"];
}
else{
	$in_out = "in";
}
//GET AND POST NIS----------------------------------------------------------------------
if(!empty($_POST["nis_siswa"])){
	$nis_siswa = $_POST["nis_siswa"];
}
else if(!empty($_GET["nis_siswa"])){
	$nis_siswa = $_GET["nis_siswa"];
}
$tanggal_bulan = $bulan."-".$tahun;
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
					NIS Siswa : <input type='text' name='nis_siswa' placeholder='NIS' value='<?php print $nis_siswa?>'></input>
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
					</select>
					<select name="in_out">
						<option <?php if($in_out == "in")echo "selected='true' "; ?> value='in'>Absen Masuk</option>
						<option <?php if($in_out == "out")echo "selected='true' "; ?> value='out'>Absen Keluar</option>
					</select>&nbsp;<input type="submit"  class="submit" value="pilih"></form>
					
<?php //----------------------------------------------------------------------------------------------------------------------------?>
					
					<!-- TABLE -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<?php 
$query_download = mysql_query("select * from siswa where nis='$nis_siswa'");
$array_download=mysql_fetch_array($query_download);
?>
		<ul class='download'>
			<li>
				<form method="post" action="laporan/download/download_xl.php">
					<input type="hidden" name="jenis_laporan" value="perbulan">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="bulan" value="<?php echo  $tanggal_bulan; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
				</form>
			</li>
			<li>
				<form method="post" action="laporan/download/download_pdf.php" target=_blank>
					<input type="hidden" name="jenis_laporan" value="perbulan">
					<input type="hidden" name="bulan" value="<?php echo  $tanggal_bulan; ?>">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit3' width='300' value="&nbsp;">
				</form>
			</li>
			<li>
				<form method="post" action="laporan/download/download_rekap_pdf_person.php" target=_blank>
					<input type="hidden" name="jenis_laporan" value="perbulan">
					<input type="hidden" name="bulan" value="<?php echo  $tanggal_bulan; ?>">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit4' width='300' value="&nbsp;">
				</form>
			</li>
		</ul>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and bulan='$tanggal_bulan' and in_out='$in_out' ORDER BY tanggal limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where no_siswa='$nis_siswa' and bulan='$tanggal_bulan' and in_out='$in_out'");
						$hadir = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='h' and bulan='$tanggal_bulan' and in_out='$in_out'");
						$alpa = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='a' and bulan='$tanggal_bulan' and in_out='$in_out'");
						$sakit = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='s' and bulan='$tanggal_bulan' and in_out='$in_out'");
						$izin = mysql_query("SELECT * FROM absensi_siswa WHERE no_siswa='$nis_siswa' and keterangan='i' and bulan='$tanggal_bulan' and in_out='$in_out'");
						$total_hadir = mysql_num_rows($hadir);
						$total_alpa = mysql_num_rows($alpa);
						$total_sakit = mysql_num_rows($sakit);
						$total_izin = mysql_num_rows($izin);
						$query_siswaa = mysql_query("select * from siswa where nis='$nis_siswa'");
						
						$row_siswaa = mysql_fetch_array($query_siswaa);
						$nama_siswaa=$row_siswaa["Nama_siswa"];
					//echo $total_izin;
					?>
					
					<table>
						<tr>
							<td align="Center"><?php include("absensiChartPerBulan.php"); ?></td>
							<td align="Center"><?php include("absensiChartPerBulan2.php"); ?></td>
						</tr>

	
					</table>
					<div class="dataTables_wrapper">
					<table>
							<thead>
								<tr>
									<th>No Absen</th>
									<th>Nama</th>
									<th>Kelas</th>
									<th>Tanggal</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
							<?php 
									while($row = mysql_fetch_array($query))
									{ 
									$nis=$row['no_siswa'];
									$kelas=$row['kd_kelas'];
									$query_siswa = mysql_query("select * from siswa where nis='$nis' and id_kelas='$kelas'");
									$query_kelas = mysql_query("select * from kelas where id='$kelas'");
									$row_siswa = mysql_fetch_array($query_siswa);
									$row_kelas = mysql_fetch_array($query_kelas);
									?>
									<tr>
										<td><?php print $row_siswa["absen"]; ?></td>
										<td><?php print $row_siswa["Nama_siswa"]; ?></td>
										<td><?php print $kelas["Nama_Kelas"]; ?></td>
										<td><?php print $row["tanggal"]; ?></td>
										<td><?php print $row["keterangan"]; ?></td>
									</tr>
									<?php } ?>
							</tbody>
						</table>
						<div class="dataTables_paginate paging_full_numbers">
							<span>
								<?
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									for($i=1;$i<=$jumhal;$i++){
								?>
								<a href='index.php?page=absen_siswa_perbulan&page_laporan=<?php echo $i; ?>&tahun=<?php echo $tahun; ?>&bulan=<?php echo $bulan; ?>&in_out=<?php echo $in_out; ?>&nis_siswa=<?php echo $nis_siswa; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
