<tr class="aa" >
			<?php if($telat2 > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Siswa Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NIS</b></td>
								<td><b>Nama</b></td>
								<td width='50%'><b>Kelas</b></td>
							</thead>
						</tr>
						
						<?php
						include ("conn/conn.php");
						$row = mysql_query("select * from absensi_siswa where tanggal='$today' and terlambat='y' order by kd_kelas") or die (mysql_error());
					
						while($array=mysql_fetch_array($row)){
							$nis_ini=$array['no_siswa'];
							$kelas_ini=$array['kd_kelas'];
							$row_siswa_ini=mysql_query("select * from siswa where nis='$nis_ini' and id_kelas='$kelas_ini'");
							$row_kelas_ini=mysql_query("select * from kelas where id='$kelas_ini'");
							$array_siswa_ini=mysql_fetch_array($row_siswa_ini);
							$array_kelas_ini=mysql_fetch_array($row_kelas_ini);
							print "<tr><td>".$array_siswa_ini['nis']."</td><td>".$array_siswa_ini['nama_panggilan']."</td><td>".$array_kelas_ini['Nama_Kelas']."</td></tr>";
						}
						
					?>
					
				</div>
				</table>
			</td>
			<?php
			}
			
			else{
				print"";
			}
			?>
			<td <?php if($telat_guru > 0 || $telat_karyawan > 0){print "colspan=2";} ?>>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=5><center><b>TOP <?php print $siswavalue;?> Siswa Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td <?php if($telat2 > 0){ echo "colspan=4align='center'"; } else { echo "rowspan=12 width='400px'";}?>>
										<?php include "homeChart.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NIS</th>
									<th width=''>Nama</th>
									<th width=''>Kelas</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row = mysql_query("SELECT count(*) as t,Nama_siswa,nama_panggilan,Nama_Kelas,nis from absensi_siswa,siswa,kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and bulan='$today233' and absensi_siswa.terlambat='y' group by `no_siswa` order by t desc limit 0,$siswavalue") or die (mysql_error());
												
												while($array=mysql_fetch_array($row)){
												$nis = $array["nis"];
												$t = $array["t"];
												$s = $array["nama_panggilan"];
												$k = $array["Nama_Kelas"];
												print "<tr><td>$nis</td><td>$s</td><td>$k</td><td>$t</td></tr>";
												}
										?></tbody>
							</table>
						</div>
						
				</td>
				</tr>
