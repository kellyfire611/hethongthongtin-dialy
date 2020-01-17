<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "", "quanlytourdulich");
    mysqli_set_charset($conn, 'UTF8'); 
    ini_set('max_execution_time', 3000);
    class pointLocation {
      var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?
      function pointLocation() {
      }
      function pointInPolygon($point, $polygon, $pointOnVertex = true) {
        $this->pointOnVertex = $pointOnVertex;
        // Transform string coordinates into arrays with x and y values
        $point = $this->pointStringToCoordinates($point);
        $vertices = array(); 
        foreach ($polygon as $vertex) {
            $vertices[] = $this->pointStringToCoordinates($vertex); 
        }
        // Check if the point sits exactly on a vertex
        if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
            return "vertex";
        }
        // Check if the point is inside the polygon or on the boundary
        $intersections = 0; 
        $vertices_count = count($vertices);
        for ($i=1; $i < $vertices_count; $i++) {
            $vertex1 = $vertices[$i-1]; 
            $vertex2 = $vertices[$i];
            if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                return "boundary";
            }
            if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                    return "boundary";
                }
                if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                    $intersections++; 
                }
            } 
        } 
        // If the number of edges we passed through is odd, then it's in the polygon. 
      if ($intersections % 2 != 0) {
          return "inside";
      } else {
          return "outside";
      }
      }
      function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
      }
   
      function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
      }
    }
    // Khởi tạo hàm kiểm tra
    $pointLocation = new pointLocation();
    // Get data input from Form
    $postlat=addslashes($_POST['lat']);
    $postlong=addslashes($_POST['long']);
    $idquanhuyen=addslashes($_POST['idquanhuyen']);
    // Set value for point
    $points = array("$postlong $postlat");
    // Get polygon of shapied quan huyen
    $getshapeid = "SELECT shapeid FROM shapeidquanhuyen WHERE idquanhuyen = $idquanhuyen";
    $shapied = mysqli_query($conn, $getshapeid);
    $polygon =[];
    foreach ($shapied as $valueshapeid) {
        $polygonquanhuyen = "SELECT X(pointquanhuyen) as lat, Y(pointquanhuyen) as lon FROM polygonquanhuyen WHERE shapeid = ".$valueshapeid['shapeid']."";
        $result = mysqli_query($conn, $polygonquanhuyen);
        foreach ($result as $column) {
                array_push($polygon,$column['lat'] ." ". $column['lon']);
        }
    }
    // The last point's coordinates must be the same as the first one's, to "close the loop"
    // Check localtion between point an polygon
    foreach($points as $key => $point) {
      $ketqua = $pointLocation->pointInPolygon($point, $polygon);
      switch ($ketqua) {
        case 'vertex':
            echo "<span style='color: green;font-size: 18px;'> Hợp lệ! Đây là đỉnh</span>";
            break;
        case 'boundary':
            echo "<span style='color: green;font-size: 18px;'> Hợp lệ! Điểm nằm trên đường biên</span>";
            break;
        case 'inside':
            echo "<span style='color: green;font-size: 18px;'> Hợp lệ! Điểm nằm trong polygon</span>";
            break;
        case 'outside':
            echo "<span style='color: red;font-size: 18px;'> Không hợp lệ! Điểm không nằm trong polygon</span>";
        break;    
      }
    }
?>