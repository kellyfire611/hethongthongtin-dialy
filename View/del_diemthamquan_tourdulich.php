<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete dac san</title>
</head>

<body>
 <?php
 		include("conn.php");
		$matour = $_REQUEST['id'];
		$madiemthamquan=$_REQUEST['madiemthamquan'];
		echo $matour."/", $madiemthamquan;
		$sql = "delete from tourdulich_diemthamquan where matour=$matour and madiemthamquan=$madiemthamquan";
		$result = mysqli_query($conn,$sql);

		echo "Đã xóa";
		header("Refresh:0; url=add_diemthamquan_tourdulich.php?ma=$matour");
		//header("Location: add_diemthamquan_tourdulich.php");
		/*if ($result){
			echo json_encode(array('success'=>true));
			header("Location: add_diemthamquan_tourdulich.php?ma=$matour");
		} else {
			echo json_encode(array('errorMsg'=>'Xảy ra lỗi.'));
		}*/
		
 ?>
</body>
</html>