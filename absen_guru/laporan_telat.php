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

?>


<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					
					
					<h2>Laporan Guru Terlambat</h2>
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



$tanggal_bulan=$bulan."-".$tahun;
//echo $tanggal_bulan;
?>
<?php //----------------------------------------------------------------------------------------------------------------------------?>				
				
					
<?php //----------------------------------------------------------------------------------------------------------------------------?>
					<p>
					<!-- TABLE -->
					<div id="table">
					<form method="post" action="index.php?page=laporan_telat_guru">
				
					Pilih Tahun :
					<select name="tahun">
					<?php
				
					for($i=2011; $i<=2030; $i++){
					echo "<option ";
					if($tahun == $i)echo "selected='true' ";
					echo "value='".$i."'>".$i."</option>";
					}
					?>
					</select>&nbsp;<input type="submit" class='submit'  value="pilih"></form>
					<form method="post" action="">		
					<?php
						
						$query = mysql_query("select * from absensi_guru where keterangan='h' and terlambat='y' and bulan='$tanggal_bulan' limit $offset, $rec_limit");
						$qc = mysql_query("select count(*) as tot3 from absensi_gyry where keterangan='h' and terlambat='y' and bulan='$tanggal_bulan'");
					
					
					?>
										
					<table>
						 <tr> 
							<td rowspan="2" align='center'><?php include("telatChart2.php"); ?></td>
						</tr>


					</table>
					
					<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>

									<th>NIP</th>
									<th>Nama</th>
									<th>Tanggal</th>
									<th>Jumlah Waktu Terlambat</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									while($row = mysql_fetch_array($query))
									{ 
									$nip=$row['guru_nip'];
									
									$query_karyawan = mysql_query("select * from guru where nip='$nip'");
									$row_karyawan = mysql_fetch_array($query_karyawan);
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
								<a href='index.php?page=laporan_telat_guru&page_laporan=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
								<?
									}
								?>
							</span>
							
						</div>
						</div>
						</form>
					</div><!-- /#table -->	
</body>
