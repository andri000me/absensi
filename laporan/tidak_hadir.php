<?php

$tidak_hadir = mysql_query("SELECT * FROM absensi_siswa WHERE kd_kelas='$id_kelas' and bulan='$tanggal_bulan' and no_siswa='$nis' and keterangan='s' or keterangan='i' or keterangan='a'");
$total_tidak_hadir = mysql_num_rows($tidak_hadir);
echo $total_tidak_hadir;


?>