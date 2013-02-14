
			<tr class="aa" >
			<?php if($telat_karyawan > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Karyawan Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NUP</b></td>
								<td><b>Nama</b></td>
							</thead>
						</tr>
							
						<?php
						$row33 = mysql_query("select * from absensi_karyawan where tanggal='$today' and terlambat='y' order by karyawan_nup") or die (mysql_error());
					
						while($array33=mysql_fetch_array($row33)){
							$nup_ini=$array33['karyawan_nup'];
							$row_karyawan_ini=mysql_query("select * from karyawan where nup='$nup_ini'");
							$array_karyawan_ini=mysql_fetch_array($row_karyawan_ini);
							print "<tr><td>".$array_karyawan_ini['nup']."</td><td>".$array_karyawan_ini['nama']."</td></tr>";
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
			<td  <?php if($telat2 > 0 || $telat_guru > 0){print "colspan=2";} ?>>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=6><center><b>TOP <?php print $karyawanvalue;?> Karyawan Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td <?php if($telat_karyawan > 0){ echo "colspan=4align='center'"; } else { echo "rowspan=12 width='400px'";}?>>
										<?php include "homeChartKaryawan.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NUP</th>
									<th width=''>Nama</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row222 = mysql_query("SELECT count(*) as t,nama,nup from absensi_karyawan,karyawan where absensi_karyawan.karyawan_nup=karyawan.nup  and bulan='$today233' and absensi_karyawan.terlambat='y' group by `karyawan_nup` order by t desc limit 0,$karyawanvalue") or die (mysql_error());
												
												while($array222=mysql_fetch_array($row222)){
												$nup = $array222["nup"];
												$t = $array222["t"];
												$s = $array222["nama"];
												print "<tr><td>$nup</td><td>$s</td><td>$t</td></tr>";
												}
												
										?>
										
										</tbody>

							</table>
						</div>
						
				</td>
				</tr>
	