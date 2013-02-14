<?php
include("../conn/conn.php");
//--------------------------------------------------------------------
$page = $_GET['page_kelas'];
if( !isset($_GET['page_kelas']) )
{
   $page = 1;
}
else
{
   $page = $_GET['page_kelas'];
}
$rec_limit= 10;
$offset = ($rec_limit * $page) - $rec_limit;
//--------------------------------------------------------------------
$txt_search = $_GET["txt_search"];
$jenis_search = $_GET["jenis_search"];
if(!empty($txt_search)){
	$q = mysql_query("select *from kelas where $jenis_search like '%$txt_search%' order by Nama_Kelas limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from kelas where $jenis_search like '%$txt_search%'");
}else{
	$q = mysql_query("select *from kelas order by Nama_Kelas limit $offset, $rec_limit");
	$qc = mysql_query("select count(*) as tot3 from kelas");
}
	$q2 = mysql_query("select *from guru");
	$q_jurusan = mysql_query("select *from jurusan order by nama");
	$q_jurusan2 = mysql_query("select *from jurusan order by nama");
//$row=mysql_fetch_array($q);
//$row1 = $row;
if($_SESSION["admin"]){
?>

<body>
			<!-- CONTENT BOXES -->
			<div class="content-box">
				<div class="box-header clear">
					<ul class="tabs clear">
						<li><a href="#table">Table Kelas</a></li>
						<li><a href="#forms">Input Data Kelas</a></li>
						
					</ul>
					
					<h2>Master Kelas</h2>
				</div>
				
				<div class="box-body clear">
					<!-- TABLE -->
					<div id="table">					
					<!------------------------------------------------------------------------->
							<form method="GET" action="index.php">	
							<input type="hidden" name="page" value="Master_Kelas">
							<input type="text" class="text fl" name="txt_search"  maxlength='5'/>&nbsp;
								<select name="jenis_search">
									<option value="Nama_Kelas">Nama</option>
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
									<th>Nama Kelas</th>
									<th>Wali Kelas</th>
									<th>Tindakan</th>
								</tr>
							</thead>
							
							<tbody>
							<?php
							$apake = 1 ;
							
							// if( isset($_GET{'page_kelas'} ) ){
								// $apake =  $rec_limit * $_GET{'page_kelas'};
							// }
								while($row=mysql_fetch_array($q)){
									$namakelas = $row["Nama_Kelas"];
							?>
								<tr>
									<td><input name="checkbox[]" type="checkbox" id="cek" onclick="javacript:dell(this,<?php print $apake; ?>);" value="<?php echo $row["id"]; ?>"></td>
							
									<td><?php print $row['Nama_Kelas'];?></td>
									<td><?php
										$id_guru=$row["id_guru"];
										$guru_query=mysql_query("select*from guru where No='$id_guru'");
										$array_guru=mysql_fetch_array($guru_query);
										echo $array_guru["nama"];
										?>
									</td>
										
									<td>
										<a href="?page=Edit_Master_Kelas&id=<?php print $row['id']?>&id_guru=<?php print $row['id_guru'];?>"><img src="UniAdmin_files/ico_edit_16.png" class="icon16 fl-space2" alt="" title="edit" /></a>
										<a href="master/proses/Master_Kelas.php?id=<?php print $row['id']?>&delete=delete" onclick="return confirm('Apakah anda ingin menghapus kelas <?php print $namakelas; ?>?')"><img src="UniAdmin_files/ico_delete_16.png" class="icon16 fl-space2" alt="" title="delete" /></a>
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
										<a href='index.php?page=Master_Kelas&page_kelas=<?php echo $i; ?>&txt_search=<?php echo $txt_search; ?>&jenis_search=<?php echo $jenis_search; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}else{
										for($i=1;$i<=$jumhal;$i++){
										?>
										<a href='index.php?page=Master_Kelas&page_kelas=<?php echo $i; ?>'><span class="paginate_button"><?=$i?></span></a>
										<?
										}
									}
								?>
							</span>
							
						</div>
						</div>
						<div class="tab-footer clear">
							<div class="fl">
								<input type="hidden" name="delete_all" value="kelas">
								<input disabled type="submit" onclick="return confirm('Are You Sure ?')" value="Delete All Checked" id="submit2" class="submit fl-space" name="delete"/></div>		
							</div>							
						
						</form>
						
					</div><!-- /#table -->
					
					<!-- Custom Forms -->
					<div id="forms">
						<form action="master/proses/Master_Kelas.php" method="post" class="form"  enctype="multipart/form-data">
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Jurusan <span class="required">*</span></label>
								<select  name="jurusan">
								
									<?php
										while($row_jurusan=mysql_fetch_array($q_jurusan)){
										$nama=$row_jurusan["nama"];
										$id22=$row_jurusan["id"];
										print "<option value='$id22'>$nama</option>";
										
										}?>
								</select>	

								
								
							</div><!-- /.form-field -->
								<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Kelas <span class="required">*</span></label>
								<select name="kelas">
									<script>
										
										for(kelas = 1; kelas < 4; kelas++){
											document.write("<option value="+kelas+">"+kelas+"</option>");
										}
										
									</script>
								</select>
							</div><!-- /.form-field -->
							
							<div class="form-field clear">
								<label for="textfield" class="form-label fl-space2">Wali Kelas: <span class="required">*</span></label>
								<select name="guru">
									<?php
										while($row2=mysql_fetch_array($q2)){
											print"<option value=".$row2["No"].">".$row2["nama"]."</option>";
										}
									?>
								</select>
								
							</div><!-- /.form-field -->
							
					

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
