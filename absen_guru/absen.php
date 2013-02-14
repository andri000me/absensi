<?php
if($_SESSION["admin"]){

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
?><body>

 

				<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<h2>Presensi Guru </h2>

					<body onload="StartClock()" onunload="KillClock()" >
					<form name="theClock" align="right">
						<font color="red"><?php echo date("d-m-Y"); ?> &nbsp; <input name="theTime" size=6 disabled style="padding-left:8px; color:red;"></font>
					</form>
				</div>

				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">					
						<form method="post" action="absen_guru/proses.php">
		

						<table>
							<thead>
								<tr>
									<th>NIP</th>
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
include("absen_guru/conn.php");	
?>									
							</tbody>
						</table>
						<input type='hidden' name='jumlah' value='<?php echo $nomor ?>'>
						<div class="tab-footer clear">
							<div class="fl">
								
								
<?php
include("absen_guru/if_submit.php");	
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