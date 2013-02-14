<?php
ini_set('display_errors',FALSE);

$bulan=$_POST['bulan'];


include("../conn/conn.php");
$select = "SELECT karyawan.nup, karyawan.nama, absensi_karyawan.tanggal, absensi_karyawan.waktu, absensi_karyawan.keterangan FROM absensi_karyawan, karyawan where absensi_karyawan.karyawan_nup=karyawan.nup and absensi_karyawan.tanggal='$bulan' order by karyawan.nup";

$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );

$fields = mysql_num_fields ( $export );

//for ( $i = 0; $i < $fields; $i++ )
//{
   
    $header .= "NUP" . "\t";
    $header .= "Nama" . "\t";
    $header .= "Tanggal" . "\t";
    $header .= "Waktu Hadir/Absen". "\t";
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
header("Content-Disposition: attachment; filename=Karyawan".$bulan.".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
?>