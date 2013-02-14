<?php
include("../conn/conn.php");

$id	   = $_POST['id'];
$title = $_POST["title"];
$label = $_POST["label"];
$ip    = $_POST["ip"];
$ip2    = $_POST["ip2"];
$ip3    = $_POST["ip3"];
$ip4    = $_POST["ip4"];
$ip5    = $_POST["ip5"];
$key   = $_POST["key"];
$key2   = $_POST["key2"];
$key3   = $_POST["key3"];
$key4   = $_POST["key4"];
$key5   = $_POST["key5"];
$file  = $_FILES["logo"]["tmp_name"];
$logo  = $_FILES["logo"]["name"];




$top_siswa 		= $_POST["top_siswa"];
$top_guru 		= $_POST["top_guru"];
$top_karyawan 	= $_POST["top_karyawan"];

$q_title = mysql_query("select *from title");
$q_fp = mysql_query("select *from fp");
$q_waktutelat = mysql_query("select *from waktu_telat");
$q_top_telat = mysql_query("select *from top_telat");

$array_title = mysql_fetch_array($q_title);
$array_fp= mysql_fetch_array($q_fp);
$array_waktutelat = mysql_fetch_array($q_waktutelat);
$array_toptelat = mysql_fetch_array($q_top_telat);



//---------------------------------------QUERY-----------------------------

//---------------------------------------QUERY WAKT INOUT--------------------
$hari = array("Mon","Tue","Wed","Thu","Fri","Sat");
for($i=0;$i<=5;$i++){
	$jam_masuk   = $_POST["jam_masuk_".$hari[$i]];
	$menit_masuk = $_POST["menit_masuk_".$hari[$i]];
	$jam_pulang	 = $_POST["jam_pulang_".$hari[$i]];
	$menit_pulang= $_POST["menit_pulang_".$hari[$i]];
	
	for($a=0;$a<24;$a++){
		if($jam_jam>=10){
			$jam_jam = $jam_masuk;
		}
		else{
			$jam_jam = "0".$jam_masuk;
		}
	}
	for($b=0;$b<60;$b++){
		if($menit_menit>=10){
			$menit_menit = $menit_masuk;
		}
		else{
			$menit_menit = "0".$menit_masuk;
		}
	}


	for($a_out=0;$a_out<24;$a_out++){
		if($jam_out_out>=10){
			$jam_out_out = $jam_pulang;
		}
		else{
			$jam_out_out = "0".$jam_pulang;
		}
	}
	for($b_out=0;$b_out<60;$b_out++){
		if($menit_menit_out>=10){
			$menit_menit_out = $menit_pulang;
		}
		else{
			$menit_menit_out = "0".$menit_pulang;
		}
	}


	
	$waktu = $jam_jam.":".$menit_menit.":"."00";
	$waktu_out = $jam_out_out.":".$menit_menit_out.":"."00";

	$q_waktu_telat = mysql_query("select *from waktu_telat where hari='".$hari[$i]."'");
	$a_waktu_telat = mysql_fetch_array($q_waktu_telat);
	
	if(!empty($a_waktu_telat)){
		mysql_query("update waktu_telat set waktu='$waktu', jam='$jam_jam', menit='$menit_menit', detik='00', waktu_pulang='$waktu_out', jam_pulang='$jam_out_out', menit_pulang='$menit_menit_out', detik='00',masuk='pagi' where hari='".$hari[$i]."'") or die(mysql_error());
	}else{
		mysql_query("insert into waktu_telat(waktu,jam,menit,detik,waktu_pulang,jam_pulang,menit_pulang,detik_pulang,masuk,hari) values('$waktu','$jam_jam','$menit_menit','00','$waktu_out','$jam_out_out','$menit_menit_out','00','pagi','".$hari[$i]."')") or die(mysql_error());
	}
}

//=========================================================================

if(!empty($logo)&&!empty($array_title)&&!empty($array_fp)&&!empty($array_toptelat))
{
	mysql_query("update title set title='$title', label='$label', logo='$logo'") or die(mysql_error());
	move_uploaded_file($file,"logo/".$logo);


	
	
	if(!empty($key)){
		mysql_query("UPDATE fp SET ip = '$ip', fp.key = '$key' WHERE id = 1")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip2', fp.key = '$key2' WHERE id = 2")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip3', fp.key = '$key3' WHERE id = 3")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip4', fp.key = '$key4' WHERE id = 4")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip5', fp.key = '$key5' WHERE id = 5")or die(mysql_error());
	}
	else{
		mysql_query("UPDATE fp SET ip = '$ip' WHERE id = 1")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip2' WHERE id = 2")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip3' WHERE id = 3")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip4' WHERE id = 4")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip5' where id = 5")or die(mysql_error());
	}
	
	mysql_query("UPDATE top_telat set value='$top_siswa' where id= 1");
	mysql_query("UPDATE top_telat set value='$top_guru' where id= 2");
	mysql_query("UPDATE top_telat set value='$top_karyawan' where id= 3");
	header("location:../index.php");
	//echo "3";
}

else if(!empty($array_title)&&!empty($array_fp)&&empty($logo)&&!empty($array_toptelat)){

	mysql_query("update title set title='$title', label='$label'")or die(mysql_error());;
	


	if(!empty($key)){
		mysql_query("UPDATE fp SET ip = '$ip', fp.key = '$key' WHERE id = 1")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip2', fp.key = '$key2' WHERE id = 2")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip3', fp.key = '$key3' WHERE id = 3")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip4', fp.key = '$key4' WHERE id = 4")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip5', fp.key = '$key5' WHERE id = 5")or die(mysql_error());
	}
	else{
		mysql_query("UPDATE fp SET ip = '$ip' WHERE id = 1")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip2' WHERE id = 2")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip3' WHERE id = 3")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip4' WHERE id = 4")or die(mysql_error());
		mysql_query("UPDATE fp SET ip = '$ip5' where id = 5")or die(mysql_error());
	}
	mysql_query("UPDATE top_telat set value='$top_siswa' where id= 1");
	mysql_query("UPDATE top_telat set value='$top_guru' where id= 2");
	mysql_query("UPDATE top_telat set value='$top_karyawan' where id= 3");
	header("location:../index.php");
	//echo "2";
}
else{

	mysql_query("insert into title(id,title,label,logo) values(1,'$title','$label','$logo')");
	mysql_query("insert into fp(id,ip,fp.key) values(1,'$ip','$key')")or die(mysql_error());
	mysql_query("insert into fp(id,ip,fp.key) values(2,'$ip2','$key2')")or die(mysql_error());
	mysql_query("insert into fp(id,ip,fp.key) values(3,'$ip3','$key3')")or die(mysql_error());
	mysql_query("insert into fp(id,ip,fp.key) values(4,'$ip4','$key4')")or die(mysql_error());
	mysql_query("insert into fp(id,ip,fp.key) values(5,'$ip5','$key5')")or die(mysql_error());
	mysql_query("insert into top_telat(id,value) values(1, $top_siswa)");
	mysql_query("insert into top_telat(id,value) values(2, $top_guru)");
	mysql_query("insert into top_telat(id,value) values(3, $top_karyawan)");
	move_uploaded_file($file,"logo/".$logo);
	header("location:../index.php");
	//echo "1";
}
?>
