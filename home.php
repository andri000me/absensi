
<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal_pengumuman		= 	date("d-m-Y");

	include("conn/conn.php");
	include "conn/minggu.php";	
	
	
		if($_GET["home"]){
			@$p2		= $_GET["home"];
		}else{
			@$p2		= "siswa";
		}
		
		
				$bulan_semester = date("m");
				if($bulan_semester == "6" || $bulan_semester == "7" || $bulan_semester == "8" || $bulan_semester == "9" || $bulan_semester == "10" || $bulan_semester == "11" || $bulan_semester == "12"){
					$semester_sekarang = "1";
				}
				else{
					$semester_sekarang = "2";
				}
				
				$bulan = date("m");
				$today		= 	date("d-m-Y");
				
				$today233	= 	date("m-Y");
				$today2	= 	date("d F Y");
				$h_i_s = date("H:i:s");
				$jam   = date("H");
				$q_siswa_all 	= mysql_query("select *from siswa");
				
				$siswa		= mysql_query("select * from siswa where id_kelas='$idkelas'");
				$array_siswa	= mysql_fetch_array($siswa);
								
				
				
				$telatg 		= mysql_query("select * from absensi_guru where terlambat='y' and tanggal='$today'");
				$telat_guru	    = mysql_num_rows($telatg) ;
				
				$telatk 		= mysql_query("select * from absensi_karyawan where terlambat='y' and tanggal='$today'");
				$telat_karyawan	    = mysql_num_rows($telatk) ;
				$month = date ("F Y");
				
//-----------------TOP TELAT----------------------				
	$q_toptelat_siswa 	= mysql_query("select *from top_telat where id=1");
	$q_toptelat_guru 	= mysql_query("select *from top_telat where id=2");
	$q_toptelat_karyawan= mysql_query("select *from top_telat where id=3");
	$top_siswa			= mysql_fetch_array($q_toptelat_siswa);
	$top_guru			= mysql_fetch_array($q_toptelat_guru);
	$top_karyawan		= mysql_fetch_array($q_toptelat_karyawan);
	$siswavalue			= $top_siswa["value"];
	$guruvalue			= $top_guru["value"];
	$karyawanvalue		= $top_karyawan["value"];
//-------------------------------------------------

		
			
			if($p2 == "guru"){
				$titleTop   = "TOP $guruvalue GURU";
				$titleTelat = "Guru Telat Hari Ini";
				$value		= $guruvalue;
				$queryTop   = "SELECT count(*) as t,nama,nip,foto,sum(detik_telat) as total_detik from absensi_guru,guru where absensi_guru.guru_nip=guru.nip  and bulan='$today233' and absensi_guru.terlambat='y' group by `guru_nip` order by t desc limit 0,$guruvalue";
				$telatQuery = "select nama,foto,waktu from absensi_guru,guru where guru.nip=absensi_guru.guru_nip and absensi_guru.terlambat='y' and absensi_guru.tanggal='$today'";
				$folderFoto 		= "foto";
				
				
				
			}
			else if($p2 == "karyawan"){
				$titleTop   = "TOP $karyawanvalue KARYAWAN";
				$titleTelat = "Karyawan Telat Hari Ini";
				$value		= $karyawanvalue;
				$queryTop   = "SELECT count(*) as t,nama,nup,foto, sum(detik_telat) as total_detik from absensi_karyawan,karyawan where absensi_karyawan.karyawan_nup=karyawan.nup  and bulan='$today233' and absensi_karyawan.terlambat='y' group by `karyawan_nup` order by t desc limit 0,$karyawanvalue";
				$telatQuery = "select nama,foto,waktu from absensi_karyawan,karyawan where karyawan.nup=absensi_karyawan.nup and karyabsensi_karyawan.terlambat='y' and absensi_karyawan.tanggal='$today'";
				$folderFoto 		= "foto-karyawan";
				
				
			}
			else if($p2 != "karyawan" || $p2 != "guru"){
				$titleTop   = "TOP $siswavalue SISWA";
				$titleTelat = "Siswa Telat Hari Ini";
				$value		= $siswavalue;
				$queryTop   = "SELECT count(*) as t,foto,Nama_siswa,nama_panggilan,Nama_Kelas,nis, sum(detik_telat) as total_detik from absensi_siswa,siswa,kelas where absensi_siswa.no_siswa=siswa.nis and absensi_siswa.kd_kelas=kelas.id and bulan='$today233' and absensi_siswa.terlambat='y' group by `no_siswa` order by t desc limit 0,$siswavalue";
				$telatQuery = "select Nama_siswa,foto,Nama_Kelas,waktu from absensi_siswa,siswa,kelas where terlambat='y' and tanggal='$today' and absensi_siswa.kd_kelas=kelas.id and absensi_siswa.no_siswa=siswa.nis";
				$folderFoto = "foto-siswa";
				
				
			}
			$telat 		= mysql_query($telatQuery);
			$telat2	    = mysql_num_rows($telat) ;
			
			
			?>
