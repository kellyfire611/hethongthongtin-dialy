<?php
	
	 include("Controller/conn.php");
	 $id=$_GET['ma'];
?>
<?php
if(isset($_REQUEST['submit'])){
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
	   $diemden_idhuyen=addslashes($_POST['diemden_idhuyen']);
	   $diemkhoihanh_idhuyen=addslashes($_POST['diemkhoihanh_idhuyen']);
	   
		$image_file	= $_FILES["fileToUpload"]["name"];
		$type		= $_FILES["fileToUpload"]["type"];	//file name "txt_file"	
		$size		= $_FILES["fileToUpload"]["size"];
		$temp		= $_FILES["fileToUpload"]["tmp_name"];
		$path="uploads/tourdulich/".$image_file; //set upload folder path

		
		//$path="uploads/".$image_file; //set upload folder path
		if(empty($image_file)){
			$errorMsg="Vui lòng chọn Image";
		}
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
		{	
			if(!file_exists($path)) //check file not exist in your upload folder path
			{
				if($size < 5000000) //check file size 5MB
				{
					move_uploaded_file($temp, $path); //move upload file temperory directory to your upload folder
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
		if(empty($matour) || empty($tentour) || empty($giatour_nguoilon)||empty($giatour_treem) || empty($diemkhoihanh_ten) || empty($diemden_ten)|| empty($songaytour)) {	
			 echo"<script language='javascript' >alert('Chưa nhập dữ liệu')</script>";
		} else {	
		
		//updating the table
	
		$result = mysqli_query($conn, "UPDATE tourdulich SET matour='$matour',tentour='$tentour',giatour_nguoilon='$giatour_nguoilon',giatour_treem='$giatour_treem',diemkhoihanh_ten='$diemkhoihanh_ten',diemkhoihanh_toado=GeomFromText('$diemkhoihanh_toado'),diemden_ten='$diemden_ten',diemden_toado=GeomFromText('$diemden_toado'),songaytour='$songaytour',diemkhoihanh_idhuyen='$diemkhoihanh_idhuyen',diemden_idhuyen='$diemden_idhuyen', hinhanh='$image_file' WHERE matour='$id'");
		
		//redirectig to the display page. In our case, it is index.php
		//header("Location: admin_tourdulich.php");
		}
	
	if($result)
												
			{
				 echo"<script language='javascript' >alert('Cập nhật thành công')</script>";
					header("Refresh:0; url=index.php?xem=tourdulich");
			}
			else
			{
				echo"<script language='javascript' >alert('Không thể cập nhật cơ sở dữ liệu')</script>";
				
			}
			
}
?>
<!DOCTYPE html>
<html>
<title>Cập nhật tour du lịch</title>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
    	<h4 align="center"><font color="#006600" size="5">CẬP NHẬT TOUR DU LỊCH </font></h4>
<form action="" method="post" enctype="multipart/form-data"  class="form-horizontal">
		<?php

			//getting id from url
			
            $quser=mysqli_query($conn,"SELECT matour, tentour,giatour_nguoilon,giatour_treem,diemkhoihanh_ten, X(diemkhoihanh_toado) as lat_kh, Y(diemkhoihanh_toado) as lon_kh,diemden_ten,X(diemden_toado) as lat_dd, Y(diemden_toado) as lon_dd, songaytour,diemkhoihanh_idhuyen,diemden_idhuyen,hinhanh FROM tourdulich where matour='$id'");
			while($row=mysqli_fetch_array($quser))
			{

			?>
		<table width="100%">
			<tr>
					<td>
					<div class="form-group">
			        <label class="col-sm-3 control-label">Mã tour:<i style="color: red;">*</i></label>
			           <div class="col-sm-6">
			           	 <input type="text" value="<?php echo $row['matour'];?>" name='matour1' required class="form-control"  disabled />
			           	 <input type="hidden" value="<?php echo $row['matour'];?>" name='matour' required class="form-control" />
			           </div>
			   		</div>

			   		<div class="form-group">
			        <label class="col-sm-3 control-label">Tên tour: <i style="color: red;">*</i></label>
			           <div class="col-sm-6">
			           	<input type="text" value="<?php echo $row['tentour'];?>" name='tentour' required class="form-control"  />
			           </div>
			        </div>

			        <div class="form-group">
			        <label class="col-sm-3 control-label"> Giá Tour người lớn: <i style="color: red;">*</i></label>
			           <div class="col-sm-6">
			           	<input type="text" value="<?php echo $row['giatour_nguoilon'];?>" name="giatour_nguoilon" required class="form-control" />
			           </div>
			        </div>

			        <div class="form-group">
			        <label class="col-sm-3 control-label"> Giá tour trẻ em:  <i style="color: red;">*</i></label>
			           <div class="col-sm-6">
			           	<input type="text" value="<?php echo $row['giatour_treem'];?>" name="giatour_treem" required class="form-control"  />
			           </div>
			        </div>

			       <div class="form-group">
			        <label class="col-sm-3 control-label">Tên điểm khởi hành:  <i style="color: red;">*</i></label>
			           <div class="col-sm-6">
			           	<input type="text" value="<?php echo $row['diemkhoihanh_ten'];?>" name="diemkhoihanh_ten" required class="form-control"  />
			           </div>
			        </div>


				</div>
			</div>

			<div class="form-group">
       		 <label class="col-sm-3 control-label"> Thuộc địa phương: <i style="color: red;">*</i></label>	
       		    <div class="form-group col-sm-4">	
       		    	 <select  style="width: 150px;height: 36px;" id="tinhkh" name="tinhkh" onChange="gettinhtpdd(this.value);" class="form-control">
	       		    	 	<?php
					 	$querytinhtp=mysqli_query($conn,"SELECT idtinhtp, tentinhtp FROM tinhthanh WHERE idtinhtp IN ( SELECT idtinhtp FROM quanhuyen WHERE idquanhuyen = ".$row['diemkhoihanh_idhuyen']." )");
						while($tinhthanh=mysqli_fetch_array($querytinhtp)){
						?>
							<option value="<?php echo $tinhthanh['idtinhtp'];?>"><?php echo $tinhthanh['tentinhtp'];?> </option>
									
						<?php }
							$querytinhtpall=mysqli_query($conn,"SELECT idtinhtp, tentinhtp FROM tinhthanh ");
							while($tinhthanhall=mysqli_fetch_array($querytinhtpall)){
						?>
							<option value="<?php echo $tinhthanhall['idtinhtp'];?>"><?php echo $tinhthanhall['tentinhtp'];?> 
						   </option>
						<?php } ?>
					</select>
				</div>	
					<div class="form-group col-sm-4">				
						<select style="width: 150px;height: 36px;" name="diemkhoihanh_idhuyen" id="huyen_id" class="form-control">
							<?php 
								$queryqh = mysqli_query($conn,"SELECT idquanhuyen, tenquanhuyen FROM quanhuyen where idquanhuyen = ".$row['diemkhoihanh_idhuyen']."");
								while($infoquanhuyen=mysqli_fetch_array($queryqh)){
							?>
							<option value="<?php echo $infoquanhuyen['idquanhuyen'];?>"><?php echo $infoquanhuyen['tenquanhuyen'];?> </option>
						<?php } ?>
						</select>
				</div>
			</div>
			 <div id="stt_check_kh" class="input-group" style="    margin-left: 10px; margin-bottom: 15px"> 
                    <label class="col-sm-3 control-label"> Tọa độ:  <i style="color: red;">*</i></label>
                    <input style="height:30px;width:150px;" class="form-control" id="lat_kh" name="lat_kh" value="<?php echo $row['lat_kh'];?>" >
                    <input style="height:30px;width:150px;" class="form-control" id="lon_kh" name="lon_kh" value="<?php echo $row['lon_kh'];?>" onBlur="testkh()"  >
                </div>
				<!-- <div class="form-group" id="stt_check_kh">
		       		 <label class="col-sm-3 control-label"> Tọa độ điểm khởi hành:  <i style="color: red;">*</i></label>
		       		  <div class="col-sm-4"> <b>X:</b><input type="text" name="lat_kh"  class="form-control" value="<?php echo $row['lat_kh'];?>"/> </div>
		       		  <div class="col-sm-4"> 
		       		  	<b>Y:</b> 
		       		  	<input type="text" name="lon_kh" required="" value="<?php echo $row['lon_kh'];?>" onBlur="testkh()"  class="form-control"/></div>
		       		  
		        </div> -->
		    </div>
			<div class="form-group">
		        <label class="col-sm-3 control-label">Tên điểm đến:  <i style="color: red;">*</i></label>
		           <div class="col-sm-6">
		          	  <input type="text" name="diemden_ten" required class="form-control" value="<?php echo $row['diemden_ten'];?>" />
		           </div>
        </div>	
			<div class="form-group">
       		 <label class="col-sm-3 control-label"> Thuộc địa phương: <i style="color: red;">*</i></label>
       		     <div class="form-group col-sm-4">	
				<select class="form-control" style="width: 150px;height: 36px;" id="tinhdd" name="tinhdd" onChange="gettinhtp(this.value);">

				<?php
				 	$querytinhtpdd=mysqli_query($conn,"SELECT DISTINCT idtinhtp, tentinhtp FROM tinhthanh where idtinhtp IN (SELECT idtinhtp FROM quanhuyen WHERE idquanhuyen = ".$row['diemden_idhuyen'].")");
					while($tinhthanhdd=mysqli_fetch_array($querytinhtpdd)){
					?>
						<option value="<?php echo $tinhthanhdd['idtinhtp'];?>"><?php echo $tinhthanhdd['tentinhtp'];?></option>
								
					<?php }
						$querytinhtpddall=mysqli_query($conn,"SELECT idtinhtp, tentinhtp FROM tinhthanh ");
						while($tinhthanddhall=mysqli_fetch_array($querytinhtpddall)){
					?>
						<option value="<?php echo $tinhthanddhall['idtinhtp'];?>"><?php echo $tinhthanddhall['tentinhtp'];?> </option>
					<?php } ?>
					</select>
				</div>
				<div class="form-group col-sm-4">
					<select style="width: 150px;height: 36px;" name="diemden_idhuyen" id="huyendd" class="form-control">
						<?php 
							$queryqhdd = mysqli_query($conn,"SELECT idquanhuyen, tenquanhuyen FROM quanhuyen where idquanhuyen = '".$row['diemden_idhuyen']."'");
							while($infoquanhuyendd=mysqli_fetch_array($queryqhdd)){
						?>
						<option value="<?php echo $infoquanhuyendd['idquanhuyen'];?>"><?php echo $infoquanhuyendd['tenquanhuyen'];?> </option>
					<?php } ?>
					</select>
			</div>
		</div>
		 <div id="stt_check_dd" class="input-group" style="    margin-left: 10px; margin-bottom: 15px">
                    <!-- <span class="input-group-addon" style="width:125px;text-align: left;" > Tọa độ:<i style="color: red;">*</i></span> -->
                        <label class="col-sm-3 control-label"> Tọa độ:  <i style="color: red;">*</i></label>
                    <input style="height:30px;width:150px;" class="form-control" id="lat_dd" name="lat_dd" value="<?php echo $row['lat_dd'];?>" >
                    <input style="height:30px;width:150px;" class="form-control" id="lon_dd" name="lon_dd" value="<?php echo $row['lon_dd'];?>" onBlur="testdd()" >
                </div>
			<!-- <div class="form-group" id="stt_check_dd">
			 	 <label class="col-sm-3 control-label"> Tọa độ điểm đến:  <i style="color: red;">*</i></label>
					 
					 <div class="col-sm-4"> <b> X:</b><input type="text" name="lat_dd"  value="<?php echo $row['lat_dd'];?>"class="form-control"/></div>
					 
					  <div class="col-sm-4">  <b>Y:</b> <input type="text" name="lon_dd"  required value="<?php echo $row['lon_dd'];?>"onBlur="testdd()" class="form-control"/> </div>
						 
				</div>
			</div> -->

		<div class="form-group">
        	<label class="col-sm-3 control-label">Số ngày: <i style="color: red;">*</i></label>
        	   <div class="col-sm-6">
           			 <input type="text" name="songaytour" required class="form-control" value="<?php echo $row['songaytour'];?>" />
          	 </div>
          </div>
			
			
	  <div class="form-group">
        <label class="col-sm-3 control-label">Chọn ảnh </label>
        <div class="col-sm-6">
              <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
        	<input type="submit" value="Lưu" name="submit" class="btn btn-primary">
        	<!-- <input type="reset" value="Hủy bỏ" name="reset" class="btn btn-danger"/> -->
        </div>
       </div>
     </td>
     <td width="20%">
			<!-- <div class="w3-content">
				<div class="w3-row w3-margin"> -->
			 		<div class="col-xs-4 item-photo">
			  			<img src="uploads/tourdulich/<?php echo $row['hinhanh']?>" width='500' height='350'>
					</div>

          			</td>
   </tr>
   <?php }
			?>
 </table>
   <!-- </div>
  </div> -->
</form>
</div>
</div>
</div>

</body>
</html>
<script>
	function testkh(){
		idquanhuyen=$("#huyen_id").val();
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
		idquanhuyen=$("#huyendd").val();
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
			$("#huyendd").html(data);
			}
		});
	}
	function gettinhtpdd(val) {
		$.ajax({
		type: "POST",
		url: "Controller/getdiemden.php",
		data:'tinh_idd='+val,
		success: function(data){
			$("#huyen_id").html(data);
		}
		});
	}
</script>