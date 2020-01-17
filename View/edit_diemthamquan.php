<?php
	
	 include("Controller/conn.php");
	 $id=$_GET['ma'];
?>
<?php          
if(isset($_REQUEST['update'])){	

	 $image_file = $_FILES["fileToUpload"]["name"];
    $type   = $_FILES["fileToUpload"]["type"];  //file name "txt_file"  
    $size   = $_FILES["fileToUpload"]["size"];
    $temp   = $_FILES["fileToUpload"]["tmp_name"];
    $madiemthamquan=addslashes($_GET['ma']);
	$tendiemthamquan=addslashes($_POST['tendiemthamquan']);
	$idquanhuyen=addslashes($_POST['idhuyen']);
	$lat=addslashes($_POST['lat']);
	$long=addslashes($_POST['long']);
	$toadodiemthamquan = 'POINT('.$lat." ".$long.')';
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

	
	            if(empty($madiemthamquan) || empty($tendiemthamquan) || empty($idquanhuyen)|| empty($idquanhuyen)|| empty($lat)|| empty($long)) {
					echo"<script language='javascript' >alert('Chưa nhập dữ liệu')</script>";
				}else{	
					$result = mysqli_query($conn, "UPDATE diemthamquan SET tendiemthamquan='$tendiemthamquan', hinhanh = '$image_file',toadodiemthamquan=GeomFromText('$toadodiemthamquan'), idquanhuyen='$idquanhuyen' WHERE madiemthamquan='$madiemthamquan'");
				}
				if($result){
					echo"<script language='javascript' >alert('Cập nhật thành công')</script>";
					header("Refresh:0; url=index.php?xem=diemthamquan");
				}else{
					echo"<script language='javascript' >alert('Không thể cập nhật cơ sở dữ liệu')</script>";	
				}
          
    }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/style_kieu.css" rel="stylesheet" type="text/css" /> 
<title>CẬP NHẬT ĐIỂM THAN QUAN</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
    	<h4 align="center"><font color="#006600" size="5">CẬP NHẬT ĐIỂM THAM QUAN </font></h4>
	
				<form name="form1" method="post" action="" class="form-horizontal" enctype="multipart/form-data">
					<table width="100%">
						<tr>
							<td>
								<?php
					            $quser=mysqli_query($conn,"SELECT madiemthamquan, tendiemthamquan, hinhanh, X(toadodiemthamquan) as lat, Y(toadodiemthamquan) as lon, idquanhuyen FROM diemthamquan where madiemthamquan='$id'");
								while($row=mysqli_fetch_array($quser)){
							?>
							<div class="form-group">
						        <label class="col-sm-3 control-label">Mã điểm tham quan:<i style="color: red;">*</i></label>
						           <div class="col-sm-6">
						           	 <input type="text"  class="form-control" value="<?php echo $row['madiemthamquan'];?>" id="madiemthamquan" name="madiemthamquan1" disabled class="form-control" />
						           </div>
						            <input type="hidden" class="form-control" value="<?php echo $row['madiemthamquan'];?>" id="madiemthamquan" name="madiemthamquan" />
						   		</div>

						   		<div class="form-group">
						        <label class="col-sm-3 control-label">Tên điểm tham quan::<i style="color: red;">*</i></label>
						           <div class="col-sm-6">
						           	 <input type="text"  class="form-control" value="<?php echo $row['tendiemthamquan'];?>" id="tendiemthamquan" name="tendiemthamquan" class="form-control" />
						           </div>
						   		</div>

						   <div class="form-group">
		                    <label class="col-sm-3 control-label">Thuộc tỉnh:<i style="color: red;">*</i></label>
		                    <div class="form-group col-sm-4">	
				                    <select  style="height:35px" id="tinhdd" name="tinhdd" onChange="gettinhtp(this.value);" class="form-control" >
									<?php
								 	$querytinhtpdd=mysqli_query($conn,"SELECT DISTINCT idtinhtp, tentinhtp FROM tinhthanh where idtinhtp IN (SELECT idtinhtp FROM quanhuyen WHERE idquanhuyen = ".$row['idquanhuyen'].")");
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
							<div  <div class="form-group col-sm-4">	
								<select style="width: 150px;height: 36px;" name="idhuyen" id="idhuyen" class="form-control">
									<?php 
										$queryqhdd = mysqli_query($conn,"SELECT idquanhuyen, tenquanhuyen FROM quanhuyen where idquanhuyen = '".$row['idquanhuyen']."'");
										while($infoquanhuyendd=mysqli_fetch_array($queryqhdd)){
									?>
									<option value="<?php echo $infoquanhuyendd['idquanhuyen'];?>"><?php echo $infoquanhuyendd['tenquanhuyen'];?> </option>
								<?php } ?>
								</select>
							</div>
		                </div>
		                <div id="stt_check" class="input-group">
		                      <label class="col-sm-3 control-label">Tọa độ điểm tham quan:<i style="color: red;">*</i></label>
		                    <input style="height:30px;width:150px;" class="form-control" id="lat" name="lat" value="<?php echo $row['lat'];?>" >
		                    <input style="height:30px;width:150px;" class="form-control" id="long" name="long" value="<?php echo $row['lon'];?>" onBlur="testkh()"  >
		                </div>

		                <div class="form-group">
						        <label class="col-sm-3 control-label">Chọn ảnh </label>
						        <div class="col-sm-6">
						              <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
						             <input type="hidden" name="file_anh" value="<?php echo $row['hinhanh']?>" size="100" />
						        </div>
						      </div>

						      <div class="form-group">
        							<div class="col-sm-offset-3 col-sm-9 m-t-15">
						      			<input name="update" id="update" type="submit" style="max-width: 70px;font-size: 20px;" class="btn btn-primary" value="Lưu">
						      			<a href="index.php?xem=diemthamquan"><input style="width: 80px; height: 40px" value="Hủy bỏ" name="reset" class="btn btn-danger"/></a>
						      		</div>
						      </div>
							</td>
							<td width="20%">
							<div class="col-xs-4 item-photo">
								<img src="uploads/diemthamquan/<?php echo $row['hinhanh']?>"width='500' height='350' name="hinhanh">
								<!-- <img src="<?php echo $row['hinhanh'];?>" width='500' height='350' name="hinhanh"/> -->
							</div>
							</td>
						</tr>
					</table>
					<?php }?>
			</form>
</div>
</div>
</div>
</body>
</html>     
<script type="text/javascript" src="../js/jquery-min.js"></script>      
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript">
	function testkh(){
		idquanhuyen=$("#idhuyen").val();
		lat=$("#lat").val();
		long=$("#long").val();
		$.ajax({
			type: "POST", //với servlet thì sẽ đi vào method doPost
			url: "Controller/checkpoint.php", 
			data: "idquanhuyen="+idquanhuyen+"&lat="+lat+"&long="+long+"",
			async: false,
			success: function (result) {
				$("#stt_check").html(result);
			}
		});
		}
		function gettinhtp(val) {
			$.ajax({
				type: "POST",
				url: "Controller/gethuyen.php",
				data:'tinh_id='+val,
				success: function(data){
					$("#idhuyen").html(data);
				}
			});
		}
	</script>