
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    
<!--     <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
 -->
    <style>
            tr:hover{background-color:#F2F2F2;;cursor: pointer}
            .selected{background-color: red;color: #fff;font-weight: bold}
      </style>
</head>
<body>

  <div id="left2">
     <div class="container">
      <h2 align="left" style="color: #0f8ea2">Tìm kiếm tour du lịch</h2><br />
      <div class="form-group" style="width: 300px">
        <div class="input-group">
          <span class="input-group-addon"><img src="../image/iconsearch.png" style="width: 26px; height: 24px"></span>
          <input type="text" style="height: 38px" name="txtTourDuLich" id="txtTourDuLich" placeholder="Nhập thông tin cần tìm..." class="form-control" />
        </div>
      </div>
      <br />
      <div id="result"></div>
    </div>
<!--     <div style="clear:both"></div> -->
   <div id="chuthich" style="padding-left: 10px; padding-bottom: 0px; background-color: #CEECF5">
    <span style="color:#6E6E6E; font-weight: bold;">Điểm khởi hành </span> <img src="../image/icondiemkhoihanh.png" style="width: 25px; height: 33px"></br>
    <span style="color:#6E6E6E; font-weight: bold;">Điểm đến  </span> <img src="../image/icondiemden.png" style="width: 25px; height: 33px"></br>
    <span style="color:#6E6E6E; font-weight: bold;"> Điểm tham quan  </span>  <img src="../image/icondiemthamquan.png" style="width: 25px; height: 33px"></br>
   </div>
  </div>

  <div id="map2"></div>   
 <!--  <div id="right"></div> -->
<script>
$(document).ready(function(){
  load_data();
  function load_data(query)
  {
    $.ajax({
      url:"../Controller/searchTourDuLich_Controller.php",
      method:"post",
      data:{query:query},
      success:function(data)
      {
        $('#result').html(data);
      }
    });
  }
  
  $('#txtTourDuLich').keyup(function(){
    var search = $(this).val();
    if(search != '')
    {
      load_data(search);
    }
    else
    {
      load_data();      
    }
  });
});

</script>

  
<?php
     
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "quanlytourdulich";

      $jsontourdulich = [];
      $jsondiemthamquan = [];
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      mysqli_set_charset($conn, 'UTF8');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      //get tour theo mã tour, điểm tham quan theo mã tour
    if(isset($_GET['matour'])){ 
       $matour =  addslashes($_GET['matour']);
      //get data tour du lich
      $sqltourdulich="select diemkhoihanh_ten, X(diemkhoihanh_toado) as diemkhoihanh_toado_lat, Y(diemkhoihanh_toado) as diemkhoihanh_toado_long, diemden_ten, X(diemden_toado) as diemden_toado_lat, Y(diemden_toado) as diemden_toado_long
      from tourdulich
      where matour='".$matour."'"; 
      $result = $conn->query($sqltourdulich);
      if ($result->num_rows > 0) {
          // output data of each row
          while($row= $result->fetch_assoc()) {     
         $tem[] = $row;
        }

        $jsontourdulich = json_encode($tem,JSON_UNESCAPED_UNICODE);
      } 
      
     //get data diem tham quan
      $sqldiemthamquan="select a.madiemthamquan, tendiemthamquan,X(toadodiemthamquan) as toadodiemthamquan_lat, Y(toadodiemthamquan) as toadodiemthamquan_long, a.hinhanh, '' as jsondacsan
      from diemthamquan a, tourdulich_diemthamquan b
      where a.madiemthamquan=b.madiemthamquan
      and b.matour='".$matour."'"; 

      $resultdiemthamquan = $conn->query($sqldiemthamquan);
      $length_dtq=0;
      if ($resultdiemthamquan ->num_rows > 0) {
          // output data of each row
          while($rowdtq= $resultdiemthamquan->fetch_assoc()) {
          $temresultdiemthamquan[] = $rowdtq;
        }
       // $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
        $length_dtq=count($temresultdiemthamquan);  
      }

     
  //   $length_ds = count($temresultdacsan);
    if($length_dtq>0){
      for($x = 0; $x < $length_dtq; $x++) {
        $sqldacsan="select b.madiemthamquan, CONCAT(a.madacsan,'-', a.tendacsan) as jsondacsan from dacsan a, diemthamquan_dacsan b where a.madacsan=b.madacsan and b.madiemthamquan='".$temresultdiemthamquan[$x]["madiemthamquan"]."'"; 
       $resultdacsan = $conn->query($sqldacsan);
       if ($resultdacsan ->num_rows > 0) {
          // output data of each row
         while($rowds = $resultdacsan->fetch_assoc()) {
         //$temresultdacsan[] = $rowds;
          $temresultdiemthamquan[$x]["jsondacsan"]=$temresultdiemthamquan[$x]["jsondacsan"]."</br>".$rowds["jsondacsan"];
        }
       // $jsondacsan = json_encode($temresultdacsan,JSON_UNESCAPED_UNICODE);
         $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
       } 
     }  
    }
     
    // echo "abc". $jsondiemthamquan;

   //  $b = array();

   // echo "Empty array output as array: ", json_encode($b), "\n";
  // echo $length_dtq;

   // $check=[];
   // if($length_dtq == 0){
   //     $check=json_encode(array(0));
   //  }

  

  }else{ //hiển thị mặc định là tất cả điểm khởi hành, điểm đến, điểm tham quan
     //get data tour du lich
      $sqltourdulich="select diemkhoihanh_ten, X(diemkhoihanh_toado) as diemkhoihanh_toado_lat, Y(diemkhoihanh_toado) as diemkhoihanh_toado_long, diemden_ten, X(diemden_toado) as diemden_toado_lat, Y(diemden_toado) as diemden_toado_long
      from tourdulich"; 
      $result = $conn->query($sqltourdulich);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row= $result->fetch_assoc()) {     
         $tem[] = $row;
        }

        $jsontourdulich = json_encode($tem,JSON_UNESCAPED_UNICODE);
      } 
      
     //get data diem tham quan
      $sqldiemthamquan="select madiemthamquan, tendiemthamquan,X(toadodiemthamquan) as toadodiemthamquan_lat, Y(toadodiemthamquan) as toadodiemthamquan_long, hinhanh, '' as jsondacsan
      from diemthamquan"; 
      $resultdiemthamquan = $conn->query($sqldiemthamquan);

      if ($resultdiemthamquan ->num_rows > 0) {
          // output data of each row
          while($rowdtq= $resultdiemthamquan->fetch_assoc()) {
          $temresultdiemthamquan[] = $rowdtq;
        }
       // $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
      }


     $length_dtq = count($temresultdiemthamquan);  
  //   $length_ds = count($temresultdacsan);
     for($x = 0; $x < $length_dtq; $x++) {
        $sqldacsan="select b.madiemthamquan, CONCAT(a.madacsan,'-', a.tendacsan) as jsondacsan from dacsan a, diemthamquan_dacsan b where a.madacsan=b.madacsan and b.madiemthamquan='".$temresultdiemthamquan[$x]["madiemthamquan"]."'"; 
       $resultdacsan = $conn->query($sqldacsan);
       if ($resultdacsan ->num_rows > 0) {
          // output data of each row
         while($rowds = $resultdacsan->fetch_assoc()) {
         //$temresultdacsan[] = $rowds;
          $temresultdiemthamquan[$x]["jsondacsan"]=$temresultdiemthamquan[$x]["jsondacsan"]."</br>".$rowds["jsondacsan"];
        }
       // $jsondacsan = json_encode($temresultdacsan,JSON_UNESCAPED_UNICODE);
       } 
     }  

   $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
  }
 // echo $jsondiemthamquan;

  $conn->close();
