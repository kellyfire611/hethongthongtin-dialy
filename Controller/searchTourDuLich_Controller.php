<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "quanlytourdulich";
      $conn = new mysqli($servername, $username, $password, $dbname);
      mysqli_set_charset($conn, 'UTF8');

$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "
	SELECT * FROM tourdulich 
	WHERE matour LIKE '%".$search."%'
	OR tentour LIKE '%".$search."%' 
	OR diemkhoihanh_ten LIKE '%".$search."%' 
	OR diemden_ten LIKE '%".$search."%' 
	";
}
else
{
	$query = "
	SELECT * FROM tourdulich ORDER BY matour";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{

	$output .= '<div class="table-responsive" style="width: 300px; height:357px; ">
					<table id="table" class="table table bordered">
						<tr style="background-color:#D8D8D8; color:#6E6E6E">
						    <th hidden>Mã tour</th>
						    <th>Tour du lịch</th>
							<th>Điểm khởi hành --> Điểm đến</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
			    <td hidden>'.$row["matour"].'</td>
				<td>'.$row["matour"].'-'.$row["tentour"].'</td>
				<td>'.$row["diemkhoihanh_ten"].' --> '.$row["diemden_ten"].'</td>
			</tr>
		';
	}



   $output .= ' <script>
            var table = document.getElementById("table"),rIndex,cIndex;
            
            // table rows
            for(var i = 1; i < table.rows.length; i++)
            {
               table.rows[i].onclick = function()
                    {
                         //rIndex = this.rowIndex;
                        //  alert(this.cells[0].innerHTML) ;
                       // return this.cells[0].innerHTML;

                       location.href = "../View/searchTourDuLich.php?matour="+this.cells[0].innerHTML;
                        // document.getElementById("lname").value = this.cells[1].innerHTML;
                        // document.getElementById("age").value = this.cells[2].innerHTML;
                    };
           }
            
   </script>';
	

	// $output .= '<div class="table-responsive" style="width: 300px">
	// 				<table class="table table bordered">
	// 					<tr>
	// 						<th>Mã tour</th>
	// 						<th>Tên tour</th>
	// 						<th>Điểm khởi hành</th>
	// 						<th>Điểm đến</th>
	// 						<th>Xem</th>
	// 					</tr>';
	// while($row = mysqli_fetch_array($result))
	// {
	// 	$output .= '
	// 		<tr>
	// 			<td>'.$row["matour"].'</td>
	// 			<td>'.$row["tentour"].'</td>
	// 			<td>'.$row["diemkhoihanh_ten"].'</td>
	// 			<td>'.$row["diemden_ten"].'</td>
 //                <td><a href=map_hienthitourdulich.php?matour='.$row["matour"].'><center><img src="../DoAn_HTTTDiaLy/image/map-marker.png" width="30" height="30" /></center></a></td>
	// 		</tr>
	// 	';
	// }

	echo $output;
}
else
{
	echo 'Không tìm thấy dữ liệu.';
}
?>
