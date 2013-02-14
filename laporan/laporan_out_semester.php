<?php
date_default_timezone_set('Asia/Jakarta');
include("conn/conn.php");

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
					
					<h2>Laporan Tidak Absen Pulang Siswa - Semester</h2>
				</div>
				
				<div class="box-body clear">
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=siswa_out_semester">
				Pilih Semester :
					<select name="semester">
						<option <?php if($semester=="1"){ print "selected='true'";} ?> value='1'>1</option>
						<option <?php if($semester=="2"){ print "selected='true'";} ?> value='2'>2</option>
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
					</select>&nbsp;<input type="submit"  class="submit" value="pilih"></form>
					

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<?php 
$query_download = mysql_query("select * from siswa where nis='$nis_siswa'");
$array_download=mysql_fetch_array($query_download);
?>
		<div id='downloadini'>
			<div id='downloadkiri'>
				<form method="post" action="laporan/download/download_xl.php">
					<input type="hidden" name="jenis_laporan" value="out_semester">
					<input type="hidden" name="tahun_ajaran" value="<?php echo  $tahun_ajaran; ?>">
					<input type="hidden" name="semester" value="<?php echo $semester; ?>">
					<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
				</form>
			</div>
			<div id='downloadkanan'>
				<form method="post" action="laporan/download/download_pdf.php" target=_blank>
					<input type="hidden" name="jenis_laporan" value="out_semester">
					<input type="hidden" name="tahun_ajaran" value="<?php echo  $tahun_ajaran; ?>">
					<input type="hidden" name="semester" value="<?php echo $semester; ?>">
					<input type='submit' class='submit3' width='300' value="&nbsp;">
				</form>
			</div>
		</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					
					<table>
						<tr>
							
							<td align="Center"><?php include("outChartSemester.php"); ?></td>
						</tr>

	
					</table>
</body>
