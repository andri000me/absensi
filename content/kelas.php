<?php

if($_SESSION["admin"] || $_SESSION["guru"]){
$q_waktu = mysql_query("select *from waktu_telat");
$array_waktu=mysql_fetch_array($q_waktu);
$waktu_telat = $array_waktu["waktu"];

@$p = $_GET["page"];
$q_kelas = mysql_query("select *from kelas where id=$p");
$array_kelas = mysql_fetch_array($q_kelas);
$today		= 	date("d-m-Y");


for($kk=1;$kk<=50;$kk++){
print "<script>

function au$kk(dell$kk){
	
		if(dell$kk=='h'){
			document.getElementById('t$kk').disabled=false;
		}else{
			document.getElementById('t$kk').disabled=true;
			document.getElementById('t$kk').checked=false;
			document.getElementById('jam_masuk_$kk').disabled=true;
		document.getElementById('menit_masuk_$kk').disabled=true;
		}
		
}
function ua$kk(doll$kk){
	if(document.getElementById('t$kk').checked==true){
		document.getElementById('jam_masuk_$kk').disabled=false;
		document.getElementById('menit_masuk_$kk').disabled=false;
	}else{
		document.getElementById('jam_masuk_$kk').disabled=true;
		document.getElementById('menit_masuk_$kk').disabled=true;
	}
		
		
	
}


</script>";
}
 ?>			


<body>

 

				<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
				
					<h2>Presensi <?php echo $array_kelas["Nama_Kelas"];?></h2>

					<body onload="StartClock()" onunload="KillClock()" >
					<form name="theClock" align="right">
						<font color="red"><?php echo date("d-m-Y"); ?> &nbsp; <input name="theTime" size=6 disabled style="padding-left:8px; color:red;"></font>
					</form>
				</div>

				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">					
						<form method="post" action="absen/proses.php">
		

						<table>
							<thead>
								<tr>
									<th>No Absen</th>
									<th>Nama</th>
									<th>Hadir</th>
									<th>Alfa</th>
									<th>izin</th>
									<th>Sakit</th>
									<th>Telat</th>
									<th>Waktu Masuk</th>
								</tr>
							</thead>
							
							<tbody>

<?php
$i=$_GET["page"];
		$query=mysql_query("select * from siswa where id_kelas='$i' order by absen");
		$nomor=1;
		
		while($row=mysql_fetch_array($query)){
		$nis_siswa=$row['nis'];
		$q_absenSiswaByTanggal = mysql_query("SELECT * FROM `absensi_siswa` where tanggal='$today' and no_siswa='$nis_siswa'");
		$a_absenSiswaByTanggal = mysql_fetch_array($q_absenSiswaByTanggal);
		$q_absenSiswaByTanggalOut = mysql_query("SELECT * FROM `absensi_siswa` where tanggal='$today' and no_siswa='$nis_siswa' and in_out='out'");
		$a_absenSiswaByTanggalOut = mysql_fetch_array($q_absenSiswaByTanggalOut);
		
		if(!empty($a_absenSiswaByTanggal)){
			$enabled='disabled';
		}

		
		echo "<tr><td>".$row['absen']."</td>";
		echo "<td>".$row['Nama_siswa']."</td>";
							echo   "<input type='hidden' name='nomor' value='$nomor'/>
									<td><input type='radio' onclick='au$nomor(this.value)' class='checkbox' name='$nomor' id='h$nomor' value='h' checked $enabled/></td>	
									<td><input type='radio' onclick='au$nomor(this.value)' class='checkbox' name='$nomor' id='a$nomor' value='a' $enabled/></td>	
									<td><input type='radio' onclick='au$nomor(this.value)' class='checkbox' name='$nomor' id='i$nomor' value='i' $enabled/></td>	
									<td><input type='radio' onclick='au$nomor(this.value)' class='checkbox' name='$nomor' id='s$nomor' value='s' $enabled/></td>
									<td><input type='checkbox' class='checkbox' onclick='ua$nomor(this.value)' name='t$nomor' id='t$nomor' value='y' $enabled/></td>";?>
									<td>Jam : <select name="jam_masuk_<?php print $nomor;?>" id='jam_masuk_<?php print $nomor;?>' disabled>
									<?php
										//int $a;
										for($a4_out=0;$a4_out<24;$a4_out++){
									?>
										<option value=<?php print $a4_out; ?> ><?php print $a4_out; ?></option>
									<?
										}
									?>
								</select>
								Menit : <select name="menit_masuk_<?php print $nomor;?>" id='menit_masuk_<?php print $nomor;?>' disabled>
									<?php
										for($b4_out=0;$b4_out<60;$b4_out++){
									?>
											<option value=<?php print $b4_out; ?> ><?php print $b4_out;?></option>
									<?php
										}
									?>
								</select>
							</td></tr>
									<?
							echo "<input type='hidden' name='nis".$nomor."' value='".$row['nis']."'>";
							echo "<input type='hidden' name='id_finger".$nomor."' value='".$row['id_finger']."'>";
							
		$nomor++;
		}
		$query_kelas=mysql_query("select * from kelas where id='$i'");
		$kelas=mysql_fetch_array($query_kelas);
		echo "<script type='text/javascript'>
				function show_absen()
				{
				alert('Absen Kelas = ".$kelas['Nama_Kelas']." Berhasil');
				}
				</script>";
?>
								
										
							</tbody>
						</table>
						<input type='hidden' name='jumlah' value='<?php echo $nomor ?>'>
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="no_kelas" value=<?php print $i; ?>/>
								
									<?php
									include("content/if_submit.php");	
									
									
									?>	
							</div>							
						</div>
						</form>
					</div><!-- /#table -->
</script>
</body>
</html>
<?php }
else {
								include("home.php");
							}
?>