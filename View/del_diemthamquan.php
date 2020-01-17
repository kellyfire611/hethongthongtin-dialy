<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete diem tham quan</title>
</head>
<body>
 <?php ob_start();
	include("../Models/conn.php");
	$id = $_GET['id'];
	$sql = "delete from diemthamquan where madiemthamquan='$id'";
	$result = mysqli_query($conn,$sql);
	if ($result){
		$sqldtq = "delete from diemthamquan_dacsan where madiemthamquan='$id'";
		$deletedtq = mysqli_query($conn,$sqldtq);
		if ($deletedtq) {
				echo"<script language='javascript' >alert('Xóa thành công')</script>";
	 			echo header("Refresh:0;../index.php?xem=diemthamquan");
			}else{
				echo"<script language='javascript' >alert('Xóa không thành công trong table tourdulich_diemthamquan')</script>";
			}
		
	} else {
		echo"<script language='javascript' >alert('Xóa gặp lỗi')</script>";
		echo header("Refresh:0; ../index.php?xem=diemthamquan");
	}
ob_flush()?>
</body>
</html>