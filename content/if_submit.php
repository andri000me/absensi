<?php
print "<script type='text/javascript'>
function alert_hari()
{
alert('Maaf hari libur tidak dapat absen');
}

</script>";
?>
<?php
$q_libur=mysql_query("select *from hari_libur where tipe='sekolah'");
$q_liburkelas=mysql_query("select *from hari_libur where id_kelas like '%$p,%' and tipe='kelas'");
$hari= date("D");
$bulan = date ("m");
$tanggal = date("d-m-Y");
$hasil = null;
$hasil2 = null;
while($a_liburkelas = mysql_fetch_array($q_liburkelas)){
	$mulai = $a_liburkelas["tanggal_mulai"];
	$akhir = $a_liburkelas["tanggal_akhir"];
	$pecahh=strtok($mulai, " ");
	$tanggal_mulai=strtok($pecahh, "-");
	$bulan_mulai=strtok("-");
	$tahun_mulai=strtok("-");
	
	
	$pecahhh=strtok($akhir, " ");
	$tanggal_akhir=strtok($pecahhh, "-");
	$bulan_akhir=strtok("-");
	$tahun_akhir=strtok("-");
	
	$pecahhhh=strtok($tanggal_mulai, " ");
	$tanggal_mulai_pecah = strtok($pecahhhh, "0");
	
	
	for($a = $tanggal_mulai_pecah ; $a<$tanggal_akhir+1 ; $a++){

		if($a<10){
			$b = "0".$a;
		}
		else{
			$b = $a;
		}
			
		
		$tanggal2=$b."-".$bulan."-".$tahun_mulai;
		//print $tanggal." = ".$tanggal2." ; ";
		
		if($tanggal==$tanggal2){
			$hasil2 = 'endaycb';
				//print $tanggal."=".$tanggal2.";- ";
		}
		else if($hari == "Sun"){
			$hasil2 = 'endaycb juga';
		}

		
		
    }

}
while($array_libur = mysql_fetch_array($q_libur)){
	$mulai = $array_libur["tanggal_mulai"];
	$akhir = $array_libur["tanggal_akhir"];
	$pecahh=strtok($mulai, " ");
	$tanggal_mulai=strtok($pecahh, "-");
	$bulan_mulai=strtok("-");
	$tahun_mulai=strtok("-");
	
	
	$pecahhh=strtok($akhir, " ");
	$tanggal_akhir=strtok($pecahhh, "-");
	$bulan_akhir=strtok("-");
	$tahun_akhir=strtok("-");
	
	$pecahhhh=strtok($tanggal_mulai, " ");
	$tanggal_mulai_pecah = strtok($pecahhhh, "0");
	
	
	for($a = $tanggal_mulai_pecah ; $a<$tanggal_akhir+1 ; $a++){

		if($a<10){
			$b = "0".$a;
		}
		else{
			$b = $a;
		}
			
		
		$tanggal2=$b."-".$bulan."-".$tahun_mulai;
		//print $tanggal." = ".$tanggal2." ; ";
		
		if($tanggal==$tanggal2){
			$hasil = 'endaycb';
				//print $tanggal."=".$tanggal2.";- ";
		}
		else if($hari == "Sun"){
			$hasil = 'endaycb juga';
		}

		
		
    }

}
if($hasil2){
echo "<input type='button' Onclick='alert_hari()' class='submit fl-space' value='Simpan' />";

}
else{
echo "<input type='submit' value='Simpan' id='submit2' class='submit fl-space' onclick='show_absen()' />";
}


?>