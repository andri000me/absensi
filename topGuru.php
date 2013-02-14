	<tr class="aa" >
			<?php if($telat_guru > 0){ ?>
			<td width='40%'>
			
				<div class="box-header clear">
					<h2><center><font color="#c20000"><b>Guru Terlambat<br> <?php print $today2 ?></font><b></center></h2>
				</div>
				<div class="box-body clear">
					<table width=100%>
						<tr>
							<thead>
								<td width='10%'><b>NIP</b></td>
								<td><b>Nama</b></td>
							</thead>
						</tr>
							
						<?php
						$row2 = mysql_query("select * from absensi_guru where tanggal='$today' and terlambat='y' order by guru_nip") or die (mysql_error());
					
						while($array2=mysql_fetch_array($row2)){
							$nip_ini=$array2['guru_nip'];
							$row_guru_ini=mysql_query("select * from guru where nip='$nip_ini'");
							$array_guru_ini=mysql_fetch_array($row_guru_ini);
							print "<tr><td>".$array_guru_ini['nip']."</td><td>".$array_guru_ini['nama']."</td></tr>";
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
			<td colspan=2>
					<div class="box-header clear">
						<h2><center><b>TOP TERLAMBAT (<?php print $month; ?>)</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead>
									<tr>
										<td colspan=6><center><b>TOP <?php print $guruvalue;?> Guru Terlambat Bulan <?php print $month;?></b></center></td>
									</tr>	
								</thead>
								<tbody>
								<tr width="30%">
									<td id='tdChart' <?php if($telat_guru > 0){ echo "colspan=4 align='center'"; } else { echo "rowspan=12 width='500px'";}?>>
										<?php include "homeChartGuru.php";?>
									</td>
								</tr>
								
								<tr class='en' width="100%">
									<th width="">NIP</th>
									<th width=''>Nama</th>
									<th width=''>Total</th>
								</tr>
											
										<?php
												$row2 = mysql_query("SELECT count(*) as t,nama,nip from absensi_guru,guru where absensi_guru.guru_nip=guru.nip  and bulan='$today233' and absensi_guru.terlambat='y' group by `guru_nip` order by t desc limit 0,$guruvalue") or die (mysql_error());
												
												while($array2=mysql_fetch_array($row2)){
												$nip = $array2["nip"];
												$t = $array2["t"];
												$s = $array2["nama"];
												print "<tr><td>$nip</td><td>$s</td><td>$t</td></tr>";
												}
										?>
								</tbody>
							</table>
						</div>
						
				</td>
				</tr>