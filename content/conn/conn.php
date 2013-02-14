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
$i=$_GET["page"];
		$query=mysql_query("select * from siswa where id_kelas='$i' order by nis");
		$nomor=1;
		while($row=mysql_fetch_array($query)){
		
		echo "<tr><td>".$row['absen']."</td>";
		echo "<td>".$row['Nama_siswa']."</td>";
							echo   "<input type='hidden' name='nomor' value='$nomor'/>
									<td><input type='radio' class='checkbox' name='$nomor' value='h' checked/></td>	
									<td><input type='radio' class='checkbox' name='$nomor' value='a'/></td>	
									<td><input type='radio' class='checkbox' name='$nomor' value='i'/></td>	
									<td><input type='radio' class='checkbox' name='$nomor' value='s'/></td></tr>";
							echo "<input type='hidden' name='nis".$nomor."' value='".$row['nis']."'>";
							
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