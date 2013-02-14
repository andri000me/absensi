<?php
$ud=$id_finger;
if($nama_panggilan==""){
	$nama_user = $nama;
}
else{
	$nama_user = $nama_panggilan;
}

$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		
	
		$soap_request="<SetUserInfo><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><PIN>".
		$ud."</PIN><Name>".$nama_user."</Name></Arg></SetUserInfo>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
	}//else echo "Koneksi Gagal";
		
	//echo $buffer;
	$buffer=Parse_Data($buffer,"<Information>","</Information>");
?>