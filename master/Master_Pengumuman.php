<?php
include("../conn/conn.php");
//--------------------------------------------------------------------
$page = $_GET['page_pengumuman'];
if( !isset($_GET['page_pengumuman']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_pengumuman'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;
//--------------------------------------------------------------------

$txt_search = $_GET["txt_search"];
if( $txt_search==""){
$txt_search="";
}
else{
$txt_search=$txt_search;
}
$jenis_search = $_GET["jenis_search"];
if(!empty($txt_search)){
	$q = mysql_query("select *from pengumuman where $jenis_search like '%$txt_search%' order by id limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from pengumuman where $jenis_search like '%$txt_search%'");
}else{
	$q = mysql_query("select *from pengumuman order by id limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from pengumuman");
}
//$row=mysql_fetch_array($q);
//$row1 = $row;
if($_SESSION["admin"]){
?>

<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#table">Table Pengumuman</a></li>
						<li><a href="#forms">Input Data Pengumuman</a></li>
						
					</ul>
					
					<h2>Master Pengumuman</h2>
				</div>
				
				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">
					<!------------------------------------------------------------------------->
						<form method="GET" action="index.php">	
							<input type="hidden" name="page" value="Master_Pengumuman">
							<input type="text" class="text fl" name="txt_search" value='<?php print $txt_search;?>' maxlength='5'/>&nbsp;
								<select name="jenis_search">
									<option value="id">ID</option>
									<option value="isi">Isi Pengumuman</option>
								</select>&nbsp;
								<input type="submit" class="submit" value="Search"/>
						</form>	<p>
					<!------------------------------------------------------------------------->					
						<form method="post" action="master/proses/delete_all.php">
						<div class="dataTables_wrapper">
						<table>
							<thead>
								<tr>
									<th><input type="checkbox" class="checkbox select-all" onclick="javacript:dell(this,5000);" id="cek"/></th>
									<th>id</th>
									<th>Isi Pengumuman</th>
									<th>Tanggal DiUmumkan</th>
							
									<th>tindakan</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
							$apake = 1 ;
							
							// if( isset($_GET{'page_kelas'} ) ){
								// $apake =  $rec_limit * $_GET{'page_kelas'};
							// }
								while($row=mysql_fetch_array($q)){
									$keterangan    = $row["isi"];
									$tanggal_mulai = $row["tanggal_mulai"];
									$tanggal_akhir = $row["tanggal_akhir"];
							?>
								<tr>
									<td><input name="checkbox[]" type="checkbox" id="cek" onclick="javacript:dell(this,<?php print $apake; ?>);" value="<?php echo $row["id"]; ?>"></td>
									<td><?php print $row["id"];?></td>
									<td><?php print $keterangan;?></td>
									<td><?php print $tanggal_mulai;?></td>
									
									<td>
										<a href="?page=Edit_Master_Pengumuman&id=<?php print $row['id']?>"><img src="UniAdmin_files/ico_edit_16.png" class="icon16 fl-space2" alt="" title="edit" /></a>
										<a href="master/proses/Master_Pengumuman.php?id=<?php print $row['id']?>&delete=delete" onclick="return confirm('Apakah anda ingin menghapus pengumuman tersebut?')"><img src="UniAdmin_files/ico_delete_16.png" class="icon16 fl-space2" alt="" title="delete" /></a>
									</td>
								</tr>
								
							<?php
							
								}
								
							?>
					
							<input type='hidden' id='textbox1' value=''/>
							</tbody>
						</table>
						<div class="dataTables_paginate paging_full_numbers">
							<span>
								<?
									$tot = mysql_fetch_array($qc);
									$jumhal = ceil($tot["tot3"] / $rec_limit);
									if(!empty($txt_search)){
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Pengumuman&page_pengumuman=<?php echo $i; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}else{
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Pengumuman&page_pengumuman=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}
								?>
							</span>
							
						</div>
						</div>
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="delete_all" value="pengumuman">
								<input disabled type="submit" onclick="return confirm('Are You Sure ?')" value="Delete All Checked" id="submit2" class="submit fl-space" name="delete"/></div>		
							</div>							
						
						</form>
						
					</div><!-- /#table -->
					
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Pengumuman.php" method="post" class="form"  enctype="multipart/form-data">
							<div class="form-field clear">
								<label for="keterangan" class="form-label fl-space2">Isi Pengumuman: <span class="required">*</span></label>
								<textarea type="text" rows=3 cols=20 id="keterangan" class="text fl" name="keterangan"  /></textarea>
							</div>
							
							<div class="form-field clear">
								<label for="tanggal2" class="form-label fl-space2">Tanggal DiUmumkan: <span class="required">*</span></label>
								<input type="text" id="tanggal2" class="text fl" name="tanggal_mulai" />
							</div>
							<div class="form-field clear">
								<input type="submit" class="submit fr" value="Submit" />
							</div><!-- /.form-field -->
						</form>
					</div><!-- /#forms -->
				</div> <!-- end of box-body -->
			</div> <!-- end of content-box -->			
</body>
<?php
}
else {
								include("home.php");
							}
?>
