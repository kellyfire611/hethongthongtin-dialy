<?php
include('Models/conn.php');
if(isset($_REQUEST["submit"])) {
  $image_file = $_FILES["fileToUpload"]["name"];
  $type   = $_FILES["fileToUpload"]["type"];  //file name "txt_file"  
  $size   = $_FILES["fileToUpload"]["size"];
  $temp   = $_FILES["fileToUpload"]["tmp_name"];
  $madacsan=addslashes($_POST['madacsan']);
  $tendacsan=addslashes($_POST['tendacsan']);
  $mota=addslashes($_POST['mota']);
$path="uploads/dacsan/".$image_file; //set upload folder path
// Check if file already exists

if($madacsan==""||$tendacsan=="")
   {
	   echo "<script>alert('Chưa nhập dữ liệu');</script>";
   }
  else if(empty($image_file)){
      $errorMsg="Vui lòng chọn ảnh";
    } 
    else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
    { 
      if(!file_exists($path)) //check file not exist in your upload folder path
      {
        if($size < 5000000) //check file size 5MB
        {
          move_uploaded_file($temp, "uploads/dacsan/" .$image_file); //move upload file temperory directory to your upload folder
        }
        else
        {
          $errorMsg="Vui lòng chọn file upload nhỏ hơn 5MB Size"; //error message file size not large than 5MB
        }
      }
      else
      { 
        $errorMsg="File đã tồn tại"; //error message file not exists your upload folder path
      }
    }
    else
    {
      $errorMsg="Chỉ Upload file có định dạng JPG , JPEG , PNG & GIF "; //error message file extension
    }
   if($madacsan&&$tendacsan&&$mota)
   {

		$quser=mysqli_query($conn,"select * from `dacsan` where madacsan='".$madacsan."'");
	if(mysqli_fetch_assoc($quser)!="")
	{
   		 echo "Mã đặc sản này đã tồn tại rồi<br />";
	}
	else  	
	{
		 $result = mysqli_query($conn,"INSERT INTO `dacsan` (`madacsan`, `tendacsan`, `mota`,`hinhanh`) VALUES ('$madacsan', '$tendacsan', '$mota','$image_file')");
							
		if($result)								
		{
			 echo"<script language='javascript' >alert('Thêm đặc sản thành công')</script>";
			 header("Location: index.php?xem=dacsan");
		}
		else
		{
			echo"<script language='javascript' >alert('Không thể thêm vào cơ sở dữ liệu')</script>";
			
		}
	   
   }  
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>Thêm đặc sản</title>
    
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
    
</head>

  <body>
  <div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
        <h4 align="center"><font color="#006600" size="5">THÊM ĐẶC SẢN </font></h4>
      <form method="post" class="form-horizontal" enctype="multipart/form-data">
          
        <div class="form-group">
        <label class="col-sm-3 control-label">Mã đặc sản <i style="color: red;">*</i></label>
           <div class="col-sm-6">
            <input type="text" value="" name='madacsan' required class="form-control" placeholder="Mã đặc sản" />
           </div>
        </div>
          

         <div class="form-group">
        <label class="col-sm-3 control-label">Tên đặc sản <i style="color: red;">*</i></label>
           <div class="col-sm-6">
            <input type="text" value="" name='tendacsan' required class="form-control" placeholder="Tên đặc sản" />
           </div>
        </div>
        
         <div class="form-group">
        <label class="col-sm-3 control-label">Mô tả</label>
           <div class="col-sm-6">
          <textarea  name ="mota" rows="10" cols="50"  id="mota" class="form-control" placeholder="Mô tả" /></textarea>
           </div>
        </div>

         <div class="form-group">
        <label class="col-sm-3 control-label">Chọn ảnh</label>
        <div class="col-sm-6">
              <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
        </div>
        </div>
          
          
        <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
          <input type="submit" value="Lưu" name="submit" style="max-width: 70px;font-size: 20px;" class="btn btn-primary" >
          <a href="index.php?xem=dacsan"><input style="width: 80px; height: 40px" value="Hủy bỏ" name="reset" class="btn btn-danger"/></a>
        </div>
        </div>
          
      </form>
      
    </div>
    
  </div>
      
  </div>
                    
  </body>
</html>