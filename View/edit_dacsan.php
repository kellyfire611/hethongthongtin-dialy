<?php
	
	 include("Models/conn.php");
	 $id=$_GET['ma'];
?>
<?php
if(isset($_REQUEST['submit'])){
	$madacsan=addslashes($_POST['madacsan']);
	$tendacsan=addslashes($_POST['tendacsan']);
	$mota=addslashes($_POST['mota']);
	$image_file	= $_FILES["fileToUpload"]["name"];
	$type		= $_FILES["fileToUpload"]["type"];	//file name "txt_file"	
	$size		= $_FILES["fileToUpload"]["size"];
	$temp		= $_FILES["fileToUpload"]["tmp_name"];
	$path="uploads/dacsan/".$image_file; //set upload folder path
	if(empty($image_file)){
			echo"<script language='javascript' >alert('Vui lòng chọn Image')</script>";
			// $errorMsg="Vui lòng chọn Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
		{	
			//check file not exist in your upload folder path
			// if(!file_exists($path)) {
				//check file size 5MB
				if($size < 5000000){
					move_uploaded_file($temp, $path); //move upload file temperory directory to your upload folder
				}
				else{
					echo"<script language='javascript' >alert('Vui lòng chọn file upload nhỏ hơn 5MB Size')</script>";
					// $errorMsg="Vui lòng chọn file upload nhỏ hơn 5MB Size"; //error message file size not large than 5MB
				}
			// }
			// else{	
			// 	echo"<script language='javascript' >alert('File đã tồn tại')</script>";
			// 	// $errorMsg="File đã tồn tại"; //error message file not exists your upload folder path
			// }
		}
		else
		{
			echo"<script language='javascript' >alert('Chỉ Upload fle có định dạng JPG , JPEG , PNG & GIF ')</script>";
			// $errorMsg="Chỉ Upload fle có định dạng JPG , JPEG , PNG & GIF "; //error message file extension
		}
		if(empty($madacsan) || empty($tendacsan) || empty($mota)) {	
			 echo"<script language='javascript' >alert('Chưa nhập dữ liệu')</script>";
			
	} else {	
		//updating the table
		$result = mysqli_query($conn, "UPDATE dacsan SET madacsan='$madacsan',tendacsan='$tendacsan',mota='$mota' ,hinhanh='$image_file'WHERE madacsan='$id'");
		echo $madacsan;
		echo $tendacsan;
		echo $mota;
		echo $image_file;
		echo $id;
	}
	if($result){
		echo"<script language='javascript' >alert('Cập nhật thành công')</script>";
		header("Refresh:0; url=index.php?xem=dacsan");
	}else{
		echo"<script language='javascript' >alert('Không thể cập nhật cơ sở dữ liệu')</script>";	
	}
}
?>
<!DOCTYPE html>
<html>
<title>Cập nhật đặc sản</title>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
    	<h4 align="center"><font color="#006600" size="5">CẬP NHẬT ĐẶC SẢN </font></h4>
<form action="" method="post" enctype="multipart/form-data">
<table width="100%">
	<tr>
		 <td width="40%">
<?php
			//getting id from url
			include("Models/conn.php");
			$id=$_GET['ma'];
            $quser=mysqli_query($conn,"select * from `dacsan` where madacsan='$id'");
			while($row=mysqli_fetch_assoc($quser)){
			?> 
			<div class="form-group">
				 <label class="col-sm-3 control-label">Mã đặc sản:<i style="color: red;">*</i></label>
					<div class="col-sm-6">
						 <input type="text"  name='madacsan1' required class="form-control" value="<?php echo $row['madacsan'];?>"  disabled />
						 	 <input type="hidden" name='madacsan' class="form-control" value="<?php echo $row['madacsan'];?>"/>
				    </div>
			</div>
			</br>
			<div class="input-group"">
				 <label class="col-sm-3 control-label">Tên đặc sản:<i style="color: red;">*</i></label>
					<div class="col-sm-6">
						 <input type="text"  name='tendacsan' required class="form-control" value="<?php echo $row['tendacsan'];?>"   />
				    </div>
			</div>
			</br>
			<div class="form-group">
				 <label class="col-sm-3 control-label">Mô tả:<i style="color: red;">*</i></label>
					<div class="col-sm-6">
						 <input type="text" name="mota" style="width:400px; height:150px" class="form-control" value="<?php echo $row['mota'];?>" />
				    </div>
			</div>

	  <div class="form-group">
       		 <label class="col-sm-7 control-label" >Chọn ảnh</label>
        <div class="col-sm-6" >
              <input type="file" name="fileToUpload" id="fileToUpload" />
        </div>
        </div>

  		<div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
        	
        	<input type="submit" value="Lưu" name="submit" style="max-width: 70px;font-size: 20px;" class="btn btn-primary" >
          <a href="index.php?xem=dacsan"><input style="width: 80px; height: 40px" value="Hủy bỏ" name="reset" class="btn btn-danger"/></a>
        </div>
    	</div>


		 </td>
		 <td>
		 <td width="20%">
		 	<div class="col-xs-4 item-photo">
	 			 <img src="uploads/dacsan/<?php echo $row['hinhanh']?>" width='400' height='350'/> 
	 			<!-- <img src="../uploads/dacsan/muttraicay.jpg"/> -->
	 		
			</div>
		</td>
		 </td>
	</tr>
</table>

	<?php
	 }
?>
<!-- <div class="w3-third" style="float:left"> -->
<!-- <div class="w3-content">
<div class="w3-row w3-margin">
  -->
<!-- <div class="w3-twothird w3-container" style="float:right"> -->
  
</form>
</div>
</div>
</div>
</body>
</html>