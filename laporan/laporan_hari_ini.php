
<div class="content-box">
	
		<?php
		$tanggal = date('d-m-Y');
		
if($_SESSION['admin']){
	$id_kelas = $_POST["id_kelas"];	
	if($id_kelas=="") {
						$id_kelas=$_GET["id_kelas"];
						if($id_kelas=="") {	$q_q = mysql_query("select *from kelas order by Nama_Kelas");
							$a_a = mysql_fetch_array($q_q);
						$id_kelas=$a_a["id"];
						}
					}
					}
else{

$kelas_wali=mysql_query("select *from kelas where id_guru='$guru'");
$array_kelas_wali=mysql_fetch_array($kelas_wali);
$id_kelas=$array_kelas_wali["id"];
}

		?>

			<div class = "content-box">
				<div class="box-header clear"><h2>Laporan Absensi Siswa Hari Ini (<?php print $tanggal;?>)</h2></div>
				
				
				<div class="box-body clear">
				
					<div id="table">
					<tr><td>
						<form method="post" action="index.php?page=absen_ini">
						<?php if($_SESSION['admin']){ $query_kelas=mysql_query("select*from kelas order by id"); ?>Pilih Kelas :
					<select name="id_kelas">
						<?php while($array_kelas=mysql_fetch_array($query_kelas)){
						echo "<option ";
						//----------------------------------------------------------------
						if($id_kelas == ""){ echo "&nbsp;"; } 
						else if($id_kelas != $array_kelas['id']){echo "&nbsp; "; } 
						else if($id_kelas == $array_kelas['id']){ echo "selected='true' ";} 

						//----------------------------------------------------------------
						echo "value='".$array_kelas['id']."'>".$array_kelas['Nama_Kelas']."</option>";
						}
						?>
						
					</select>
					&nbsp;<input type="submit" class='submit' value="pilih"><p> <?php	}?></form>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->

<?php 
$query_download=mysql_query("select*from kelas WHERE id='$id_kelas'"); 
$array_download=mysql_fetch_array($query_download);
?>
		<div id='downloadini'>
		<div id='downloadkiri'>
			<form method="post" action="laporan/download2.php">
			<input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $array_download["Nama_Kelas"]; ?>">
			<input type="hidden" name="tanggal" value="<?php print $tanggal;?>">
			<input type='submit' class='submit2' width='300' value="&nbsp;"><p>
			</form>
		</div>
		<div id='downloadkanan'>
			<form method="post" action="laporan/download_proses2.php" target=_blank>
			<input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
			<input type="hidden" name="bulan" value="<?php echo $tanggal_bulan; ?>">
			<input type="hidden" name="nama_kelas" value="<?php echo $array_download["Nama_Kelas"]; ?>">
			<input type="hidden" name="tanggal" value="<?php echo $tanggal;?>">
			<input type='submit' class='submit3' width='300' value="&nbsp;"><p>
			</form>
		</div>
		</div>

</table>
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------ -->

						<table border=1>
							<thead>
								<tr>
									<td colspan=2><center><b>Laporan Absensi Siswa Tanggal <?php print $tanggal;?></b></center></td>
								</tr>	
							</thead>
							<tbody>
							<tr>
								<td width="40%">
										<?php include("absensiHariIniChart.php"); ?>
								</td>
							
								<td width="60%">
									<table>
										<tr>
											<th>NIS</th>
											<th>Absen</th>
											<th>Nama</th>
											<th>Kelas</th>
											<th>Keterangan</th>
										<tr>
								
										
									<?php
											$row = $query = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and tanggal='$tanggal' ORDER BY no_siswa") or die (mysql_error());
											//echo $row;
											while($array=mysql_fetch_array($row)){
											$nis=$array['no_siswa'];
											$kelas=$array['kd_kelas'];
											$query_siswa = mysql_query("select * from siswa where nis='$nis' and id_kelas='$kelas'");
											$query_kelas = mysql_query("select * from kelas where id='$kelas'");
											$row_siswa = mysql_fetch_array($query_siswa);
											$row_kelas = mysql_fetch_array($query_kelas);
											//$t = $array["t"];
											
											print "<tr><td>".$row_siswa['nis']."</td><td>".$row_siswa['absen']."</td><td>".$row_siswa['Nama_siswa']."</td><td>".$row_kelas['Nama_Kelas']."</td><td>";
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