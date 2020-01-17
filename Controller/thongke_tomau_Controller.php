<?php
$conn = mysqli_connect("localhost", "root", "", "quanlytourdulich");
mysqli_set_charset($conn, 'UTF8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="SELECT a.tentinhtp, count(c.madiemthamquan) as soluongdiem, a.idtinhtp
	FROM tinhthanh as a, quanhuyen as B, diemthamquan as c
    WHERE a.idtinhtp = b.idtinhtp
    AND b.idquanhuyen = c.idquanhuyen
    GROUP BY a.tentinhtp
    ORDER BY soluongdiem DESC
    LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row []= $result->fetch_assoc()) {
        
 $tem = $row;
 
 $json = json_encode($tem,JSON_UNESCAPED_UNICODE);
    }
} else {
    echo "0 results";
}
echo $json;
$conn->close();
?>