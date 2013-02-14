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
					}*/
					}
else{
/*
$kelas_wali=mysql_query("select *from kelas where id_guru='$guru'");
$array_kelas_wali=mysql_fetch_array($kelas_wali);
$id_kelas=$array_kelas_wali["id"];*/
}


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
					
					<h2>Laporan Tidak Absen Pulang Siswa</h2>
				</div>
				
				<div class="box-body clear">
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=siswa_out">
				<?php if($_SESSION['admin']){ $query_kelas=mysql_query("select*from kelas order by Nama_Kelas"); ?>Pilih Bulan :
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
$query_download=mysql_query("select*from kelas WHERE id='$id_kelas'"); 
$array_download=mysql_fetch_array($query_download);
?>
		<div id='downloadini'>
		<div id='downloadkiri'>
			<form method="post" action="laporan/download_out_perbulan.php">
			<input type="hidden" name="kelas" value="<?php echo $id_kelas; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $array_download["Nama_Kelas"]; ?>">
			<input type="hidden" name="tanggal_bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
			</form>
		</div>
		<div id='downloadkanan'>
			<form method="post" action="laporan/download_proses_out_perbulan.php" target=_blank>
			<input type="hidden" name="kelas" value="<?php echo $id_kelas; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $array_download["Nama_Kelas"]; ?>">
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
						
						$query = mysql_query("SELECT siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal FROM absensi_siswa, siswa, kelas where siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.bulan='$tanggal_bulan' and absensi_siswa.in_out='out_auto' order by absensi_siswa.tanggal limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where kd_kelas='$id_kelas' and bulan='$tanggal_bulan' and keterangan<>'out'  and in_out='out_auto'");
						$out = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and keterangan='h' and bulan='$tanggal_bulan' and keterangan<>'out'  and in_out='out_auto'");
						
						$total_out = mysql_num_rows($out);
						
						$query_kelass = mysql_query("select * from kelas where id='$id_kelas'");
						$row_kelass = mysql_fetch_array($query_kelass);
						$nama_kelass=$row_kelass["Nama_Kelas"];
					//echo $total_izin;
					?>
					
					<table>
						<tr>
							
							<td align="Center"><?php include("outChart.php"); ?></td>
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
									
								</tr>
							</thead>
							<tbody>
								<?php 
									while($row = mysql_fetch_array($query))
									{ 
									print "<tr>
											<td>".$row["absen"]."</td>
											<td>".$row["Nama_siswa"]."</td>
											<td>".$row["Nama_Kelas"]."</td>
											<td>".$row["tanggal"]."</td>
									";
									
									


									}
								?>
							</tbody>
						</table>
						<div class="dataTables_paginate paging_full_numbers">
							<span>
								<?
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									for($i=1;$i<=$jumhal;$i++){
								?>
								<a href='index.php?page=absen&page_laporan=<?php echo $i; ?>&id_kelas=<?php echo $id_kelas; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
