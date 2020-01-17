<?php
include("../Models/conn.php");
if(isset($_POST['submit']))
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
		$path="../images/image_tour/".$image_file; //set upload folder path
		if(empty($matour)||empty($tentour)||empty($giatour_nguoilon)||empty($giatour_treem)||empty($diemkhoihanh_ten)||empty($diemden_ten)||empty($songaytour)){
			$errorMsg="Vui lòng nhập dữ liệu";
		}
		else if(empty($image_file)){
			$errorMsg="Vui lòng chọn ảnh";
		} 
		else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
		{	
				if($size < 5000000) {
					move_uploaded_file($temp, $path); //move upload file temperory directory to your upload folder
				}else{
					$errorMsg="Vui lòng chọn file upload nhỏ hơn 5MB Size"; //error message file size not large than 5MB
				}
		}else{
			$errorMsg="Chỉ Upload fle có định dạng JPG , JPEG , PNG & GIF "; //error message file extension
		}
		if($matour&&$tentour&&$giatour_nguoilon&&$giatour_treem&&$diemkhoihanh_ten&&$diemden_ten&&$songaytour){
			$quser=mysqli_query($conn,"select * from `tourdulich` where matour='".$matour."'");
			if(mysqli_fetch_assoc($quser)!=""){
			   	echo "Mã tour này đã tồn tại rồi<br />";
			}else{
			 $result = mysqli_query($conn,"INSERT INTO `tourdulich`(`matour`, `tentour`, `giatour_nguoilon`, `giatour_treem`,`diemkhoihanh_ten`,`diemkhoihanh_toado`,`diemden_ten`, `diemden_toado`, `songaytour`,`diemkhoihanh_idhuyen`,`diemden_idhuyen`,`hinhanh`) VALUES ('$matour','$tentour','$giatour_nguoilon','$giatour_treem','$diemkhoihanh_ten',GeomFromText('$diemkhoihanh_toado'),'$diemden_ten',GeomFromText('$diemden_toado'),'$songaytour','$diemkhoihanh_idtinh','$diemden_idtinh','$image_file')");
			 if($result){
				echo"<script language='javascript'>alert('Thêm thành công')</script>";
				header("Location: ../View/admin_tourdulich.php");

			}else{
				echo"<script language='javascript' >alert('Không thể thêm vào cơ sở dữ liệu')</script>";
			}
		   }
		}	
	}
?>