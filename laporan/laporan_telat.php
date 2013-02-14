<?php
include("conn/conn.php");
 function time2seconds($time="00:00:00")
									{
									list($hours, $mins, $secs) = explode(':', $time);
									return ($hours * 3600 ) + ($mins * 60 ) + $secs;
									}
$q_waktu_telat	   = mysql_query("select *from waktu_telat");
$array_waktu_telat = mysql_fetch_array($q_waktu_telat);
$jam_telat		   = $array_waktu_telat["jam"];
$menit_telat	   = $array_waktu_telat["menit"];
$detik_telat	   = $array_waktu_telat["detik"];
$waktu_telat	   = ($jam_telat*3600)+($menit_telat*60)+($detik_telat);
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

$default_bulan = date('m');
$default_tahun = date('Y');

//echo $default_tahun;

$tahun = $_POST["tahun"];
if($tahun=="") $tahun=$default_tahun;

$bulan = $_POST["bulan"];
if($bulan=="") $bulan=$default_bulan;

if($_SESSION['admin']){
	$id_kelas = $_POST["id_kelas"];	
	if($id_kelas=="") {
						$id_kelas=$_GET["id_kelas"];
						if($id_kelas=="") {
							$q_q = mysql_query("select *from kelas order by Nama_Kelas");
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

$tanggal_bulan=$bulan."-".$tahun;

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
									<table>
									<form method="post" action="index.php?page=telat">
				<?php if($_SESSION['admin']){ $query_kelas=mysql_query("select*from kelas order by Nama_Kelas"); ?>Pilih Kelas :
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
					<?php	}?>
					
					<select name="tahun">
					<?php
				
					for($i=2011; $i<=2030; $i++){
					echo "<option ";
					if($tahun == $i)echo "selected='true' ";
					echo "value='".$i."'>".$i."</option>";
					}
					?>
					</select>&nbsp;<input type="submit" class='submit'  value="pilih"></form>
						<tr>
							<td align="Center"><?php include("telatChart.php"); ?></td>
						</tr>

					</table>

					<p>
					<!-- TABLE -->
					<div id="table">
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_siswa where kd_kelas='$id_kelas' and keterangan='h' and terlambat='y' and bulan='$tanggal_bulan' and keterangan<>'out' limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_siswa where kd_kelas='$id_kelas' and keterangan='h' and terlambat='y' and bulan='$tanggal_bulan' and keterangan<>'out'");
					
					
					?>
										
					<table>
						  
							<td rowspan="2" align='center'><?php include("telatChart2.php"); ?></td>
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
									$nis=$row['no_siswa'];
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
									$init_m = $init - $waktu_telat;
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
								<a href='index.php?page=telat&page_laporan=<?php echo $i; ?>&id_kelas=<?php echo $id_kelas; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
