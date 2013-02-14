<?php

$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
	if($Connect){
		
		$soap_request="<DeleteUser><ArgComKey Xsi:type=\"xsd:integer\">".$Key."</DeleteUser>
                <Arg><PIN xsi:type='xsd:integer'>".$PIN."</PIN><Name></Name></Arg></ClearData>";
		$newLine="\r\n";
		fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
	    fputs($Connect, "Content-Type: text/xml".$newLine);
	    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
	    fputs($Connect, $soap_request.$newLine);
		$buffer="";
		while($Response=fgets($Connect, 1024)){
			$buffer=$buffer.$Response;
		}
	}else //echo "Koneksi Gagal";
	include("parse.php");	
	$buffer=Parse_Data($buffer,"<Information>","</Information>");
	//echo "<B>Result:</B><BR>";
	//echo $buffer;
	
?>