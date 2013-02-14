<?php
ini_set('display_errors',FALSE);


include("../conn/conn.php");
$id_kelas=$_POST['id_kelas'];
$tanggal=$_POST['tanggal'];
$bulan=$_POST['bulan'];
$nama_kelas=$_POST['nama_kelas'];
$select = "SELECT siswa.nis, siswa.absen, siswa.Nama_siswa, kelas.Nama_Kelas, absensi_siswa.tanggal, absensi_siswa.waktu,absensi_siswa.keterangan FROM absensi_siswa, siswa, kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and absensi_siswa.kd_kelas='$id_kelas' and absensi_siswa.tanggal='$tanggal' and absensi_siswa.keterangan<>'out' order by siswa.absen";


$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

//for ( $i = 0; $i < $fields; $i++ )
//{
   
    $header .= "NIS" . "\t";
    $header .= "Absen" . "\t";
    $header .= "Nama" . "\t";
    $header .= "Kelas". "\t";
    $header .= "Tanggal". "\t";
    $header .= "Wsaktu". "\t";
    $header .= "Keterangan". "\t";
//}

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

if ( $data == "" )
{
    $data = "\n(0) Records Found!\n";                        
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$nama_kelas."_".$bulan.".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>