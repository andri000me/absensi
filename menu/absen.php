<li><a href="#" id="absensi">Presensi Siswa</a>
				<ul class="<?php echo $dua ?>" id="emak2">
					<?php
						include("conn/conn.php");
						
						if($_SESSION["guru"])
						{
						$g = $_SESSION["guru"];
						$que = mysql_query("select *from kelas where id_guru='$g'");
						$arr = mysql_fetch_array($que);
						
							//echo "<li class='limenu'><a href='?page=".$arr["id"]>.">".$arr["Nama_Kelas"]."</a></li>";
						print "<li class='limenu'><a href='?page=".$arr['id']."'>".$arr['Nama_Kelas']."</a>";
						}
						else{
							$q=mysql_query("select* from kelas order by Nama_Kelas");
							while($isi=mysql_fetch_array($q)){
						echo "<li class='limenu'><a href='?page=".$isi["id"]."'>".$isi["Nama_Kelas"]."</a></li>";
						}
						}
						
						
					?>
				</ul>	
			</li>