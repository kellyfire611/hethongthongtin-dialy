
<?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "", "quanlytourdulich");
  mysqli_set_charset($conn, 'UTF8');
  $query ="SELECT * FROM tinhthanh";
  $runQuery = $conn->query($query);
  while($row=mysqli_fetch_assoc($runQuery)) {
    $results[] = $row;
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý đặc sản </title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
	function gettinhtp(val) {
	$.ajax({
	type: "POST",
	url: "gethuyen.php",
	data:'tinh_id='+val,
	success: function(data){
		$("#huyen").html(data);
		getCity();
	}
	});
}
</script>
</head>

<body>
<div class="wrapper">
  <div class="container">
    <div class="col-lg-12">
       <h4 align="center"><font color="#006600" size="5">THÊM ĐIỂM THAM QUAN </font></h4>
<form name="themdtq" id="themdtq" action="Controller/add_dtq_controller.php" method='POST' enctype="multipart/form-data" class="form-horizontal" >
  <table width="100%">
      <tr>
        <td>
           <div class="form-group">
           <label class="col-sm-3 control-label">Mã điểm tham quan: <i style="color: red;">*</i></label>
           <div class="col-sm-6">
               <input type="text" value="" name='madiemthamquan' required class="form-control"  placeholder="Nhập mã điểm tham quan"  />
           </div>
        </div>
         <div class="form-group">
           <label class="col-sm-3 control-label">Tên điểm tham quan: <i style="color: red;">*</i></label>
           <div class="col-sm-6">
               <input type="text" value="" name="tendiemthamquan"  required class="form-control"  placeholder="Nhập mã điểm tham quan"  />
           </div>
        </div>

      <div class="form-group">
        <label class="col-sm-3 control-label">Hình điểm tham quan: <i style="color: red;">*</i></label>
        <div class="col-sm-6">
              <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
        </div>
      </div>

      <div class="form-group" style="margin-left:10px">
           <label class="col-sm-3 control-label"> Thuộc tỉnh: <i style="color: red;">*</i></label>
        <div class="form-group col-sm-4">        
            <select  name="diemden_idtinh" id="tinhtp" onChange="gettinhtp(this.value);" class="form-control" style="height:35px">
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
            <select id="huyen" name="huyen" class="form-control" style="height:35px">
              <option>--Quận/huyện----</option>
            </select>
      </div>
    </div>
      <div id="stt_check" class="form-group">
         <label class="col-sm-3 control-label">Tọa độ: <i style="color: red;">*</i></label>
         <div class="col-sm-4"><b> X:</b><input type="text" id="lat" class="form-control" id="lat" name="lat" placeholder="Nhập giá trị Lat" required /> </div>
           <div class="col-sm-4"> <b>Y:</b> <input type="text" id="long" class="form-control" id="long" name="long" onBlur="testkh()" placeholder="Nhập giá trị Long" required /> </div>
        <!--   <span id="stt_check"></span>  -->
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9 m-t-15">
            <input type="submit" name="them" value="Lưu"  class="btn btn-success "/>
              <input type="reset" name="reset" value="Hủy bỏ" class="btn btn-danger"/>

              <!-- <input name="them" id="them" type="submit" style="max-width: 70px;font-size: 20px;" class="btn btn-primary" value="Lưu">
              <a href="index.php?xem=diemthamquan"><input style="width: 80px; height: 40px" value="Hủy bỏ" name="reset" class="btn btn-danger"/></a> -->
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
  <script type="text/javascript">
  function testkh(){
    idquanhuyen=$("#huyen").val();
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
    $("#huyen").html(data);
    }
  });
  }
  function lock(){
      alert('Điểm tham quan đã bị khóa do đã nằm trong tour du lịch');
  }
  </script>
</html>