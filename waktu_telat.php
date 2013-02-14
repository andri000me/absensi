<?php
		$q_kelas2 = mysql_query("select * from kelas");
		while($a_kelas2 = mysql_fetch_array($q_kelas2)){
		$waktu_Mon.$a_kelas2["id"]	  = $a_kelas2["Mon"];		
		$waktu_Tue.$a_kelas2["id"]	  = $a_kelas2["Tue"];		
		$waktu_Wed.$a_kelas2["id"]	  = $a_kelas2["Wed"];		
		$waktu_Thu.$a_kelas2["id"]	  = $a_kelas2["Thu"];		
		$waktu_Fri.$a_kelas2["id"]	  = $a_kelas2["Fri"];		
		$waktu_Sat.$a_kelas2["id"]	  = $a_kelas2["Sat"];		
		
		}
?>