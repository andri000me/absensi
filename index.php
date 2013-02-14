<?php
	ini_set(error_reporting,E_ALL);
	session_start();
	include("conn/conn.php");
	include("parse.php");
date_default_timezone_set('Asia/Jakarta');

	if(isset($_SESSION['admin']) || isset($_SESSION['guru']) || isset($_SESSION['user']))
	{
	$usr=$_SESSION['user'];
	$guru=$_SESSION['guru'];
	//echo $user;
	include('conn/conn.php');
	$q=mysql_query("select* from kelas where id='$p'");
	$q2=mysql_query("select *from kelas order by Nama_Kelas");
	$q3=mysql_query("select *from title");
	$q4=mysql_query("select *from siswa where id='$usr'");
	$q5=mysql_query("select *from guru where No='$guru'");
	$array5 = mysql_fetch_array($q5);
	$array3 = mysql_fetch_array($q3);
	$array4 = mysql_fetch_array($q4);
	
	
?>
<center><font size='100'></font></center>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- Source is http://www.ait.sk/uniadmin/ -->

<head>
<link type="text/css" href="UniAdmin_files/jquery.ui.all.css" rel="stylesheet" />

<link type="text/css" href="UniAdmin_files/jquery.ui.datepicker.css" rel="stylesheet" />


<script type="text/javascript" src="UniAdmin_files/jquery-1.7.1.js"></script>

<script type="text/javascript" src="UniAdmin_files/jquery.ui.core.js"></script>

<script type="text/javascript" src="UniAdmin_files/jquery.ui.datepicker.js"></script>
<script type="text/javascript">

$(function() {

$("#tanggal").datepicker({dateFormat: "dd MM yy"});

});

$(function() {

$("#tanggal2").datepicker({dateFormat: "dd-mm-yy"});

});

$(function() {

$("#tanggal3").datepicker({dateFormat: "dd-mm-yy"});

});

</script>
	<script language=JavaScript>
<!--

/*var message="";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}

document.oncontextmenu=new Function("return false")
// -->*/

</script>
<script type="text/javascript">
  var idList = ";"
  document.getElementById('textbox1').value = idList;

  function dell(cek, id) {

    if (cek.checked == 1) {
      idList = idList + id + ";"
      document.getElementById('textbox1').value = idList;
    }

    if (cek.checked == 0) {
      var v;
      v = ";" + id + ";"
      idList = idList.replace(v, ";");
      document.getElementById('textbox1').value = idList;
    }

    if (idList == ";") {
      document.getElementById('submit2').disabled = true;
    } else {
      document.getElementById('submit2').disabled = false;
    }

  }

</script>

<?php
@$siswa_master = $_GET["siswa"];
		
		if($siswa_master == "gagal"){
			echo "<script>alert('NISN tidak boleh di kosong')</script>";
		}
		else if($siswa_master == "sama"){
			echo "<script>alert('NISN tersebut sudah dipakai')</script>";
		}
		
?>

<link rel="shortcut icon" href="master/logo/<?php print $array3["logo"];?>" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="AIT"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title><?php print $array3["title"];?></title>
<script type="text/javascript" src="dashboard_files/jquery.ui.slider.js"></script>
 <script type="text/javascript" src="dashboard_files/jquery.custom.js"></script>
 <!-- end tabs scripts -->
 <!-- start styles css -->
<link type="text/css" rel="stylesheet" href="dashboard_files/adminz.styles.css" />
<link rel="stylesheet" href="UniAdmin_files/reset.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/screen.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/visualize.css" type="text/css"/>
<link rel="stylesheet" href="UniAdmin_files/visualize-light.css" type="text/css"/>
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="UniAdmin_files/ie7.css" />
<![endif]-->	

<script type="text/javascript" src="UniAdmin_files/jquery2.js"></script>
<script type="text/javascript" src="UniAdmin_files/tooltip.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.visualize.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.tinymce.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.fancybox.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.idtabs.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.datatables.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.jeditable.js"></script>
<script type="text/javascript" src="UniAdmin_files/jquery.ui.js"></script>

<script type="text/javascript" src="UniAdmin_files/excanvas.js"></script>
<script type="text/javascript" src="UniAdmin_files/cufon.js"></script>
<script type="text/javascript" src="UniAdmin_files/Geometr231_Hv_BT_400.font.js"></script>
<script type="text/javascript" src="UniAdmin_files/script.js"></script>

</head>
			<script>
    window.setTimeout("waktu()",100);   
    function waktu() {    
        var tanggal = new Date();   
        setTimeout("waktu()",1000);   
		if(tanggal.getHours()<10){
			var jam =  "0"+tanggal.getHours();
		}else{
			var jam = tanggal.getHours();
		}
		
		if(tanggal.getMinutes()<10){
			var menit = "0"+tanggal.getMinutes();
		}else{
			var menit = tanggal.getMinutes();
		}
		
        document.getElementById("output").innerHTML = jam+":"+menit;
		
	} 
</script>
<body >
<!-- begin fixed right panel -->
	<div class="fixed_right_panel fixed_right_panel_hide corners_left">
		<div class="hidden_right_div">
			<div class='digitaltime'>
			<font color='white' face=''><label id="output"></label></font>
			
			
		
			</div>
		</div>
	<div class="show_right_div left_arrow"></div>
	  <div class="clear"></div>
	</div><!-- end fixed right panel -->
	
<div class="clear">
	<ul >
	<li class="menuPanel" >
	<div class="sidebar"> <!-- *** sidebar layout *** -->
		<div class="logo clear" >
			<a href="#" title="Hide Menu">
				<img src="master/logo/<?php print $array3["logo"];?>" width="25%" alt="" class="picture" onclick="menuSlide();" title="Hide Menu"/>
				
			</a>
			<a href="index.php" title="View dashboard">
				<span class="title"><?php print $array3["label"];?></span>
				<span class="text" >Presensi</span>
			</a>	
			
		</div>
		<?php
			include("menu/menu.php");
		?>

	</div>
	</li>
	</ul>
	<div class="logo2 clear" id="logoDalem"  onclick="menuSlide();" title="Show Menu">
			<a href="#" title="Show Menu">
				<img src="master/logo/<?php print $array3["logo"];?>" width="25%" alt="" class="picture" />
				<!--<span class="title"><b><?php// print $array3["label"];?></b></span>
				<span class="text" >Presensi</span>-->
			</a>
				
		</div>
	
	
	<div class="main" id="maincontent"> <!-- *** mainpage layout *** -->

	<div class="main-wrap">
		<div class="header clear">
			<ul class="links clear">


			<?php
			//----------------------------------------------------------------------------------------------------------------------------------------
			if($_SESSION['admin'] ){
			echo "<li><a href='?page=pengaturan'><img src='UniAdmin_files/ico_view_24.png' alt='' class='icon' /> <span class='text'>Pengaturan</span></a></li>";
			}
			else{ 
			?>
			<li><a href='#'> <span class='text'><?php if($_SESSION['user']){ ?><a href="?page=Edit_Master_Siswa2&id=<?php print $array4["id"];?>"><?php print$array4["Nama_siswa"];?></a><?php } else if($_SESSION['guru']){print $array5["nama"];}?></font></span></a></li>
			<?}?>
			<li><a href="login/logout.php" onclick="return confirm('Are You Sure ?')"><img src="UniAdmin_files/ico_logout_24.png" alt="" class="icon" /> <span class="text">Logout</span></a></li>
			</ul>
		</div>
		<div class="page clear">						
			<!-- MODAL WINDOW -->
			<div id="modal" class="modal-window">
				<!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->
				
				
				
			</div>
			
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-body clear">
					<?php
						@$login = $_GET["login"];
						
						$master = array("Guru","Kelas","Siswa","Karyawan","Jurusan","Libur","Pengumuman");
						if($_GET["page"]){
						@$p		= $_GET["page"];
						$q 		= mysql_query("select *from kelas where id='$p'");
						$row	= mysql_fetch_array($q);
						$a		= $row["id"];
						$b 		= $row["Nama_Kelas"];
						
						
							if($p == $a){
								include("content/kelas.php");
							}
							else if($p == "input_error_guru")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_Guru.php";
							}
							else if($p == "Master_Kelas_err")
							{
								echo "<script>alert('Kelas Telah Terdaftar');</script>";
								include "master/Master_Kelas.php";
							}
							else if($p == "Master_Jurusan_err")
							{
								echo "<script>alert('Jurusan ini Telah Terdaftar');</script>";
								include "master/Master_Jurusan.php";
							}
							
							
							
							
							
							else if($p == "Master_Siswa_err")
							{
								echo "<script>alert('Isi field yang diperlukan');</script>";
								include "master/Master_Siswa.php";
							}	
							else if($p == "Master_Siswa_err_absennis")
							{
								echo "<script>alert('Gagal input! Absen Atau NIS Sudah Terdaftar');</script>";
								include "master/Master_Siswa.php";
							}
							
						
							else if($p == "input_error_siswa")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_Siswa.php";
							}
							
							else if($p == "input_error_jurusan")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_jurusan.php";
							}
							
							else if($p == "input_error_karyawan")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_Karyawan.php";	
							}
							
							else if($p == "input_error_karyawan_nup")
							{
								echo "<script>alert('Gagal Input! NUP Telah Terdaftar');</script>";
								include "master/Master_Karyawan.php";
							}
							
							else if($p == "input_error_libur")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_libur.php";
							}
							else if($p == "input_error_pengumuman")
							{
								echo "<script>alert('Semua Field Harus Di Isi');</script>";
								include "master/Master_Pengumuman.php";
							}
							
							else if($p == "pengaturan"){
								include("pengaturan.php");
							}
							
							else if($p == "absen_siswa"){
								include("laporan/laporan_siswa.php");
							}
							else if($p == "absen_karyawan"){
								include("absen_karyawan/absen.php");
							}
							else if($p == "absen_guru"){
								include("absen_guru/absen.php");
							}
							
							
							else if($p == "laporan_karyawan"){
								include("absen_karyawan/laporan.php");
							}
							else if($p == "laporan_telat_karyawan"){
								include("absen_karyawan/laporan_telat.php");
							}
							else if($p == "laporan_karyawan_hari_ini"){
								include("absen_karyawan/laporan_hari_ini.php");
							}

							
							else if($p == "laporan_guru"){
								include("absen_guru/laporan.php");
							}
							else if($p == "laporan_telat_guru"){
								include("absen_guru/laporan_telat.php");
							}
							else if($p == "laporan_guru_hari_ini"){
								include("absen_guru/laporan_hari_ini.php");
							}
							
							
							
							
							
							else if($p == "absen"){
								include("laporan/laporan.php");
								}
							//-----------------------------------------------------------------
						
							//-----------------------------------------------------------------
							
							
							else if($p == "absen_siswa_perbulan"){
								include("laporan/laporan_siswa_perbulan.php");
							}
							
							else if($p == "absen_siswa_pertanggal"){
								include("laporan/laporan_siswa_pertanggal.php");
							}
							else if($p == "absen_siswa_tahunajaran"){
								include("laporan/laporan_siswa_tahunajaran.php");
							}
							else if($p == "absen_siswa_semester"){
								include("laporan/laporan_siswa_semester.php");
							}
							
						
							//-----------------------------------------------------------------
							else if($p == "siswa_out"){
								include("laporan/laporan_out.php");
							}
							else if($p == "siswa_out_semester"){
								include("laporan/laporan_out_semester.php");
							}
							
								else if($p == "absen_ini"){
								include("laporan/laporan_hari_ini.php");
								}
							else if($p == "telat"){
								include("laporan/laporan_telat.php");
								}
							else if($p == "telat_siswa"){
								include("laporan/laporan_telat_siswa.php");
								}
							for	($ar = 0; $ar < 7; $ar++){
								if($p == "Master_".$master[$ar]){
									include("master/Master_".$master[$ar].".php");
								}
								else if($p == "Edit_Master_".$master[$ar]){
									include("master/proses/Edit_Master_".$master[$ar].".php");
								
								
								}
								else if($p == "Edit_Master_".$master[$ar]."2"){
									include("master/proses/Edit_Master_".$master[$ar]."2.php");
									}
							}
								
							
							}
							
							else {
								if(isset($_SESSION['admin']) || isset($_SESSION['guru'])){
								include("home.php");
								}
								else{
								include("home_siswa.php");
								}
							}
						
					?>
					
				</div><!-- /#forms -->
			
			</div> <!-- end of box-body -->
				
			</div></div> <!-- end of content-box -->			
