
<div class="content-box">
	
		<?php
		$tanggal = date('d-m-Y');

$default_bulan = date('m');
$default_tahun = date('Y');

//echo $default_tahun;

$tahun = $_POST["tahun"];
if($tahun=="") $tahun=$default_tahun;

$bulan = $_POST["bulan"];
if($bulan=="") $bulan=$default_bulan;



$tanggal_bulan=$bulan."-".$tahun;

		?>

			<div class = "content-box">
				<div class="box-header clear"><h2>Laporan Absensi Guru Hari Ini (<?php print $tanggal;?>)</h2></div>
					
				<div class="box-body clear">
				
					
						
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<div id='downloadini'>
<div id="downloadkiri">
<form method="post" action="absen_guru/download2.php">

<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">

<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
</form>
</div>
<div id="downloadkanan">
<form method="post" action="absen_guru/download_proses2.php" target=_blank>

<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">

<input type='submit' class='submit3' width='300' value="&nbsp;"><p>
</form>
</div>
</div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->

						<table border=1>
							<thead>
								<tr>
									<td colspan=2><center><b>Laporan Absensi Guru Tanggal <?php print $tanggal;?></b></center></td>
								</tr>	
							</thead>
							<tbody>
							<tr>
								<td width="45%">
										<?php include("absensiHariIniChart.php"); ?>
								</td>
							
								<td width="60%">
									<table>
										<tr>
											<th>NIP</th>
											<th>Nama</th>
											<th>Keterangan</th>
										<tr>
								
										
									<?php
											$row = $query = mysql_query("select * from absensi_guru where tanggal='$tanggal' ORDER BY guru_nip") or die (mysql_error());
											//echo $row;
											while($array=mysql_fetch_array($row)){
											$nip=$array['guru_nip'];
									
											$query_karyawan = mysql_query("select * from guru where nip='$nip'");
											$row_karyawan = mysql_fetch_array($query_karyawan);
											
											print "<tr><td>".$row_karyawan['nip']."</td><td>".$row_karyawan['nama']."</td><td>";
											if($array["keterangan"] == "h"){ echo "Hadir"; } else if($array["keterangan"] == "i"){ echo "Izin"; } else if($array["keterangan"] == "a"){ echo "Alpa"; } else if($array["keterangan"] == "s"){ echo "Sakit"; } 
											echo "</td></tr>";
											}
									?></tbody>
									</table>
							</td>
							</tr>
						</table>
						</td></tr>
						
						<tr><td>
						
						</td></tr>
					</div>
				</div>
			

</div>