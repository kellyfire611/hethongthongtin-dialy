<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm đặc sản vào điểm tham quan</title> 
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
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<!-- Main Styles -->
</head>
<body>
		</br>
	<?php 
	include("conn.php");
	$id=$_GET['ma']; 
	 ?>

	
	
<table style="width: 100%; padding-left: 0px; padding-left: 0px">
	
	<tr>
		<td >
			<div class="container" style="padding-left: 0px">
	
	<table style="with:100%" align="left" border=1>
		<tr>
			<th colspan="4"style="text-align: center; background-color:#09A9A3">Danh sách đặc sản chưa được chọn</th>
		</tr>
		<tr>
			<th>STT</th>
			<th>Mã đặc sản</th>
			<th>Tên đặc sản</th>
			<th>Thêm </th>
 		</tr>
    <?php
		$stt=0;
		$quser=mysqli_query($conn,"Select madacsan, tendacsan from dacsan where madacsan not in (select madacsan from diemthamquan_dacsan where madiemthamquan = '$id')");
		while($row=mysqli_fetch_array($quser)){
			$stt++;
	?>
		<tr>
			<td style="text-align: center; width: 15%"><?php echo $stt; ?></td>
			<td style="text-align: center; width: 25%"><?php echo  $row['madacsan']; ?></td>
			<td style="text-align: center; width: 60%"><?php echo $row['tendacsan']; ?></td>
			<?php
			echo "<td  style='border-width: 1px;text-align: center;'><a class='ti-plus' href='Controller/xly_add_dacsan_dtq.php?madiemthamquan=$id&madacsan=$row[madacsan]'></a></td>";           						 
			
			?>
		</tr>
	<?php } ?>
	</table>
	
</div>
		</td>
		<td style="vertical-align: top;">
			<table style="with:100%" align="right" border=1>
		<tr>
			<th colspan="4"style="text-align: center; background-color:#09A9A3"> Danh sách đặc sản đã chọn</th>
		</tr>
		<tr>
			<th>STT</th>
			<th>Mã đặc sản</th>
			<th>Tên đặc sản</th>
			<th>Xóa</th>
		</tr>
 		<?php
		$stt=0;
		$quser=mysqli_query($conn,"select a.madacsan,a.tendacsan from dacsan  as a, diemthamquan as b, diemthamquan_dacsan as c where a.madacsan = c.madacsan and c.madiemthamquan=b.madiemthamquan and b.madiemthamquan ='$id'");
		while($row1=mysqli_fetch_array($quser)){
			$stt++;
		?>
		    <td style="text-align: center;width: 15%"><?php echo $stt; ?></td>
			<td style="text-align: center;width: 25%"><?php echo  $row1['madacsan']; ?></td>
			<td style="text-align: center;width: 60%"><?php echo $row1['tendacsan']; ?></td>
		<?php
			echo "<td  style='border-width: 1px;text-align: center;'><a class='ti-trash'  href='Controller/del_dacsan_dtq.php?id=$id&madacsan=$row1[madacsan]'></a></td>";
		?>
		<tr>
		<?php }	?>
		</tr>
	</table>
		</td>
	</tr>

</table>

<div class=”clr”></div>
 <footer id="footer">
 </footer>
</body>
<!-- <script type="text/javascript" src="../js/jquery-min.js"></script>      
<script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
</html>