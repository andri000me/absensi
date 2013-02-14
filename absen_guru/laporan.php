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
					
					<h2>Laporan Absensi Guru</h2>
				</div>
				
				<div class="box-body clear">
			
				<form method="post" action="index.php?page=laporan_karyawan">
					
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

<?php //----------------------------------------------------------------------------------------------------------------------------?>						
<?php //----------------------------------------------------------------------------------------------------------------------------?>
					<br>
<div id='downloadini'>
<div id="downloadkiri">
<form method="post" action="absen_guru/download.php">

<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">

<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
</form>
</div>
<div id="downloadkanan">
<form method="post" action="absen_guru/download_proses.php" target=_blank>

<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">

<input type='submit' class='submit3' width='300' value="&nbsp;"><p>
</form>
</div>
</div>
					<!-- TABLE -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
	
					<div id="table">
			
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_guru where bulan='$tanggal_bulan' ORDER BY tanggal limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_guru where bulan='$tanggal_bulan'");
						$hadir = mysql_query("SELECT * FROM absensi_guru where keterangan='h' and bulan='$tanggal_bulan'");
						$alpa = mysql_query("SELECT * FROM absensi_guru where keterangan='a' and bulan='$tanggal_bulan'");
						$sakit = mysql_query("SELECT * FROM absensi_guru where keterangan='s' and bulan='$tanggal_bulan'");
						$izin = mysql_query("SELECT * FROM absensi_guru where keterangan='i' and bulan='$tanggal_bulan'");
						$total_hadir = mysql_num_rows($hadir);
						$total_alpa = mysql_num_rows($alpa);
						$total_sakit = mysql_num_rows($sakit);
						$total_izin = mysql_num_rows($izin);
						
						
						
					//echo $total_izin;
					?>
					
					<table>
						<tr>
							<td align="Center"><?php include("absensiChart.php"); ?></td>
							<td align="Center"><?php include("absensiChart2.php"); ?></td>
						</tr>

	
					</table>
						<p>
						<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									while($row = mysql_fetch_array($query))
									{ 
									$nip=$row['guru_nip'];
									
									$query_karyawan = mysql_query("select * from guru where nip='$nip'");
									$row_karyawan = mysql_fetch_array($query_karyawan);
									
									
									?>
									<tr>
										<td> <?php print $nip; ?></td>
										<td><?php print $row_karyawan["nama"]; ?></td>
										<td><?php print $row["tanggal"]; ?></td>
										<td><?php if($row["keterangan"] == "h"){ echo "Hadir"; } else if($row["keterangan"] == "i"){ echo "Izin"; } else if($row["keterangan"] == "a"){ echo "Alpa"; } else if($row["keterangan"] == "s"){ echo "Sakit"; } ?></td>
									</tr>
									
									
									
									<?php


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
								<a href='index.php?page=laporan_guru&page_laporan=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
