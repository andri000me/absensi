<?php
include("conn/conn.php");
//Page Limit--------------------------------------------------------------------

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
//GET AND POST Tahun Ajaran--------------------------------------------------------
$default_tahun_1 = date("Y");
$default_tahun_2 = $default_tahun_1 + 1;
$default_tahun = $default_tahun_1."-".$default_tahun_2;
if(!empty($_POST["tahun_ajaran"])){
	$tahun_ajaran = $_POST["tahun_ajaran"];
}
else if(!empty($_GET["tahun_ajaran"])){
	$tahun_ajaran = $_GET["tahun_ajaran"];
}
else{
	$tahun_ajaran = $default_tahun;
}
//GET AND POST SEMESTER------------------------------------------------------------------
if(!empty($_POST["semester"])){
	$semester = $_POST["semester"];
}
else if(!empty($_GET["semester"])){
	$semester = $_GET["semester"];
}
else{
	$semester = "1";
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
					
					<h2>Laporan Absensi Siswa Periode Semester</h2>
				</div>
				
				<div class="box-body clear">
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=absen_siswa_semester">
					NIS Siswa :	<input type='text' name='nis_siswa' placeholder='NIS' value='<?php print $nis_siswa;?>'></input>
					<select name="semester">
						<option <?php if($semester == "1")echo "selected='true' "; ?> value='1'>Semester 1</option>
						<option <?php if($semester == "2")echo "selected='true' "; ?> value='2'>Semester 2</option>
					</select>
					<select name="tahun_ajaran">
					<?php
				
					for($i=2011; $i<=2030; $i++){
					$j=$i-1;
					$k=$j."-".$i;
					echo "<option ";
					if($tahun_ajaran == $k)echo "selected='true' ";
					echo "value='".$k."'>".$k."</option>";
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
					<input type="hidden" name="jenis_laporan" value="semester">
					<input type="hidden" name="tahun_ajaran" value="<?php echo  $tahun_ajaran; ?>">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="semester" value="<?php echo $semester; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
				</form>
			</li>
			<li>
				<form method="post" action="laporan/download/download_pdf.php" target=_blank>
					<input type="hidden" name="jenis_laporan" value="semester">
					<input type="hidden" name="tahun_ajaran" value="<?php echo  $tahun_ajaran; ?>">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="semester" value="<?php echo $semester; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit3' width='300' value="&nbsp;">
				</form>
			</li>
			<li>
				<form method="post" action="laporan/download/download_rekap_pdf_person.php" target=_blank>
					<input type="hidden" name="jenis_laporan" value="semester">
					<input type="hidden" name="tahun_ajaran" value="<?php echo  $tahun_ajaran; ?>">
					<input type="hidden" name="nis" value="<?php echo  $nis_siswa; ?>">
					<input type="hidden" name="semester" value="<?php echo $semester; ?>">
					<input type="hidden" name="in_out" value="<?php echo $in_out; ?>">
					<input type="hidden" name="nama_siswa" value="<?php echo $array_download["Nama_siswa"]; ?>">
					<input type='submit' class='submit3' width='300' value="&nbsp;">
				</form>
			</li>
		</ul>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out' ORDER BY tanggal limit $offset, $rec_limit");
						
						
						
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out'");
						$hadir = mysql_query("SELECT * FROM absensi_siswa WHERE keterangan='h' and no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out'");
						$alpa = mysql_query("SELECT * FROM absensi_siswa WHERE keterangan='a' and no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out'");
						$sakit = mysql_query("SELECT * FROM absensi_siswa WHERE keterangan='s' and no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out'");
						$izin = mysql_query("SELECT * FROM absensi_siswa WHERE  keterangan='i' and no_siswa='$nis_siswa' and tahun_ajaran='$tahun_ajaran' and semester='$semester' and in_out='$in_out'");
						$total_hadir = mysql_num_rows($hadir);
						$total_alpa = mysql_num_rows($alpa);
						$total_sakit = mysql_num_rows($sakit);
						$total_izin = mysql_num_rows($izin);
						$query_siswaa = mysql_query("select * from siswa where nis='$nis_siswa'");
						
						$row_siswaa = mysql_fetch_array($query_siswaa);
						$nama_siswaa=$row_siswaa["Nama_siswa"];
					?>
					
					<table>
						<tr>
							<td align="Center"><?php include("absensiChartPerBulan.php"); ?></td>
							<td align="Center"><?php include("absensiChartPerBulan2.php"); ?></td>
						</tr>

	
					</table>
						<p>
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
								<a href='index.php?page=absen_siswa_semester&page_laporan=<?php echo $i; ?>&tahun_ajaran=<?php echo $tahun_ajaran; ?>&in_out=<?php echo $in_out; ?>&nis_siswa=<?php echo $nis_siswa; ?>&semester=<?php echo $semester; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
