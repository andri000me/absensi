<?php
ini_set('display_errors',FALSE);
include("../conn/conn.php");
$id_kls=$_POST['kelas'];
$nis=$_POST['nis'];
$bulan=$_POST['bulan'];
$tanggal_mulai=$_POST['tanggal_mulai_download'];
$tanggal_akhir=$_POST['tanggal_akhir_download'];
$nama=$_POST['nama_siswa'];

$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu, absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa='$nis' and siswa.nis='$nis' and absensi_siswa.kd_kelas='$id_kls' and kelas.id=absensi_siswa.kd_kelas and absensi_siswa.tanggal between '$tanggal_mulai' and '$tanggal_akhir' and bulan='$bulan_tahun' and absensi_siswa.keterangan<>'out' order by absensi_siswa.tanggal";

$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

    $header .= "NIS" . "\t";
    $header .= "Absen" . "\t";
    $header .= "Nama" . "\t";
    $header .= "Kelas". "\t";
    $header .= "Tanggal". "\t";
    $header .= "Waktu". "\t";
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
header("Content-Disposition: attachment; filename=NIS".$nis." Periode.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>