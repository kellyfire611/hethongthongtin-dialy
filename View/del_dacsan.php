<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete dac san</title>
</head>

<body>
 <?php
 		include("../Models/conn.php");
		$id = $_GET['id'];
		echo $id;
		$sql = "delete from dacsan where madacsan = '$id'";
		$result = mysqli_query($conn,$sql);
		if ($result){
			 echo "<script>alert('Đã xóa thành công');</script>";
			 header("Location: http://localhost/tourdulich/index.php?xem=dacsan");
		} else {
			echo json_encode(array('errorMsg'=>'Xảy ra lỗi.'));
		}
		
 ?>
</body>
</html>