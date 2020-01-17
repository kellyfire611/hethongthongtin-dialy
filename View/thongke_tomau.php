<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="../js/Chart.min.js"></script>
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <link rel="stylesheet" href="../leaflet/leaflet.css" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/stylepopup.css" />
  <script src="../leaflet/leaflet.js"></script>
</head>
<body onLoad="javascript:initMap();">

  <div id="left2">
  
 <!--      <div class="container"> -->
 </br>

      <canvas id="myChart" width="800" height="1000" ></canvas>
<!-- <canvas id="myChart" width="400" height="400"></canvas>  -->
  <!-- </div> -->
  </div>
 
  <div id="map2" ></div>
   
   <!-- hiển thị thống kê -->
  <script>
    let myChart = document.getElementById('myChart').getContext('2d');
    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url =  "../Controller/thongke_tomau_Controller.php";
    var asynchronous = true;
    ajax.open(method, url, asynchronous);
    ajax.send();
    ajax.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        var data = JSON.parse(this.responseText);
        var xephangtinh = [];
        var soluongdiem = [];
        // var endstring = "";
        for (i = 0; i < data.length; i++) {
          xephangtinh.push(data[i].tentinhtp);
          soluongdiem.push(data[i].soluongdiem);
        };
      };
    // Chart.defaults.global.defaultFontFamily = 'Lato';
    // Chart.defaults.global.defaultFontSize = 15;
    // Chart.defaults.global.defaultFontColor = '#777';
    let massPopChart = new Chart(myChart, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:xephangtinh,
        datasets:[{
          label:'Số điểm tham quan',
          data:soluongdiem,
          backgroundColor:['#FF00BF','#0101DF','#FFBF00','#FA5858','#088A08'],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
        }]
      },
      options:{
        title:{
          display:true,
          text:'Top 5 Tỉnh có nhiều điểm tham quan',
          fontSize:20,
          fontColor:'#0f8ea2'
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#0f8ea2'
          }
        },
        layout:{padding:{left:0,right:0,bottom:0,top:0}
        },
        tooltips:{
          enabled:true
        },
         
         scales: {
           yAxes: [{
           barPercentage: 0.5,
           gridLines: {
           display: false
           },
          ticks: {
            min: 0,
            max: 30,
            stepSize: 2
          },
         }],
        },

      }//end option
    });
    };
  </script>

  <!-- tô màu top 5 tỉnh lên bản đồ -->
  <script type="text/javascript">
    var map;
    var mapOptions;
    var layer;
    function initMap() {
      mapOptions = {  center: [16.0679814, 108.2119396],zoom: 5.5};
      map = new L.map('map2', mapOptions);
      layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
      map.addLayer(layer);
      var ajax = new XMLHttpRequest();
      var method = "GET";
      var url =  "../Controller/thongke_tomau_Controller.php";
      var asynchronous = true;
      ajax.open(method, url, asynchronous);
      ajax.send();
      ajax.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          var data = JSON.parse(this.responseText);
          var color = ['#FF00BF','#0101DF','#FFBF00','#FA5858','#088A08']
          var number = 0;
          for (i = 0; i < data.length; i++) {
            var ajax = new XMLHttpRequest();
            var method = "GET";
            var url =  "../Controller/polygontinhtp_Controller.php?idtinhtp="+data[i].idtinhtp;
            var asynchronous = true;
            ajax.open(method, url, asynchronous);
            ajax.send();
            ajax.onreadystatechange = function(){
              if(this.readyState == 4 && this.status == 200){
                var data1 = JSON.parse(this.responseText);
                var test = "[[";
                var note = "]]";
                var length1 = data1.length;
              
                for (j = 0; j < length1; j++) {
                  test = test.concat("[").concat(data1[j].lat).concat(",").concat(data1[j].lon).concat("]");
                  if(j != length1 - 1){
                    test = test.concat(",");             
                  } else {
                    test = test.concat(note);
                  }
                };
                var val = JSON.parse(test);
                var stringcolor = color[number];
                number = number + 1;
                // console.log(stringcolor);
                var geojsonFeature = {
                     "type":"FeatureCollection","features":[{"type":"Feature","properties":{"color": "#2EFE2E"},
                    "geometry":{"type":"Polygon","coordinates":val}}]};
                  var myStyle = {
                  "color": stringcolor,
                  "weight": 5,
                  "opacity": 0.65
                  };  
              L.geoJSON(geojsonFeature, {style: myStyle}).addTo(map);
            };
            }
          };
        };
      }
    };
  </script>
</body>
</html>
