<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "quanlytourdulich");
mysqli_set_charset($conn, 'UTF8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if ($_GET["idtinhtp"]==null) {
	echo "Chưa khởi tạo id tỉnh thành";
}else{
	$sql="SELECT X(pointtinhtp) as lat, Y(pointtinhtp) as lon FROM polygontinhtp Where shapeid IN (SELECT shapeid FROM shapeidtinhtp WHERE idtinhtp = ".$_GET["idtinhtp"].")"; 
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    	while($row []= $result->fetch_assoc()) {
 			$tem = $row;
 			$json = json_encode($tem,JSON_UNESCAPED_UNICODE);
    	}
	}else{
	    echo "0 results";
	}
	echo $json;
}
$conn->close();
?>