?>

<!-- //khởi tạo bản đồ -->
<script type="text/javascript">
var map = new L.Map('map2');                               
         L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
            maxZoom: 18
         }).addTo(map);
         map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

         var vietnam = new L.LatLng(16.01694,102.4945747); 
         map.setView(vietnam, 6);
    
        var icondiemden = L.icon({
        iconUrl: '../image/icondiemden.png',
         iconSize:     [30, 45], // size of the icon
       });

        var icondiemkhoihanh = L.icon({
        iconUrl: '../image/icondiemkhoihanh.png',
         iconSize:     [30, 45], // size of the icon
       });

        
        var icondiemthamquan = L.icon({
        iconUrl: '../image/icondiemthamquan.png',
         iconSize:     [30, 45], // size of the icon
       });

  </script>

  <script type="text/javascript">
     //hiển thị marker tour du lịch -->
        //không cần check tour du lịch vì tour du lịch được chọn từ danh sách tìm kiếm nên luôn tồn tại
         var vitri = <?php echo $jsontourdulich ?>;
         //chạy qua mảng vitri
         for (var i=0; i<vitri.length; i++) {
          //create marker diem den
            var latdd = vitri[i].diemden_toado_lat;
            var longdd = vitri[i].diemden_toado_long;
            var popupTextdd = vitri[i].diemden_ten;         
            var markerLocationdd = new L.LatLng(latdd,longdd);
            var markerdd = new L.marker(markerLocationdd, {icon: icondiemden});
           
        //    var marker = new L.Marker(markerLocation);
           // map.addLayer(marker);
       //hoặc
            markerdd.addTo(map); 
            markerdd.bindPopup(popupTextdd);


          //create marker diem khoi hanh
           var latkh = vitri[i].diemkhoihanh_toado_lat;
            var longkh = vitri[i].diemkhoihanh_toado_long;
            var popupTextkh = vitri[i].diemkhoihanh_ten;         
            var markerLocationkh = new L.LatLng(latkh,longkh);
            var markerkh = new L.marker(markerLocationkh, {icon: icondiemkhoihanh});
            markerkh.addTo(map); 
            markerkh.bindPopup(popupTextkh);


     //    L.Routing.control({
     //    waypoints: [
     //    L.latLng(latkh, longkh),
     //    L.latLng(latdd, longdd)
     //     ],
     //  routeWhileDragging: true
     // }).addTo(map);
         }
  </script>

  <script type="text/javascript">
         // hiển thị marker điểm tham quan -->
          var vitridiemthamquan = <?php echo $jsondiemthamquan ?>;
          for (var i=0; i<vitridiemthamquan.length; i++) {
           //creat diem tham quan
                    var latdtq = vitridiemthamquan[i].toadodiemthamquan_lat;
                    var longdtq = vitridiemthamquan[i].toadodiemthamquan_long;
                  var popupTextdtq = "<img src='../uploads/diemthamquan/"+vitridiemthamquan[i].hinhanh+"' width='350px' height='250px'/> "+ "</br> <b>" + vitridiemthamquan[i].tendiemthamquan + "</b>"+ vitridiemthamquan[i].jsondacsan;         
                    var markerLocationdtq = new L.LatLng(latdtq,longdtq);
                    var markerdtq = new L.marker(markerLocationdtq, {icon: icondiemthamquan});

                  //    var customPopup = "<img src='../tourdulich/uploads/diemthamquan/"+vitridiemthamquan[i].hinhanh+"' width='350px' height='250px'/> </br> <span style='font-weight:bold; font-size:15px; color:blue'>" + vitridiemthamquan[i].tendiemthamquan + "</span> " + vitridiemthamquan[i].jsondacsan ;
                     var customOptions ={
                        'maxWidth': '600',
                       
                  // 'className' : 'custom' //class 'custom' nay duoc dinh nghia trong file .css
                       }
                    markerdtq.addTo(map); 
                  markerdtq.bindPopup(popupTextdtq, customOptions);
                    // marker.bindPopup(customPopup, customOptions);
          }
          

  </script>

</body>
</html>
