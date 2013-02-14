 					<script language="JavaScript">

						<!--
						// please keep these lines on when you copy the source
						// made by: Nicolas - http://www.javascript-page.com

						var clockID = 0;

						function UpdateClock() {
							if(clockID) {
								clearTimeout(clockID);
								clockID  = 0;
							}

							var tDate = new Date();

									document.theClock.theTime.value = "" 
											+ tDate.getHours() + ":" 
											+ tDate.getMinutes() + ":" 
											+ tDate.getSeconds();

								clockID = setTimeout("UpdateClock()", 1000);
						}
						function StartClock() {
							clockID = setTimeout("UpdateClock()", 500);
						}

						function KillClock() {
							if(clockID) {
								clearTimeout(clockID);
									clockID  = 0;
							}
						}

						//-->

					</script>

<?php
$today		= 	date("d-m-Y");
$i=$_GET["page"];
		$query=mysql_query("select * from karyawan");
		$nomor=1;
		while($row=mysql_fetch_array($query)){
		$nup = $row["nup"];
		
		$q_absenKaryawanByTanggal = mysql_query("SELECT * FROM `absensi_karyawan` where tanggal='$today' and Karyawan_nup='$nup'");
		$a_absenKaryawanByTanggal = mysql_fetch_array($q_absenKaryawanByTanggal);
		if(!empty($a_absenKaryawanByTanggal)){
			$enabled='disabled';
		}else{
			$enabled="";
		}
		echo "<tr><td>".$row['nup']."</td>";
		echo "<td>".$row['nama']."</td>";
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
									<?php echo "<input type='hidden' name='nup".$nomor."' value='".$row['nup']."'>";
							echo "<input type='hidden' name='id_finger".$nomor."' value='".$row['id_finger']."'>";
							
		$nomor++;
		}
		
		
?>