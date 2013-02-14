<?php
include("../../conn/conn.php");
date_default_timezone_set('Asia/Jakarta');

$id 	    = $_GET["id"];
$id_edit	= $_POST["id"];
$nis		= $_POST["nis"];
$kelamin	= $_POST["kelamin"];
$tempat_lahir = $_POST["tempat_lahir"];
$tgl 		= $_POST["tgl"];
$bulan		= $_POST["bulan"];
$tahun	    = $_POST["tahun"];
$tgl_lahir 	= $_POST["tgllahir"];
$agama		= $_POST["agama"];
$alamat     = $_POST["alamat"];
$id_finger  = $_POST["id_finger"];

$pass  	    = $_POST["password"];
$idklss	    = $_POST["kelas"];
$absenn     = $_POST["absen"];



include("parse.php");
$q2	=	mysql_query("select *from fp");

$q_siswa2=mysql_query("select * from siswa where nis='$nis'");
$array_siswa_table2=mysql_fetch_array($q_siswa2);
$nis_table2 = $array_siswa_table['nis'];

$q_siswaById_finger=mysql_query("select * from siswa where id_finger='$id_finger'");
$array_siswaById_finger=mysql_fetch_array($q_siswaById_finger);
$id_finger2 = $array_siswaById_finger['id_finger'];

if(empty($pass)){
$query_pass=mysql_query("select * from siswa where id='$id_edit'");
$array_pass=mysql_fetch_array($query_pass);
$password = $array_pass['password'];

}
else{
$password 	= md5($_POST["password"]);
}

$delete    			= $_GET["delete"];
$include    		= $_POST["include"];
$absen 	    		= $_POST["absen"];
$nama    			= $_POST["nama"];
$nama_panggilan    	= $_POST["nama_panggilan"];
$kelas   			= $_POST["kelas"];
$idkls	    		= $_POST["idkls"];
$kls	    		= $_GET["kls"];
$file   			= $_FILES["foto"]["tmp_name"];
$foto   			= $_FILES["foto"]["name"]; 

$q_siswa=mysql_query("select * from siswa where id_kelas='$idklss' and absen='$absenn'")or die(mysql_error());
$array_siswa_table=mysql_fetch_array($q_siswa);
$absen_table = $array_siswa_table['absen'];

$q_siswa3=mysql_query("select * from siswa where id_kelas='$idkls' and absen='$absenn'")or die(mysql_error());
$array_siswa_table3=mysql_fetch_array($q_siswa3);
$absen_table3 = $array_siswa_table2['absen'];



//untuk delete--------------------------------------------------------------------------------------------------
if($id == $id && $delete == "delete"){

	$query_siswa=mysql_query("select * from siswa where id='$id'");
	$array_siswa=mysql_fetch_array($query_siswa);
	$PIN=$array_siswa["id_finger"];
	$kelas_siswa=$array_siswa["id_kelas"];
	$absen_siswa=$array_siswa["id_finger"];
	$jml_absen=mysql_query("select * from absensi_siswa where id_finger='$absen_siswa' and kd_kelas='$kelas_siswa'");
	$total_absen=mysql_num_rows($jml_absen);
	
	if($nis == "")
	{	
		header("location:../../index.php?page=input_error_siswa");
	}
	
	for($a=1;$a<=$total_absen;$a++){
		mysql_query("delete from absensi_siswa where id_finger='$absen_siswa' and kd_kelas='$kelas_siswa'");
	}
	
	mysql_query("delete from siswa where id='$id'");
	
	if($kls > 0){
		header("location:../../index.php?page=Master_Siswa&kls=$kls");
	}
	else{
		header("location:../../index.php?page=Master_Siswa");
	}
	//untuk delete user fp-------------------------------------------------------------------------------------------------
		while($array2=mysql_fetch_array($q2)){
			$IP=$array2["ip"];
			$Key=$array2["key"];
			include("../../absen_fp/delete_user.php");		
		}
	//---------------------------------------------------------------------------------------------------------------------
}

//untuk edit database--------------------------------------------------------------------------------------------------
else if($nis=="" || $nama=="" || $tempat_lahir=="" || $agama=="" || $alamat =="" || $absen=="" && $delete != "delete"){
		header("location:../../index.php?page=Master_Siswa_err");
		//echo $nis;
	}
