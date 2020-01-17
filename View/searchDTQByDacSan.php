
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hiển thị tour du lịch lên bản đồ</title>
 <link rel="stylesheet" href="../leaflet/leaflet.css" />
  <link rel="stylesheet" href="../css/style.css" />
    <script src="../leaflet/leaflet.js"></script>
    <script src="../dichvuvitri/Control.Geocoder.js"></script>
  <link rel="stylesheet" href="../dichvuvitri/Control.Geocoder.css" />
 <!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
<!--   <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <div id="left2">
    <!-- <form  id="formtim" >
    <input type="text" name="txtDacsan" id="txtDacsan" placeholder="Nhập đặc sản để tìm ...">
    <input type="button" name="tim" id="tim" value="Tìm kiếm" >
     </form> -->
        <div class="container">
      <h2  style="color: #0f8ea2; padding-left: 20px">Tìm kiếm đặc sản</h2><br />
      <div class="form-group" style="width: 300px">
        <div class="input-group">
          <span class="input-group-addon" ><img src="../image/iconsearch.png" style="width: 26px; height: 24px"></span>
          <input style="height: 38px" type="text" name="txtDacsan" id="txtDacsan" placeholder="Nhập tên, mô tả đặc sản..." class="form-control" />
        </div>
      <div style="float: right; padding-top: 10px"><input type="button" name="tim" id="tim" value="Tìm kiếm" class="cssTim" ></div>
      </div>
    </div> 
    <!-- <p id="demo"> apd</p> -->
  </div>
 <div id="map2"></div>  
  <!-- <div id="right"></div> -->
<!------ajax, jquery tim kiem ten dac san ---->
<script>
  var map = new L.Map('map2');                               
         L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18
         }).addTo(map);
         map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

         var vietnam = new L.LatLng(16.01694,102.4945747); 
         map.setView(vietnam, 6);



  $(document).ready(function($){
    $('#tim').click(function(){
     var dacsan= $('#txtDacsan').val();
     // alert(dacsan);
     if(dacsan != '')
     {
       $.ajax({
        url:"../Controller/searchDTQ_Controller.php",
        method:"POST",
        data:{dacsan:dacsan},
        dataType:"JSON",
        scriptCharset: "UTF-8",
        contentType:"application/x-www-form-urlencoded; charset=UTF-8",
        success:function(vitridiemthamquan){
         //alert(vitridiemthamquan);
         // var vitridiemthamquan = JSON.parse(result);
          // how to access
         //document.getElementById("demo").innerHTML = vitridiemthamquan[1].tendiemthamquan;
     
        var icondiemthamquan = L.icon({
         iconUrl: '../image/icondiemthamquan.png',
         iconSize:     [30, 45], // size of the icon
         });
         if(vitridiemthamquan != 0){
           
            for (var i=0; i<vitridiemthamquan.length; i++) {
           //creat diem tham quan
                    var latdtq = vitridiemthamquan[i].toadodiemthamquan_lat;
                    var longdtq = vitridiemthamquan[i].toadodiemthamquan_long;
                    var popupTextdtq = "<b>" + vitridiemthamquan[i].tendiemthamquan + "</b>"+ vitridiemthamquan[i].jsondacsan;      
                    var markerLocationdtq = new L.LatLng(latdtq,longdtq);
                    var markerdtq = new L.marker(markerLocationdtq, {icon: icondiemthamquan});
                    markerdtq.addTo(map); 
                   markerdtq.bindPopup(popupTextdtq);
           } //end for

         }else{
           
           alert("Không tìm thấy điểm tham quan có đặc sản: " + dacsan);
         };
         

          } //end success
       });
      }else{
        alert("Vui lòng nhập đặc sản cần tìm kiếm.");
      };
    });
  });

</script>

</body>
</html>
