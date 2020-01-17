
<?php
include("Controller/conn.php");
if(isset($_REQUEST['submit']))
{
			
		$image_file	= $_FILES["fileToUpload"]["name"];
		$type		= $_FILES["fileToUpload"]["type"];	//file name "txt_file"	
		$size		= $_FILES["fileToUpload"]["size"];
		$temp		= $_FILES["fileToUpload"]["tmp_name"];
		$matour=addslashes($_POST['matour']);
        $tentour=addslashes($_POST['tentour']);
        $giatour_nguoilon=addslashes($_POST['giatour_nguoilon']);
        $giatour_treem=addslashes($_POST['giatour_treem']);
        $diemkhoihanh_ten=addslashes($_POST['diemkhoihanh_ten']);
        $lat_kh=addslashes($_POST['lat_kh']);
        $lon_kh=addslashes($_POST['lon_kh']);
        $diemkhoihanh_toado = 'POINT('.$lat_kh." ".$lon_kh.')';
        $diemden_ten=addslashes($_POST['diemden_ten']);
        $lat_dd=addslashes($_POST['lat_dd']);
        $lon_dd=addslashes($_POST['lon_dd']);
        $diemden_toado = 'POINT('.$lat_dd." ".$lon_dd.')';
        $songaytour=addslashes($_POST['songaytour']);
        $diemkhoihanh_idtinh=addslashes($_POST['huyendd']);
         $diemden_idtinh=addslashes($_POST['huyen']);
         // echo $diemkhoihanh_idtinh."<br>";
         // echo $diemden_idtinh;
     //   $diemkhoihanh_idtinh=addslashes($_POST['diemkhoihanh_idtinh']);
     //   $diemden_idtinh=addslashes($_POST['diemden_idtinh']);
		
		$path="uploads/tourdulich/".$image_file; //set upload folder path
		if(empty($matour)||empty($tentour)||empty($giatour_nguoilon)||empty($giatour_treem)||empty($diemkhoihanh_ten)||empty($diemden_ten)||empty($songaytour)){
			$errorMsg="Vui lòng nhập dữ liệu";
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
					move_uploaded_file($temp, "uploads/tourdulich/" .$image_file); //move upload file temperory directory to your upload folder
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
			$errorMsg="Chỉ Upload fle có định dạng JPG , JPEG , PNG & GIF "; //error message file extension
		}
		 if($matour&&$tentour&&$giatour_nguoilon&&$giatour_treem&&$diemkhoihanh_ten&&$diemden_ten&&$songaytour)
		{
			$quser=mysqli_query($conn,"select * from `tourdulich` where matour='".$matour."'");
			if(mysqli_fetch_assoc($quser)!="")
				{
			   		 echo "Mã tour này đã tồn tại rồi<br />";
			    }
		   else  
		   {
			 $result = mysqli_query($conn,"INSERT INTO `tourdulich`(`matour`, `tentour`, `giatour_nguoilon`, `giatour_treem`,`diemkhoihanh_ten`,`diemkhoihanh_toado`,`diemden_ten`, `diemden_toado`, `songaytour`,`diemkhoihanh_idhuyen`,`diemden_idhuyen`,`hinhanh`) VALUES ('$matour','$tentour','$giatour_nguoilon','$giatour_treem','$diemkhoihanh_ten',GeomFromText('$diemkhoihanh_toado'),'$diemden_ten',GeomFromText('$diemden_toado'),'$songaytour','$diemkhoihanh_idtinh','$diemden_idtinh','$image_file')");
			 //header("Location: admin_tourdulich.php");
		   }
		   if($result)
												
			{
				 echo"<script language='javascript'>alert('Thêm thành công')</script>";
					header("Location:http://localhost/tourdulich/index.php?xem=tourdulich");

			}
			else
			{
				echo"<script language='javascript' >alert('Không thể thêm vào cơ sở dữ liệu')</script>";
				
			}
		  }	

		
}

	?>
