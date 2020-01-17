<?php
	include("conn.php");
	$id=$_GET['matour'];
	$madiemthamquan=$_GET['madiemthamquan'];
	// echo $id ."/". $madiemthamquan;
 	$result = mysqli_query($conn,"INSERT INTO `tourdulich_diemthamquan` (`matour`, `madiemthamquan`) VALUES ('$id', '$madiemthamquan')");
	// header("Location: ../View/add_diemthamquan_tourdulich.php?ma=$id");
	header("Location: ../index.php?xem=add_diemthamquan_tourdulich&ma=$id");
?>