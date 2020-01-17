<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete dac san</title>
</head>

<body>
 <?php
 		include("conn.php");
		$id = intval($_REQUEST['id']);

		$sql = "delete from dacsan where madacsan=$id";
		$result = mysqli_query($conn,$sql);
		if ($result){
			echo json_encode(array('success'=>true));
			header("Location: admin_dacsan.php");
		} else {
			echo json_encode(array('errorMsg'=>'Xảy ra lỗi.'));
		}
		
 ?>
</body>
</html>