<?php
ini_set('display_errors',FALSE);
include("../../conn/conn.php");

$nama=$_POST['nama_siswa'];
//-----------------------------------------------------------------------------
if($_POST["jenis_laporan"] == "semester"){
$semester = $_POST["semester"];
$tahun_ajaran = $_POST["tahun_ajaran"];
$in_out = $_POST["in_out"];
$nis = $_POST["nis"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.in_out, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.semester='$semester' and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
}
if($_POST["jenis_laporan"] == "out_semester"){
$semester = $_POST["semester"];
$tahun_ajaran = $_POST["tahun_ajaran"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.in_out, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.semester='$semester' and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='out_auto' order by absensi_siswa.tanggal";
}
else if($_POST["jenis_laporan"] == "tahun_ajaran"){
$tahun_ajaran = $_POST["tahun_ajaran"];
$in_out = $_POST["in_out"];
$nis = $_POST["nis"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.in_out, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.tahun_ajaran='$tahun_ajaran' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
}
else if($_POST["jenis_laporan"] == "perbulan"){
$tgl_bulan = $_POST["bulan"];
$nis = $_POST["nis"];
$in_out = $_POST["in_out"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.in_out, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.bulan='$tgl_bulan' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
}
else if($_POST["jenis_laporan"] == "pertanggal"){
$tgl_bulan = $_POST["bulan"];
$tgl_start = $_POST["mulai"];
$tgl_finish = $_POST["akhir"];
$nis = $_POST["nis"];
$in_out = $_POST["in_out"];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.in_out, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis=absensi_siswa.no_siswa and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.tanggal between '$tgl_start' and '$tgl_finish' and absensi_siswa.bulan='$tgl_bulan' and absensi_siswa.in_out='$in_out' order by absensi_siswa.tanggal";
"LAPORAN DATA SISWA $nama  PERIODE TANGGAL $tgl_start s/d $tgl_finish";
}
//-----------------------------------------------------------------------------
$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

    $header .= "NIS" . "\t";
    $header .= "Absen" . "\t";
    $header .= "Nama" . "\t";
    $header .= "Kelas". "\t";
    $header .= "Tanggal". "\t";
    $header .= "Waktu". "\t";
	$header .= "Jenis Absen". "\t";
    $header .= "Keterangan". "\t";

while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
		else if ($value == "h"){
			$value = "Hadir";
		}
		else if ($value == "i"){
			$value = "Izin";
		}
		else if ($value == "a"){
			$value = "Alpa";
		}
		else if ($value == "s"){
			$value = "Sakit";
		}
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );

if ( $data == "" ){
    $data = "\nTidak Ada Data (0) !\n";                        
}

header("Content-type: application/octet-stream");
if($_POST["jenis_laporan"] == "semester"){
header("Content-Disposition: attachment; filename=".$nama." tahun_ajaran=".$tahun_ajaran." semester=".$semester.".xls");
}
else if($_POST["jenis_laporan"] == "tahun_ajaran"){
header("Content-Disposition: attachment; filename=".$nama." tahun_ajaran=".$tahun_ajaran.".xls");
}
else if($_POST["jenis_laporan"] == "perbulan"){
header("Content-Disposition: attachment; filename=".$nama." bulan=".$tgl_bulan.".xls");
}
else if($_POST["jenis_laporan"] == "pertanggal"){
header("Content-Disposition: attachment; filename=".$nama." periode=".$tgl_start." s_d ".$tgl_finish.".xls");
}
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>