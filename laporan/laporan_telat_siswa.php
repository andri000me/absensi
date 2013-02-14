<?php
include("conn/conn.php");
$usr=$_SESSION['user'];
$q4=mysql_query("select *from siswa where id='$usr'");
$array4 = mysql_fetch_array($q4);
$nisn_siswa = $array4["nis"];
$nama_siswa = $array4['Nama_siswa'];
 function time2seconds($time="00:00:00")
									{
									list($hours, $mins, $secs) = explode(':', $time);
									return ($hours * 3600 ) + ($mins * 60 ) + $secs;
									}

//--------------------------------------------------------------------

$page = $_GET['page_telat'];
if( !isset($_GET['page_telat']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_telat'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;
//--------------------------------------------------------------------

?>


<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
					
						
					</ul>
					
					<h2>Laporan Siswa Terlambat</h2>
				</div>
				
				<div class="box-body clear">
									
<?php
include("conn/conn.php");
$default_bulan = date('m');
$default_tahun = date('Y');

//echo $default_tahun;

$tahun = $_POST["tahun"];
if($tahun=="") $tahun=$default_tahun;

$bulan = $_POST["bulan"];
if($bulan=="") $bulan=$default_bulan;

$id_kelas=$array4["id_kelas"];

$tanggal_bulan=$bulan."-".$tahun;
//echo $tanggal_bulan;
?>
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				<form method="post" action="index.php?page=telat_siswa">
				
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
					</select>&nbsp;<input type="submit" class='submit'  value="pilih"></form>
					
<?php //----------------------------------------------------------------------------------------------------------------------------?>
					<p>
					<!-- TABLE -->
					<div id="table">
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where no_siswa='$nisn_siswa' and terlambat='y' and bulan='$tanggal_bulan' and keterangan<>'out' limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where no_siswa='$nisn_siswa' and keterangan='h' and terlambat='y' and bulan='$tanggal_bulan' and keterangan<>'out'");
					
					
					?>
										
					<table>
						  
							<td rowspan="2" align='center'><?php include("telatSiswaChart2.php"); ?></td>
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
									<th>Jumlah Waktu Terlambat</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									while($row = mysql_fetch_array($query))
									{ 
									$nis=$row["no_siswa"];
									$kelas=$row['kd_kelas'];
									$query_siswa = mysql_query("select * from siswa where nis='$nis' and id_kelas='$kelas'");
									$query_kelas = mysql_query("select * from kelas where id='$kelas'");
									$row_siswa = mysql_fetch_array($query_siswa);
									$row_kelas = mysql_fetch_array($query_kelas);
									$waktu=$row["waktu"];
									//echo $waktu;
									//$pecah=strtok($waktu, ":");
									

										// echo $t1;
									$init = time2seconds($waktu);
									$init_m = $init - 23400;
									$hours = floor($init_m / 3600);
									$minutes = floor(($init_m / 60) % 60);
									$seconds = $init_m % 60;
									
										include("telat.php");
										
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
								<a href='index.php?page=absen&page_laporan=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