<script>

var i = 1;
var zz= 1;
var jumlah;
var a;
var tanggal;
var value;
var homeValue;
var folderFoto;
var brt = new Array("","","","","","");
var rotasi = 1; 
var awal;
//----------------------------------------------------------------------------------------------------------------------------
$(document).ready(function(){
    //$('#data').fadeOut(0).load('konfig_konfig.php').fadeIn(0);
	$('.menuPanel').hide();
	$('#logoDalem').show();
	document.getElementById('maincontent').style.width='93%'
	document.getElementById('maincontent').style.right='10px'
	
	awal   = $("#jumlahberita").html();
	awal   = parseInt(awal);
	tanggal= $('#tanggal_sekarang').html();
	value  = $('#value').html();
	jumlah = $("#jumlahberita").html();
    jumlah = parseInt(jumlah);
    nomorakhir = $("#nomorakhir").html();
	value = $('#value').html();
	folderFoto = $('#folderFoto').html();
	homeValue = $('#homeValue').html();
    for(x=1;x<=jumlah;x++){
        brt[x] = $("#drz"+x).html(); //mengambil berita ,menjadi array brt[]
    }
	var input = setTimeout("input()",1000);
	var cek = setTimeout("cek()",3000);
    var putaran = setTimeout("putar()",3000);
	var relod = setTimeout("relod()",120000);
    a = jumlah;
	c = a+1;
	
});
function relod() {
	location.reload(true);
}
function cek(){
    $.ajax({
        url: "topData.php",
        data: "tanggal="+tanggal+"&value="+value+"&homeValue="+homeValue+"&folderFoto="+folderFoto,
        cache: false,
        success: function(msg){
            data = msg.split("||");
			brt = [];
			jumlah	 = parseInt(data[0]);
			xx  	 = jumlah+1;
			totalTop = data[xx];
			if(jumlah<4){
				a=6;
				c=5;
			}
			
			for(troll=1;troll<=jumlah;troll++){
				content = data[troll];
				brt[troll] = data[troll];
				
			}
			$('#totalTopTelat').html(totalTop);
			$zz++;
         }
    });

    var waktucek = setTimeout("cek()",1000);
}
function input(){

				if(jumlah<=4){
				if(brt[1]!=""){
					$("#drz1").html(brt[1]);
				}
				if(brt[2]!=""){
					$("#drz2").html(brt[2]);
				}
				if(brt[3]!=""){
					$("#drz3").html(brt[3]);
				}
				if(brt[4]!=""){
					$("#drz4").html(brt[4]);
				}
				}
				 var waktuinput = setTimeout("input()",1000);
}
function putar(){
	//$("#coba2").after(c);
    if(jumlah>4){                   
        b = c-1;
		
        if(a>jumlah){
			$("#drz"+b).after("<div id=drz"+c+" class='x' style='display:block;'><span id=s"+i+">"+brt[rotasi]+"<br></span></div>");
       
	    }else{
			$("#drz"+a).after("<div id=drz"+c+" class='x' style='display:block;'><span id=s"+i+">"+brt[rotasi]+"<br></span></div>");
       
	    }
	    $("#drz"+i).slideUp(900); 
		rotasi++;
		a++;
		i++;
		c++;
		
         
        if(rotasi>jumlah){
            rotasi = 1;
        }		
    }
	var putaran = setTimeout("putar()",3000);
}

