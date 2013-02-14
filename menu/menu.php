<div class="menu">
<?php

	include("conn/conn.php");
	$query = mysql_query("select *from guru");
	$array_guru = mysql_fetch_array($query);
	$nama = $array_guru['nama'];
	$query2 = mysql_query("select *from admin");
	$array_admin = mysql_fetch_array($query2);
	$admin = $array_admin['admin'];
	$anak="anak";
	if(@$_GET["page"]){
	$p = $_GET["page"];
						include("conn/conn.php");
						$q=mysql_query("select* from kelas where id='$p'");
						$q2=mysql_query("select *from kelas order by Nama_Kelas");
						$isi=mysql_fetch_array($q);
						
					
				
						if($p == "Master_Siswa" || $p == "Master_Guru" || $p == "Master_Guru" ||  $p == "Master_Jurusan" ||  $p == "Master_Karyawan" ||$p == "Master_Kelas" || $p == "Master_Wali_Kelas" || $p == "Master_Mata_Pelajaran" || $p == "Edit_Master_Siswa" || $p == "Edit_Master_Guru" || $p == "Edit_Master_Kelas" || $p == "Edit_Master_Wali_Kelas" || $p == "Edit_Master_Jurusan" || $p == "Edit_Master_Karyawan" || $p == "Edit_Master_Mata_Pelajaran" || $p == "Edit_Master_Libur" || $p == "Master_Libur"){
						$atu="atu";
						echo "<script>
						$(document).ready(function(){
						$('.atu').slideDown(250);
						});
						
						</script>";
						}
						if($p == "Master_Siswa"  || $p == "Edit_Master_Siswa" ){
							echo "<script>
						$(document).ready(function(){
						$('#anak').show(650);
						});
						
						
						
						</script>";
						}
						else if($p == "absen_siswa_pertanggal"  || $p == "absen_siswa_perbulan" || $p == "absen_siswa_semester"  || $p == "absen_siswa_tahunajaran" ){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						
						$('.tiga').slideDown(250);	
						$('#anak_siswa').show(650);
						});
						
						
						
						</script>";
						}
						else if($p == "absen"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						

						
						else if($p == $isi["id"]){
						$dua="dua";
						echo "<script>
						$(document).ready(function(){
						$('.dua').slideDown(250);
						});
						</script>";
						}
						else if($p == "telat"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						else if($p == "telat_siswa"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						else if($p == "absen_ini"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						else if($p == "absen_siswa"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						else if($p == "absen_per_siswa"){
						$tiga="tiga";
						echo "<script>
						$(document).ready(function(){
						$('.tiga').slideDown(250);
						});
						</script>";
						}
						else if($p == "laporan_karyawan"){
						$empat="empat";
						echo "<script>
						$(document).ready(function(){
						$('.empat').slideDown(250);
						});
						</script>";
						}
						else if($p == "laporan_telat_karyawan"){
						$empat="empat";
						echo "<script>
						$(document).ready(function(){
						$('.empat').slideDown(250);
						});
						</script>";
						}
						else if($p == "laporan_karyawan_hari_ini"){
						$empat="empat";
						echo "<script>
						$(document).ready(function(){
						$('.empat').slideDown(250);
						});
						</script>";
						}
						
						else if($p == "laporan_guru"){
						$lima="lima";
						echo "<script>
						$(document).ready(function(){
						$('.lima').slideDown(250);
						});
						</script>";
						}
						else if($p == "laporan_telat_guru"){
						$lima="lima";
						echo "<script>
						$(document).ready(function(){
						$('.lima').slideDown(250);
						});
						</script>";
						}
						else if($p == "laporan_guru_hari_ini"){
						$lima="lima";
						echo "<script>
						$(document).ready(function(){
						$('.lima').slideDown(250);
						});
						</script>";
						}
						else if($p == "guru" || $p == "karyawan"){
						$enam="enam";
						echo "<script>
						$(document).ready(function(){
						$('.enam').slideDown(250);
						});
						</script>";
						}
						
						
						
	}
	
?>

			
			<ul class="<?php echo $ata; ?>">
		
			<?php
			if($_SESSION['user'] || $_SESSION['guru']){
					print "<li id='dashboard'><a href='index.php'>Dashboard</a>";
			}
			else{
			?>	<li id="dashboard"><a href="#">Dashboard</a>
				<ul class="<?php echo $enam ?>" id="emak6">
					<li><a href="?home=siswa" class='limenu'>Siswa</a></li>
					<li><a href="?home=guru" class='limenu'>Guru</a></li>
					<li><a href="?home=karyawan" class='limenu'>Karyawan</a></li>
				
				</ul>
			</li>
			<?php
			}
			
				if($_SESSION["guru"]){
					$query_wali_kelas = mysql_query("select * from kelas where id_guru='$guru'");
					$array_wali_kelas = mysql_fetch_array($query_wali_kelas);
					
					include ("absen.php");
					include ("laporan.php");
				}
				else if($_SESSION['user']){
					include ("laporan_siswa.php");
				}
				else if($_SESSION['admin']){
					include ("master.php");
					print "<br><br>";
					include ("absen.php");
					echo "<li id='dashboard'><a href='?page=absen_guru'>Presensi Guru</a></li>";
					echo "<li id='dashboard'><a href='?page=absen_karyawan'>Presensi Karyawan</a></li>";
					
					print "<br><br>";
					include ("laporan.php");
					include ("laporan_guru.php");
					include ("laporan_karyawan.php");
					
				}
			?>
			
			</ul>
		</div>