<?php
ob_start(); 
require_once("Controller/dbcontroller.php");
$db_handle = new DBController();
$query ="SELECT * FROM tinhthanh";
$results = $db_handle->runQuery($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý tour du lịch </title>
<!-- <script type="text/javascript" src="../../ckeditor/sample.js"></script> -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
    	 <h4 align="center"><font color="#006600" size="5">THÊM TOUR DU LỊCH </font></h4>
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
	<table width="100%">
			<tr>
				<td>
	 <div class="form-group">
        <label class="col-sm-3 control-label">Mã tour: <i style="color: red;">*</i></label>
           <div class="col-sm-6">
           	<input type="text" value="" name='matour' required class="form-control" placeholder="Mã tour" />
           </div>
        </div>
        <div class="form-group">
        <label class="col-sm-3 control-label">Tên tour: <i style="color: red;">*</i></label>
           <div class="col-sm-6">
           	<input type="text" value="" name='tentour' required class="form-control" placeholder="Tên tour" />
           </div>
        </div>
		 <div class="form-group">
        <label class="col-sm-3 control-label"> Giá Tour người lớn: <i style="color: red;">*</i></label>
           <div class="col-sm-6">
           	<input type="text" value="" name="giatour_nguoilon" required class="form-control" placeholder="Giá tour người lớn" />
           </div>
        </div>
		 <div class="form-group">
        <label class="col-sm-3 control-label"> Giá tour trẻ em:  <i style="color: red;">*</i></label>
           <div class="col-sm-6">
           	<input type="text" value="" name="giatour_treem" required class="form-control" placeholder="Giá tour trẻ em" />
           </div>
        </div>
		 <div class="form-group">
        <label class="col-sm-3 control-label">Tên điểm khởi hành:  <i style="color: red;">*</i></label>
           <div class="col-sm-6">
           	<input type="text" value="" name="diemkhoihanh_ten" required class="form-control" placeholder="Điểm khởi hành" />
           </div>
        </div>
		
		<div class="form-group" style="margin-left:10px">
       		 <label class="col-sm-3 control-label"> Thuộc địa phương:  <i style="color: red;">*</i></label>	
       		    <div class="form-group col-sm-4">					
				<select id="tinhtp" name="diemkhoihanh_idtinh" onChange="gettinhtpdd(this.value);" class="form-control" style="height:35px">
					<option>--Tỉnh/thành phố---</option>
					<?php
					foreach($results as $row) {
					?>
						<option value="<?php echo $row['idtinhtp'];?>"><?php echo $row['tentinhtp'];?> </option>
								
				<?php
						}
						?>
					</select>
					</div>
				<div class="form-group col-sm-4">
					<select id="huyendd" name="huyendd" class="form-control" style="height:35px">
						<option>--Quận/huyện----</option>
					</select>
				</div>
			</div>
		<div id="stt_check_kh" class="input-group" style="    margin-left: 10px; margin-bottom: 15px">
                    <label class="col-sm-3 control-label" style="width:300px"> Tọa độ:  <i style="color: red;">*</i></label>
                    <input style="height:30px;width:150px;" class="form-control" id="lat_kh" name="lat_kh" placeholder="Nhập giá trị Lat" >
                    <input style="height:30px;width:150px;" class="form-control" id="lon_kh" name="lon_kh" onBlur="testkh()" placeholder="Nhập giá trị Long" >
            </div>
		<!-- <div class="form-group">
			 <div class="row">
       		 <label class="col-sm-3 control-label"> Tọa độ điểm khởi hành:  <i style="color: red;">*</i></label>
       		 <b>X:</b> <div class="col-sm-4"> <input type="text" name="lat_kh"  class="form-control"/> </div>
       		 <b>Y:</b>  <div class="col-sm-4"> <input type="text" name="lon_kh" required="" onBlur="testkh()"  class="form-control"/></div>
       		    <span id="stt_check_kh"></span> 
        </div> -->
    </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Tên điểm đến:  <i style="color: red;">*</i></label>
           <div class="col-sm-6">
            <input type="text" name="diemden_ten" required class="form-control" placeholder="Tên điểm đến" />
           </div>
        </div>
        	<div class="form-group" style="margin-left:10px">
       		 <label class="col-sm-3 control-label"> Thuộc địa phương: <i style="color: red;">*</i></label>
       		     <div class="form-group col-sm-4">				
						<select  name="diemden_idtinh" style="height:35px" id="tinhtp" onChange="gettinhtp(this.value);" class="form-control">
						<option>--Tỉnh/thành phố---</option>
						<?php
						foreach($results as $row) {
						?>
							<option value="<?php echo $row['idtinhtp'];?>"><?php echo $row['tentinhtp'];?> </option>
									
					<?php
							}
							?>
						</select>
				</div>
		 	<div class="form-group col-sm-4">
						<select id="huyen"  name="huyen" class="form-control" style="height:35px">
							<option>--Quận/huyện----</option>
						</select>
			</div>
		</div>
		
		<div id="stt_check_dd" class="input-group" style="    margin-left: 10px; margin-bottom: 15px">
			<label class="col-sm-3 control-label"> Tọa độ:  <i style="color: red;">*</i></label>
                   <!--  <span class="input-group-addon" style="width:160px;text-align: left;" > Tọa độ điểm đến:<i style="color: red;">*</i></span> -->
                    <input style="height:30px;width:150px;" class="form-control" id="lat_dd" name="lat_dd" placeholder="Nhập giá trị Lat" >
                    <input style="height:30px;width:150px;" class="form-control" id="lon_dd" name="lon_dd" onBlur="testdd()" placeholder="Nhập giá trị Long">
            </div>
          
			<!-- <div class="form-group">
			 <div class="row">
			 	 <label class="col-sm-3 control-label"> Tọa độ điểm đến:  <i style="color: red;">*</i></label>
					 <b> X:</b><div class="col-sm-4"> <input type="text" name="lat_dd" class="form-control"/></div>
					  <b>Y:</b><div class="col-sm-4">  <input type="text" name="lon_dd"  required onBlur="testdd()" class="form-control"/> </div>
						 <span id="stt_check_dd"></span> 
					</div>
			</div> -->

		<div class="form-group">
        	<label class="col-sm-3 control-label">Số ngày: </label>
        	   <div class="col-sm-6">
           			 <input type="text" name="songaytour" required class="form-control" placeholder="Số ngày" />
          	 </div>
          </div>
        
	<div class="form-group">
        <label class="col-sm-3 control-label">Hình tour du lịch: </label>
        <div class="col-sm-6">
              <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
			<input type="submit" value="Lưu" name="submit" class="btn btn-success ">
			 <input type="reset" value="Hủy bỏ" name="reset" class="btn btn-danger"/>
		</div>
	</div>
</form>
</td>
</tr>
</table>
</div>
</div>
</div>
</body>
</html>
<script>
	function testkh(){
		idquanhuyen=$("#huyendd").val();
		lat=$("#lat_kh").val();
		long=$("#lon_kh").val();
		$.ajax({
			type: "POST", //với servlet thì sẽ đi vào method doPost
			url: "Controller/checkpointkh.php", 
			data: "idquanhuyen="+idquanhuyen+"&lat="+lat+"&long="+long+"",
			async: false,
			success: function (result) {
				$("#stt_check_kh").html(result);
			}
		});
	}
	function testdd(){
		idquanhuyen=$("#huyen").val();
		lat=$("#lat_dd").val();
		long=$("#lon_dd").val();
		$.ajax({
			type: "POST", //với servlet thì sẽ đi vào method doPost
			url: "Controller/checkpointdd.php", 
			data: "idquanhuyen="+idquanhuyen+"&lat="+lat+"&long="+long+"",
			async: false,
			success: function (result) {
				$("#stt_check_dd").html(result);
			}
		});	
	}
	function gettinhtp(val) {
	$.ajax({
	type: "POST",
	url: "Controller/gethuyen.php",
	data:'tinh_id='+val,
	success: function(data){
		$("#huyen").html(data);
		}
	});
	}
	function gettinhtpdd(val) {
		$.ajax({
		type: "POST",
		url: "Controller/getdiemden.php",
		data:'tinh_idd='+val,
		success: function(data){
			$("#huyendd").html(data);
		}
		});
	}
</script>