var auto_refresh = setInterval(function(){
	$('#data').fadeOut(0).load('konfig_konfig.php').fadeIn(0);
}, 100 );
//-----------------------------------------------------------------------------------------------------------------------------------------------
</script>	
<data id='data'><center><label><b><i>Menghubungkan Ke Mesin Absen.....<i><b><label></center></data>
<body>
	<div class="content-box">
		<table width='100%'>
<tr class="aa" >

			<td>
					<div class="box-header clear">
						<h2><center><b>DASHBOARD</b></center></h2>
					</div>
					
					<div class="box-body clear">
						<div id="table">
							<table border=1>
								<thead colspan=8>
								
									<th><center>Persentasi Perbandingan Telat - Tidak Telat Minggu Ini</th>
								
								
									<th><center><?php print $titleTop;?></th>
								
								<tbody>
								<tr width="30%">
									<td>
 									<center><?php include "homeChart.php";?></center>

									</td>
									
								
									<td width='50%'>
									<table id='tableTOP'>
										<tr class='trTOP'>
											<td>
												<div id=papan>									
								<?php

$i = 1;
$ab = 1;
$naix;
//mengambil 5 berita terbaru dari database
$totalTOP   = Array();
$query = mysql_query($queryTop);
$naix = mysql_num_rows($query);
if($p2 == "guru"){
	while($b = mysql_fetch_array($query)){
		if($b['foto']==""){
			$foto="ico_users_64.png";
		}
		else{
			$foto=$b['foto'];
		}
		echo "<div  class=p id=drz$i>
		<div id='isi_toptelat'><img src='master/".$folderFoto."/".$foto."' class='img_toptelat' align=left><label id='txt_toptelat' class='txt_toptelat'>";
		print"<b> NAMA &nbsp;: ".$b['nama']."";
		print"<br>TOTAL : ".$b['t']."</b></label> </div><div id='peringkat_toptelat'>#$i</div>";
		echo "<br></div>\n";
		$totalTOP[$i] = $b['t'];
		$i++;
		$ab++;
	}

}else if( $p2=="karyawan"){
	while($b = mysql_fetch_array($query)){
		if($b['foto']==""){
			$foto="ico_users_64.png";
		}
		else{
			$foto=$b['foto'];
		}
		echo "<div  class=p id=drz$i>
		<div id='isi_toptelat'><img src='master/".$folderFoto."/".$foto."' class='img_toptelat' align=left><label id='txt_toptelat' class='txt_toptelat'>";
		print"<b> NAMA &nbsp;: ".$b['nama']."";
		print"<br>TOTAL : ".$b['t']."</b></label> </div><div id='peringkat_toptelat'>#$i</div>";
		echo "<br></div>\n";
		$totalTOP[$i] = $b['t'];
		$i++;
		$ab++;
	}

}
else{
	while($b = mysql_fetch_array($query)){
			$total_detik = $b["total_detik"];
			$hours = floor($total_detik / 3600);
			$minutes = floor(($total_detik / 60) % 60);
			$seconds = $total_detik % 60;

			if($b['foto']==""){
				$foto="ico_users_64.png";
			}
			else{
				$foto=$b['foto'];
			}
			echo "<div  class=p id=drz$i>
			<div id='isi_toptelat'><img src='master/foto-siswa/".$foto."' class='img_toptelat' align=left><label  id='txt_toptelat' class='txt_toptelat'>";
			print"<b> NAMA&nbsp;&nbsp;: ".$b['Nama_siswa']."";
			print"<br><font class='txt_toptelat'>KELAS : ".$b['Nama_Kelas']."</font>";
			print"<br><font class='txt_toptelat'>TOTAL : ".$b['t']." ($hours jam, $minutes menit)</b></label> </font></div><div id='peringkat_toptelat'>#$i</div>";
			echo "<br></div>\n";
			$totalTOP[$i] = $b['t'];
			$i++;
			$ab++;
			$abv = $b['Nama_siswa'];
		
	}

}
		if($naix == 0){
			echo "<div  class=p id=drz1></div>";
			echo "<div  class=p id=drz2></div>";
			echo "<div  class=p id=drz3></div>";
			echo "<div  class=p id=drz4></div>";
		}else if($naix == 1){
			
			echo "<div  class=p id=drz2></div>";
			echo "<div  class=p id=drz3></div>";
			echo "<div  class=p id=drz4></div>";
		}else if($naix == 2){
			echo "<div  class=p id=drz3></div>";
			echo "<div  class=p id=drz4></div>";
		}else if($naix == 3){
			echo "<div  class=p id=drz4></div>";
		}


