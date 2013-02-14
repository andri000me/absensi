<li><a href='#' id="master" >Master</a>
					<ul class="<?php echo $atu ?>" id="emak1">
					<li><a href="?page=Master_Guru" class='limenu'>Guru</a></li>
					<li class='limenu'><a href="?page=Master_Jurusan">Jurusan</a></li>
					<li class='limenu'><a href="?page=Master_Kelas">Kelas</a></li>
					
					<li><a href="#" class='bapak'>Siswa</a>	
						<ul id="anak">
							<?php
								
								print "<li class='siswa'><a href='?page=Master_Siswa'>Semua Siswa </a></li>";
								while($array = mysql_fetch_array($q2)){
									print"<li class='siswa'><a  href='?page=Master_Siswa&kls=".$array["id"]."'>".$array["Nama_Kelas"]."</a></li>";
								}
							
							?>
						</ul>
					</li>

			<li class='limenu'><a href="?page=Master_Karyawan">Karyawan</a></li>
			<li class='limenu'><a href="?page=Master_Libur">Hari Libur</a></li>
			<li class='limenu'><a href="?page=Master_Pengumuman">Pengumuman</a></li>
					
				</ul>
</li>