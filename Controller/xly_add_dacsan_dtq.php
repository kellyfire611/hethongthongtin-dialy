<?php
	include("conn.php");
	$id=$_GET['madiemthamquan'];
	$madacsan=$_GET['madacsan'];
	//echo $id ."/". $madiemthamquan;
 	$result = mysqli_query($conn,"INSERT INTO `diemthamquan_dacsan` (`madiemthamquan`, `madacsan`) VALUES ('$id', '$madacsan')");
 	header("Location: ../index.php?xem=add_dacsan_dtq&ma=$id");
	// header("Location: ../View/add_dacsan_dtq.php?ma=$id");
?>