$akhirnya = $value;
?>

													</div>
												</td>
											</tr>
										<tr class='trTOP2'>
											<td><label class='txt_toptelat'><b> TOTAL : <span id='totalTopTelat'> <?php print array_sum($totalTOP);?></span></b></label></td>
										</tr>
									</table>
<?php
$j = $i- 1;

print "<span id='tanggal_sekarang' style='display:none'>$today233</span>";
print "<span id='folderFoto' style='display:none'>$folderFoto</span>";
print "<span id='homeValue' style='display:none'>$p2</span>";
print "<span id='value' style='display:none'>$value</span>";
echo "<span id='jumlahberita' style='display:none'>$j</span>";
echo "<span id='nomorakhir' style='display:none'>$akhirnya</span>";
?>
								</td>
								</tr>
														<?php
	if($telat2>0){
	print "
			
		<tr>
			<th colspan=2><center><font color='red'>$titleTelat</font></th>
			</tr>
			
	
			<td colspan=2>
			<marquee>
				<ul style='float:left; padding:0; margin-left:20px;'>
						
			";
	while($a_telat = mysql_fetch_array($telat)){
	if($a_telat['foto']==""){
			$foto="ico_users_64.png";
	}
	else{
		$foto=$a_telat['foto'];
	}
?>
<?php if($p2=="siswa"){?>

	<li style='float:left; padding:0; margin-right:20px;'>
	<img src='master/<?php print $folderFoto."/".$foto;?>'  style='width:58px; height:70px;' align='left'></img>
	<b>NAMA &nbsp;: <?php print $a_telat["Nama_siswa"]; ?></b><br/>
	<b>KELAS : <?php print $a_telat["Nama_Kelas"]; ?></b><br/>
	<b>WAKTU : <?php print $a_telat["waktu"]; ?></b> 
	</li>

<?php }else{ ?>


	<li style='float:left; padding:0; margin-right:20px;'>
	<img src='master/<?php print $folderFoto."/".$foto;?>'  style='width:58px; height:70px;' align='left'></img>
	<b>NAMA &nbsp;: <?php print $a_telat["nama"]; ?></b><br/>
	<b>WAKTU : <?php print $a_telat["waktu"]; ?></b> 
	</li>
 
<?php }
}
	print "		</ul>		
			</marquee>
			</td>
			</tr>";
	} ?></tbody>
							</table>
						</div>

				</td>

				</tr>

				</table>	
	</div>
	<div id='coba2'></div>
</body>
		
	

	<?php
		//--------------PENGUMUMAN-----------------
	$q_pengumuman		= mysql_query("select *from pengumuman where tanggal_mulai='$today' order by id");
	$num_pengumuman 	= mysql_num_rows($q_pengumuman);
	//print $num_pengumuman;
	if($num_pengumuman==0){
	print "";
	}
	else{
	?>
	<div class="pengumuman" width='100%'>
			<div class="isiPengumuman"><b><div class="marqueePengumuman"><marquee behavior="scroll" direction="left"  class='marquePengumuman'><?php while($a_pengumuman = mysql_fetch_array($q_pengumuman)){ print $a_pengumuman["isi"]." ...&nbsp;&nbsp;&nbsp;&nbsp; "; }?></marquee></b></div></div>
		</div>
	<?php
	}
	
	//=========================================

	?>
	
