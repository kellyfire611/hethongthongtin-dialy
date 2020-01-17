<?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "", "quanlytourdulich");
  mysqli_set_charset($conn, 'UTF8');
  $query ="SELECT * FROM tinhthanh";
  $runQuery = $conn->query($query);
  while($row=mysqli_fetch_assoc($runQuery)) {
    $resultstinhtp[] = $row;
  }
?>
<body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý điểm tham quan</title> 
<link href="../css/style.css" rel="stylesheet" type="text/css" />

</head>



 <form action="admin_diemthamquan.php" method="post">
               <table  class="table table-bordered">
                        <tr>
                        	<td colspan='8' align="center"> <h4><strong><font color="#006600" simadacsanze='5'>QUẢN LÝ ĐIỂM THAM QUAN</font></strong></h4></td>
                        </tr>
                        <tr>
                        	<td colspan='9' align="right"><a href="index.php?xem=add_diemthamquan"><font size="5" color="#006600"><b>Thêm</b></font></a></td>
                        </tr>
                        <tr>
						    <th style="text-align: center;">STT</th>
							<th style="text-align: center;">Mã điểm tham quan</th>
							<th style="text-align: center;">Tên điểm tham quan</th>
						    <th style="text-align: center;">Tọa độ</th>
							<th style="text-align: center;">Quận huyện</th>
							<th style="text-align: center;">Đặc sản</th>
							<th style="text-align: center;" colspan="2">Thao tác</th>
					  	</tr>
                          <tr>
                          <?php
			require_once("Controller/dbcontroller.php");
			$db_handle = new DBController();
			$query ="SELECT madiemthamquan, tendiemthamquan, AsText(toadodiemthamquan), idquanhuyen FROM diemthamquan ORDER BY madiemthamquan ASC ";
			
			$stt=0;
			$results = $db_handle->runQuery($query);
			foreach($results as $row) {	
				$stt++;				
			  ?>
			  <tr>
				<td style="text-align: center;"><?php echo $stt;?></td>
				<td style="text-align: center;"><?php echo $row['madiemthamquan'];?></td>
				<td style="padding-left: 30px;"><?php echo $row['tendiemthamquan'];?></td>
				<td style="text-align: center;"><?php echo $row['AsText(toadodiemthamquan)'];?></td>
				<td style="text-align: center;">
					<?php
					$query1 ="SELECT * FROM quanhuyen where idquanhuyen='$row[idquanhuyen]'";
					$results1 = $db_handle->runQuery($query1);
					foreach($results1 as $row1){
					echo $row1['tenquanhuyen'];
				}
					?>
					</td>
				<?php
				echo "<td><a href='index.php?xem=add_dacsan_dtq&ma=$row[madiemthamquan]&ten=$row[tendiemthamquan]'><img src='image/review.png'width='30px' height='30px'/></a></td>";
				echo "<td><a href='index.php?xem=edit_diemthamquan&ma=$row[madiemthamquan]'><img src='image/edit.png' width='30px' height='30px'/></a></td>";
			$checksql=mysqli_query($conn,"SELECT * FROM tourdulich_diemthamquan WHERE madiemthamquan = '".$row['madiemthamquan']."' LIMIT 1 ");
				if (mysqli_num_rows($checksql)) {
					echo "<td class='nd' style='background: #f0f0f0;text-align: center;border: 1px solid #dddddd;'><a class='ti-lock'  href='' onclick='lock();'></a></td>";
				}
				else{
				echo "<td><a href='View/del_diemthamquan.php?id=$row[madiemthamquan]'><img src='image/delete.png'width='30px' height='30px'/></a></td>";
				}
			   	echo "</tr>";               
			}
			?>
             </tr>
          </table>
                    
</form>

</body>
</html>
<script type="text/javascript" src="../js/jquery-min.js"></script>      
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
	
 	function lock(){
    	alert('Không thể xóa điểm tham quan này');
	}
	</script>