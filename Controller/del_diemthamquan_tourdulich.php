<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete dac san</title>
</head>
<body>
 <?php
 		include("conn.php");
		$id=$_GET['id'];
		$madiemthamquan=$_GET['madiemthamquan'];
		$sql = "delete from tourdulich_diemthamquan where matour='$id' and madiemthamquan='$madiemthamquan'";
		$result = mysqli_query($conn,$sql);
		header("Location: ../index.php?xem=add_diemthamquan_tourdulich&ma=$id");
		// echo "<script language='javascript' >alert('Xóa thành công')</script>";
		// header("Location: ../View/add_diemthamquan_tourdulich.php?ma=$id");		
 ?>
</body>
</html>