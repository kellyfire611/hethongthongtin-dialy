<?php
//including the database connection file
include_once("conn.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM dacsan ORDER BY madacsan DESC"); // using mysqli_query instead
?>

<html>
<head>	
	<title>Đặc sản</title>
</head>

<body>
<a href="add.html">Thêm</a><br/><br/>

	<table width='80%' border=0>

	<tr>
		<th>STT</th>
		<th>Mã đặc sản</th>
		<th>Tên đặc sản</th>
		<th>Mô tả</th>
		
	</tr>
	<?php 
	 $stt=0;
	//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
	while($res = mysqli_fetch_array($result)) { 
         $stt++; 	
		echo "<tr>";
		echo "<td>".$stt."</td>";
		echo "<td>".$res['madacsan']."</td>";
		echo "<td>".$res['tendacsan']."</td>";
		echo "<td>".$res['mota']."</td>";	
		echo "<td><a href=\"edit_dacsan.php?id=$res[id]\">Edit</a> | <a href=\"delete_dacsan.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
	}
	?>
	</table>
</body>
</html>