</script>
<div class='bodyfooter' ><label>© SMKN 10 JAKARTA. Support By : RPL</label></div>
</body>
</html>
<?php
	}
	else{
		
	include "../conn/conn.php";
	$q = mysql_query("select *from title");
	$a = mysql_fetch_array($q)
?>
<link rel="shortcut icon" href="master/logo/<?php print $a["logo"];?>" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="AIT"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title><?php print $a["title"];?></title>

<link rel="stylesheet" href="login/login_files/reset.css" type="text/css"/>
<link rel="stylesheet" href="login/login_files/screen.css" type="text/css"/>
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="login_files/ie7.css" />
<![endif]-->	

<script type="text/javascript" src="login/login_files/jquery.js"></script>
<script type="text/javascript" src="login/login_files/cufon.js"></script>
<script type="text/javascript" src="login/login_files/Geometr231_Hv_BT_400.font.js"></script>
<script type="text/javascript" src="login/login_files/script.js"></script>
<script>
	function change(){
			user  = document.getElementById("user").innerHTML;
			pilih = document.getElementById("choose");
		//document.getElementById("user").innerHTML = pilih.options[pilih.selectedIndex].text;
		document.getElementById("abc").value = pilih.options[pilih.selectedIndex].text;
			if(pilih.options[pilih.selectedIndex].text == "Admin"){
			document.getElementById("user").innerHTML = "Username:";
			document.getElementById("user1").placeholder = "username";
			//alert("aaaa");
		}
		else if(pilih.options[pilih.selectedIndex].text == "Guru")
		{
			document.getElementById("user").innerHTML = "NIP:";
			document.getElementById("user1").placeholder = "NIP";
		}
		else{
			//user = "NISN:";
			document.getElementById("user").innerHTML = "NIS:";
			document.getElementById("user1").placeholder = "NIS";
			
		}
	}
	function a(){
		document.getElementById("user1").value = "";
		
	}
</script>
</head>
	
<body class="no-side">

<div class="login-box">
<div class="login-border">
<div class="login-style">
	<div class="login-header">
		<div class="logo clear">
		
			<img src="master/logo/<?php print $a["logo"];?>" width="15%" alt="" class="picture" />
			<span class="title"><?php print $a["label"];?></span>
			<span class="text">absen</span>
		</div>
	</div>
	<form action="login/proses_login.php" method="post" >
		
		<div class="login-inside">
			
			<div class="login-data">
				
						<div class='row clear'>
						Login Sebagai :
						<select name="choose" id='choose' onchange='change()'>
						<option value="admin">Admin</option>
						<option value="guru" id="guru">Guru</option>
						<option value="siswa" id="siswa">Siswa</option>
					</select>

    				</div>
 				<div class='row clear'>
				<label for='user' id='user' class='d'>Username:</label><input type="hidden" id="abc" value="a"></input>
    			<input type='text' placeholder='username' onclick="a();"size='25' class='text' id='user1' name='username' />
					
				</div>
				<div class='row clear'>
					<label for='password'>Password:</label>
					<input type='password' placeholder='password'  size='25' class='text' id='password' name='password' />
				</div>
				<div class='row clear'>								
					<input type="Submit" class="submit2" value="Login" />
				</div>
		</div>
			</form>
		<div class="login-footer clear">
		</div>
	<?php
		@$login  = $_GET["login"];
		@$logout = $_GET["logout"];
		
		if($daftar == "failed"){
			echo "<script>alert('Registration Failed')</script>";
		}
		else if($daftar == "success"){
			echo "<script>alert('Registration Success')</script>";
		}
		else if($login == "failed"){
			echo "<script>alert('Username atau Password Salah')</script>";
		}
		else if($login == "kosong")
		{
			echo "<script>alert('Username atau Password Tidak Boleh Kosong')</script>";
		}
	?>
	
</div>
</div>
</div>
</div>
<?php } ?>
