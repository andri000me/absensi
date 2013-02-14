<?php
$hariini = date("l");
$tanggalini = date("d-m-Y");
$query = mysql_query("select *from minggu order by minggu desc limit 0,1");
$num   = mysql_num_rows($query);
if($num == 0){
	$minggu = 1;
}else{
	$array = mysql_fetch_array($query);
	$minggu = $array['minggu'];
	if($hariini == "Monday"){
		$minggu++;
		mysql_query("insert into minggu(minggu,tanggal) values('$minggu','$tanggalini')");
	}
	$minggu = $minggu;
}

$query2 = mysql_query("select *from minggu order by minggu desc limit 0,1");
$num2    = mysql_num_rows($query2);
$mingguke = $array['minggu'];
?>