
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm điểm tham quan vào tour </title>

<head>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/themify-icons-demo.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
</head>
<!-- <script type="text/javascript" src="../../ckeditor/sample.js"></script> -->

<body>
	<?php 
				include("conn.php");
					 $id=$_GET['ma'];
					 
   ?>
</br>
	
   <table style="width: 100%; padding-left: 0px; padding-left: 0px">
	<tr>
		<td> 
				<div class="container" style="padding-left: 0px">
				
				<table   border=1 style="width: 100%">
					<tr>
							<th colspan="4"style="text-align: center; background-color:#09A9A3">Danh sách các điểm tham quan chưa được chọn</th>
					</tr>
					<tr>
				           <th>STT</th>
				           <th>Mã điểm tham quan</th>
				            <th>Tên điểm tham quan</th>
				            <th>Thêm </th>
				     </tr>
				    <?php
					$stt=0;
					$quser=mysqli_query($conn,"Select a.madiemthamquan, a.tendiemthamquan from diemthamquan a where a.madiemthamquan not in (select madiemthamquan from tourdulich_diemthamquan where matour='$id')");
					while($row=mysqli_fetch_array($quser))
					{
						$stt++;
					?>
					<tr>
						<td><?php echo $stt; ?></td>
						<td><?php echo  $row['madiemthamquan']; ?></td>
						<td><?php echo $row['tendiemthamquan']; ?></td>
						<?php
							echo "<td class='nd' style='text-align: center;border-width: 1px;'><a class='ti-plus' href='Controller/xuly_add_diemthamquan_tourdulich.php?matour=$id&madiemthamquan=$row[madiemthamquan]'></a> </td>";           						 
							
							?>
					</tr>
					<?php
				}
					?>
				</table>
				</div>
		</td>

		<td style="vertical-align: top;">
			<table border=1 style="width: 100%">
				<tr>
						<th colspan="4"style="text-align: center; background-color:#09A9A3">Danh sách các điểm tham quan đã được chọn</th>
				</tr>
				<tr>
					 <th>STT</th>
			          <th>Mã điểm tham quan</th>
			          <th>Tên điểm tham quan</th>
			          <th>Xóa</th>
				</tr>
				 <?php
				$stt=0;
				$quser=mysqli_query($conn,"select c.madiemthamquan,c.tendiemthamquan from tourdulich_diemthamquan as a, tourdulich as b, diemthamquan as c where a.madiemthamquan = c.madiemthamquan and a.matour=b.matour and a.matour='$id'");
				while($row1=mysqli_fetch_array($quser))
				{
					$stt++;
			    ?>
			    <td><?php echo $stt; ?></td>
				<td><?php echo  $row1['madiemthamquan']; ?></td>
				<td><?php echo $row1['tendiemthamquan']; ?></td>
				<?php
				echo "<td class='nd' style='text-align: center;border-width: 1px;'><a class='ti-trash' href='Controller/del_diemthamquan_tourdulich.php?id=$id&madiemthamquan=$row1[madiemthamquan]'></a></td>";
				?>
				<tr>
				<?php
			}
				?>
				</tr>
			</table>
		</td>
	</tr>

</table>

<div style="margin:30px"></div>
 <footer id="footer">
  	</div>
 </footer>
</body>
</html>



