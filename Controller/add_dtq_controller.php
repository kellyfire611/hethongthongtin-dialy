<?php 
  ob_start();
  include("conn.php");
  if(isset($_POST['them'])){

    $image_file = $_FILES["fileToUpload"]["name"];
    $type   = $_FILES["fileToUpload"]["type"];  //file name "txt_file"  
    $size   = $_FILES["fileToUpload"]["size"];
    $temp   = $_FILES["fileToUpload"]["tmp_name"];
     $madiemthamquan=addslashes($_POST['madiemthamquan']);
    $tendiemthamquan=addslashes($_POST['tendiemthamquan']);
    $lat=addslashes($_POST['lat']);
    $long=addslashes($_POST['long']);
    $toadodiemthamquan = 'POINT('.$lat." ".$long.')';
    $idquanhuyen=addslashes($_POST['huyen']);

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
          move_uploaded_file($temp, "uploads/" .$image_file); //move upload file temperory directory to your upload folder
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

       if($madiemthamquan==""||$tendiemthamquan==""||$idquanhuyen==""){
             echo "<script>alert('Chưa nhập dữ liệu');</script>";
            }
            else{
            $result = mysqli_query($conn,"INSERT INTO `diemthamquan`(`madiemthamquan`, `tendiemthamquan`, `hinhanh`, `toadodiemthamquan`, `idquanhuyen`)  VALUES ('$madiemthamquan','$tendiemthamquan','$image_file',GeomFromText('$toadodiemthamquan'),'$idquanhuyen')");
            }   
            if($result){
            echo"<script language='javascript' >alert('Thêm thành công')</script>";
            echo header("Refresh:0; url=../index.php?xem=diemthamquan");
            }
            else{
            echo"<script language='javascript' >alert('Không thể thêm vào cơ sở dữ liệu')</script>";
                echo header("Refresh:0; url=../index.php?xem=diemthamquan");
            
          } 
        
      
    
  }
ob_flush()
?>  