<?php
include("parse.php");



$q3	=	mysql_query("select *from fp");


while($array3=mysql_fetch_array($q3)){

$IP=$array3["ip"];
$Key=$array3["key"];

	if($IP!=""){
		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		if($Connect){
			$soap_request="<ClearData><ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey><Arg><Value xsi:type=\"xsd:integer\">3</Value></Arg></ClearData>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
		}else echo "";

		$buffer=Parse_Data($buffer,"<Information>","</Information>");
		}
}	
?>

