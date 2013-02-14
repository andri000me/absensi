<?php
include("../../conn/conn.php");

$id 	= $_GET["id"];
$delete	= $_GET["delete"];
$id2 	= $_POST["id"];
$id_jurusan	= $_POST["jurusan"];
$kelas	= $_POST["kelas"];
$guru 	= $_POST["guru"];
$days   = Array("Mon","Tue","Wed","Thu","Fri","Sat");
$time_days= Array();
for($ax=0;$ax<=5;$ax++){	
$jam_masuk   =  $_POST["jam_masuk_".$days[$ax]];
$menit_masuk =  $_POST["menit_masuk_".$days[$ax]];
$jam_pulang  =  $_POST["jam_pulang_".$days[$ax]];
$menit_pulang = $_POST["menit_pulang_".$days[$ax]];
	for($a=0;$a<24;$a++){
		if($jam_masuk>=10){
			$jam_masuk2 = $jam_masuk;
		}
		else{
			$jam_masuk2 = "0".$jam_masuk;
		}
	}
	for($b=0;$b<60;$b++){
		if($menit_masuk>=10){
			$menit_masuk2 = $menit_masuk;
		}
		else{
			$menit_masuk2 = "0".$menit_masuk;
		}
	}


	for($a_out=0;$a_out<24;$a_out++){
		if($jam_pulang>=10){
			$jam_pulang2 = $jam_pulang;
		}
		else{
			$jam_pulang2 = "0".$jam_pulang;
		}
	}
	for($b_out=0;$b_out<60;$b_out++){
		if($menit_pulang>=10){
			$menit_pulang2 = $menit_pulang;
		}
		else{
			$menit_pulang2 = "0".$menit_pulang;
		}
	}


$time_days[$ax] = $jam_masuk2.":".$menit_masuk2.":"."00"."-".$jam_pulang2.":".$menit_pulang2.":00";
//print $time_days[$ax]."<br>";
}



if($kelas == 1){
	$kls = "X";
}
else if($kelas == 2){
	$kls = "XI";
}
else{
	$kls = "XII";
}
$id_jurusan2	= $_POST["jurusan"]." ".$kls;
$b	=	mysql_query("select *from jurusan where id = '$id_jurusan'") or die (mysql_error());
$y	=	mysql_fetch_array($b);
$jurjur = $y["nama"];


$nmkls 	= $kls."-".$jurjur;
$q	=	mysql_query("select *from kelas where Nama_Kelas = '$nmkls'") or die (mysql_error());
$a	=	mysql_fetch_array($q);
//delete
if($id == $id && $delete == "delete"){
	mysql_query("delete from kelas where id='$id'")or die(mysql_error());
	header("location:../../index.php?page=Master_Kelas");	
}
//edit
else if($id2 > 0){
mysql_query("update kelas set  id_guru='$guru', Mon='".$time_days[0]."',Tue='".$time_days[1]."',Wed='".$time_days[2]."',Thu='".$time_days[3]."',Fri='".$time_days[4]."',Sat='".$time_days[5]."' where id='$id2'")OR DIE (mysql_error());
	
	if(mysql_affected_row>0){
		header("location:../../index.php?page=Master_Kelas");
	}
	else{
		header("location:../../index.php?page=Master_Kelas");
	}
}
//add
else if($a["Nama_Kelas"]==$nmkls){
	header("location:../../index.php?page=Master_Kelas_err");
}
else{
mysql_query("insert into kelas(Nama_kelas,id_jurusan,id_guru,Mon,Tue,Wed,Thu,Fri,Sat) values('$nmkls','$id_jurusan2','$guru','".$time_days[0]."','".$time_days[1]."','".$time_days[2]."','".$time_days[3]."','".$time_days[4]."','".$time_days[5]."')") or die(mysql_error());
header("location:../../index.php?page=Master_Kelas");
}
?>

