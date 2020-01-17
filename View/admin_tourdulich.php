
<body>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý tour du lich</title> 
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<?php
include('Controller/conn.php');
?>

 <form action="admin_tourdulich.php" method="post">
               <table class="table table-bordered" >
                        <tr>
                        	<td colspan='12' align="center"><h4> <strong><font color="#006600" simadacsanze='5' >QUẢN LÝ TOUR DU LỊCH</font></strong></h4></td>
                        </tr>
                        <tr>
                        	<td colspan='12' align="right"><a href="index.php?xem=add_tourdulich"><font size="5" color="#006600"><b>Thêm</b></font></a></td>
                        </tr>
                        <tr>
                            <th style="text-align: center;">STT</th>
                            <th style="text-align: center;">Mã tour</th>
							<th style="text-align: center;">Tên tour </th>
                            <th style="text-align: center;">Giá tour người lớn</th>
							<th style="text-align: center;">Giá tour trẻ em</th>
							<th style="text-align: center;">Điểm khởi hành</th>
							<th style="text-align: center;">Điểm đến</th>
							<th style="text-align: center;">Số ngày</th>
							<th style="text-align: center;">Điểm tham quan</th>	 
							<th style="text-align: center;" colspan="2">Thao tác</th>	 
                          </tr>
                          <tr>
                          <?php
							 require_once("Controller/dbcontroller.php");
							$db_handle = new DBController();	
							$query ="SELECT matour, tentour,giatour_nguoilon,giatour_treem,diemkhoihanh_ten, diemden_ten, songaytour,hinhanh FROM tourdulich ORDER BY matour ASC";
							$stt=0;
							$results = $db_handle->runQuery($query);
							foreach($results as $row) {	
							$stt++;
							  ?>
							  <tr>
								<td><?php echo $stt;?></td>
								<td><?php echo $row['matour'];?></td>
								<td><?php echo $row['tentour'];?></td>
								<td><?php echo number_format($row['giatour_nguoilon']);?></td>
								<td><?php echo number_format($row['giatour_treem']);?></td>
								<td><?php echo  $row["diemkhoihanh_ten"]; ?></td>
								<td><?php echo  $row["diemden_ten"]; ?></td>
								<td><?php echo $row['songaytour'];?></td>
							 <?php
							 echo "<td align='center'><a href='index.php?xem=add_diemthamquan_tourdulich&ma=$row[matour]&ten=$row[tentour]'><img src='image/review.png' width='30px' height='30px'/></a> </td>";
								echo "<td class='nd'><a href='index.php?xem=edit_tourdulich&ma=$row[matour]'><img src='image/edit.png' width='30px' height='30px'/></a> </td>";
								echo "<td class='nd'><a href='View/del_tourdulich.php?id=$row[matour]'><img src='image/delete.png'width='30px' height='30px'/></a> </td>";
							   	echo "</tr>";               
								 
							}  
                 		?>
                          	</tr>
                        </table>
                    
</form>

</body>
</html>
