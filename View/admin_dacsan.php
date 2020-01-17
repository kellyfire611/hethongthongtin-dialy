<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý đặc sản</title> 
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<?php
include('Controller/conn.php');
?>

 <form action="admin_dacsan.php" method="post">
               <table class="table table-bordered">
                        <tr>
                        	<td colspan='7' align="center"><h4> <strong><font color="#006600" simadacsanze='5'>QUẢN LÝ ĐẶC SẢN</font></strong></h4></td>
                        </tr>
                        <tr>
                        	<td colspan='7' align="right"><a href="index.php?xem=add_dacsan"><span class="glyphicon glyphicon-plus"></span><font size="5" color="#006600"><b>Thêm</b></font></a></td>
                        </tr>
                        <tr>
                           <th style="text-align: center;">STT</th>
                            <!-- <th>Hình ảnh</th> -->
                            <th style="text-align: center;">Mã đặc sản </th>
                            <th style="text-align: center;">Tên đặc sản </th>
						              	<th style="text-align: center;">Mô tả </th>
                             <th colspan="2" style="text-align: center;"> Thao tác </td>
                          </tr>
                          
                          <?php
						  $stt=0;
							$quser=mysqli_query($conn,"select * from `dacsan` ORDER BY madacsan ASC");
							while($row=mysqli_fetch_array($quser))
							  {
								$stt++;
								echo"<tr>";
								echo "<td class='nd'>".$stt."</td>";
                // echo "<td class='nd'><img src=uploads/".$row['hinhanh']." width='70' height='50' /></td>";
								echo "<td class='nd'>".$row['madacsan']."</td>";
								echo "<td class='nd'>".$row['tendacsan']."</td>";
                echo "<td class='nd'>".$row['mota']."</td>";															
								echo "<td class='nd'><a href='index.php?xem=edit_dacsan&ma=$row[madacsan]'><img src='image/edit.png' width='30px' height='30px'/></a> </td>";
              $checksql=mysqli_query($conn,"SELECT * FROM diemthamquan_dacsan WHERE madacsan = '".$row['madacsan']."' LIMIT 1 ");
             if (mysqli_num_rows($checksql)) {
              echo "<td class='nd' style='background: #f0f0f0;text-align:center;border: 1px solid #dddddd;'><a class='ti-lock' href='' onclick='lock();' ></a> </td>";
            }else{
								echo "<td class='nd'><a href='View/del_dacsan.php?id=$row[madacsan]'><img src='image/delete.png'width='30px' height='30px'/></a> </td>";
              }
							   	echo "</tr>";               
								 
							  }
							  
                 		?>
                          	
                        </table>
                    
</form>

</body>
</html>
<script type="text/javascript">
  function lock(){
    alert('Không thể xóa đặc sản này';
}
</script>