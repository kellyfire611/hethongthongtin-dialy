<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete tour du lịch</title>
</head>

<body>
 <?php
 		include("../Models/conn.php");
 		$id = $_GET['id'];
		$sql = "delete from tourdulich where matour='$id'";
		$result = mysqli_query($conn,$sql);
		if ($result){
			$sqldtq = "delete from tourdulich_diemthamquan where matour='$id'";
			$deletedtq = mysqli_query($conn,$sqldtq);
			if ($deletedtq) {
				echo"<script language='javascript' >alert('Xóa thành công')</script>";
				header("Location: ../View/admin_tourdulich.php");
			}else{
				echo"<script language='javascript' >alert('Xóa không thành công trong table tourdulich_diemthamquan')</script>";
			}
			
		} else {
			echo"<script language='javascript' >alert('Xóa không thành công trong table tourdulich')</script>";
		}
		
 ?>
</body>
</html>