else if($include == "edit"){
	
	$query_siswa=mysql_query("select * from siswa where id='$id_edit'");
	$array_siswa=mysql_fetch_array($query_siswa);
	$kelas_siswa=$array_siswa["id_kelas"];
	$absen_siswa=$array_siswa["nis"];
	$jml_absen=mysql_query("select * from absensi_siswa where id_finger='$absen_siswa' and kd_kelas='$kelas_siswa'");
	$total_absen=mysql_num_rows($jml_absen);
	
	$q_siswa1=mysql_query("select * from siswa where id_kelas='$idklss' and absen='$absenn'");
	$array_siswa_table1=mysql_fetch_array($q_siswa1);
	$absen_table1 = $array_siswa_table1['absen'];
	$nis_table1 = $array_siswa_table1['nis'];
	


		for($a=1;$a<=$total_absen;$a++){
		mysql_query("update absensi_siswa set no_siswa='$nis', id_finger='$id_finger', kd_kelas='$kelas' where no_siswa='$absen_siswa' and kd_kelas='$kelas_siswa'");
		}
		
		if(!empty($foto)){
			if(!empty($array_siswa_table3)){
					header("location:../../index.php?page=Master_Siswa_err_absennis");
				}else{
				//untuk input mesin fp-------------------------------------------------------------------------------------------------
				while($array2=mysql_fetch_array($q2)){
					$IP=$array2["ip"];
					$Key=$array2["key"];
					include("../../absen_fp/input_user.php");
				}
				//---------------------------------------------------------------------------------------------------------------------
				mysql_query("update siswa set nis='$nis', id_finger='$id_finger', Nama_siswa='$nama', nama_panggilan='$nama_panggilan', kelamin='$kelamin', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', agama='$agama', alamat='$alamat', password='$password', id_kelas='$kelas', absen='$absen', foto='$foto' where id='$id_edit'");
				move_uploaded_file($file,"../foto-siswa/".$foto)or die (mysql_error()) ;
			
				if(mysql_affected_row>0){
					header("location:Master_Siswa");
				}
				else{
					header("location:../../index.php?page=Master_Siswa&kls=$idkls");
				}
			}
		}
		else{
			if(!empty($array_siswa_table3)){
				header("location:../../index.php?page=Master_Siswa_err_absennis");
				//print "a";
			}else{
				//untuk input mesin fp-------------------------------------------------------------------------------------------------
				while($array2=mysql_fetch_array($q2)){
					$IP=$array2["ip"];
					$Key=$array2["key"];
					include("../../absen_fp/input_user.php");
				}
				//---------------------------------------------------------------------------------------------------------------------
				mysql_query("update siswa set nis='$nis', id_finger='$id_finger', Nama_siswa='$nama', nama_panggilan='$nama_panggilan', kelamin='$kelamin', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', agama='$agama',  alamat='$alamat', password='$password', id_kelas='$kelas', absen='$absen' where id='$id_edit'")or die(mysql_error());

				if(mysql_affected_row>0){
					header("location:Master_Siswa");
				}
				else{
					header("location:../../index.php?page=Master_Siswa&kls=$idkls");
				}
			}
		}


}


//untuk input database--------------------------------------------------------------------------------------------------

else{

	if($idkls > 0){
		if(!empty($array_siswa_table3) || !empty($array_siswa_table2) || !empty($array_siswaById_finger)){
			header("location:../../index.php?page=Master_Siswa_err_absennis");
		}else{
			//untuk input mesin fp-------------------------------------------------------------------------------------------------
			while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
			}
			//---------------------------------------------------------------------------------------------------------------------
			mysql_query("insert into siswa(nis,id_finger,Nama_siswa,nama_panggilan,kelamin,tempat_lahir,tgl_lahir,agama,alamat,password,id_kelas,absen,foto) values('$nis','$id_finger','$nama','$nama_panggilan','$kelamin','$tempat_lahir','$tgl_lahir','$agama','$alamat','$password','$idkls','$absen','$foto')") or die(mysql_error());
			$ud=$nisn;
			move_uploaded_file($file,"../foto-siswa/".$foto) ;

			if(mysql_affected_row>0){
				header("location:Master_Siswa");
			}
			else{
				header("location:../../index.php?page=Master_Siswa&kls=$idkls");
			}
		}
	}
	
	
	else{
		if(!empty($array_siswa_table) || !empty($array_siswa_table2) || !empty($array_siswaById_finger)){
				header("location:../../index.php?page=Master_Siswa_err_absennis");
			}else{
			//untuk input mesin fp-------------------------------------------------------------------------------------------------
			while($array2=mysql_fetch_array($q2)){
				$IP=$array2["ip"];
				$Key=$array2["key"];
				include("../../absen_fp/input_user.php");
			}
			//---------------------------------------------------------------------------------------------------------------------
			mysql_query("insert into siswa(nis,id_finger,Nama_siswa,nama_panggilan,kelamin,tempat_lahir,tgl_lahir,agama,alamat,password,id_kelas,absen,foto) values('$nis','$id_finger','$nama','$nama_panggilan','$kelamin','$tempat_lahir','$tgl_lahir','$agama','$alamat','$password','$kelas','$absen','$foto')") or die(mysql_error());
			$ud=$nisn;
			move_uploaded_file($file,"../foto-siswa/".$foto) ;
			if(mysql_affected_row>0){
				header("location:Master_Siswa");
			}
			else{
				header("location:../../index.php?page=Master_Siswa");
			}
		}
	}
}	



?>
