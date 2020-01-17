<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete dac san</title>
</head>
<body>
 <?php
 	 // ob_start();
 		include("conn.php");
		$id=$_GET['id'];

		$madacsan=$_GET['madacsan'];
		// echo $id."/".$madacsan;
		$sql = "delete from diemthamquan_dacsan where madiemthamquan='$id' and madacsan='$madacsan'";
		$result = mysqli_query($conn,$sql);
		header("Location: ../index.php?xem=add_dacsan_dtq&ma=$id");
		// echo "<script language='javascript' >alert('Xóa thành công')</script>";
		// header("Location: ../View/add_dacsan_dtq.php?ma=$id");
 ?>
</body>
</html>