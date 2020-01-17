<?php
    
	if(isset($_POST['dacsan'])){ // Người dùng đã ấn submit
      $dacsan =  addslashes($_POST['dacsan']);
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "quanlytourdulich";

      $jsondiemthamquan = [];
      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      mysqli_set_charset($conn, 'UTF8');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      //get data tour du lich
      $sqldiemthamquan="select a.madiemthamquan, a.tendiemthamquan,X(toadodiemthamquan) as toadodiemthamquan_lat, 
       Y(toadodiemthamquan) as toadodiemthamquan_long, '' as jsondacsan 
       from diemthamquan a, dacsan b, diemthamquan_dacsan c where a.madiemthamquan=c.madiemthamquan and b.madacsan=c.madacsan 
       and b.tendacsan like '%".$dacsan."%'"; 
      $result = $conn->query($sqldiemthamquan);
      $length_dtq = 0;
      if ($result->num_rows > 0) {
          // output data of each row
          while($row= $result->fetch_assoc()) {     
         $temresultdiemthamquan[] = $row;
        }
       
       // $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
         $length_dtq = count($temresultdiemthamquan);  
      }


   if($length_dtq>0){
       //   $length_ds = count($temresultdacsan);
     for($x = 0; $x < $length_dtq; $x++) {
        $sqldacsan="select b.madiemthamquan, CONCAT(a.madacsan,'-', a.tendacsan) as jsondacsan from dacsan a, diemthamquan_dacsan b where a.madacsan=b.madacsan and b.madiemthamquan='".$temresultdiemthamquan[$x]["madiemthamquan"]."' 
           and a.tendacsan like '%".$dacsan."%'"; 
       $resultdacsan = $conn->query($sqldacsan);
       if ($resultdacsan ->num_rows > 0) {
          // output data of each row
         while($rowds = $resultdacsan->fetch_assoc()) {
         //$temresultdacsan[] = $rowds;
          $temresultdiemthamquan[$x]["jsondacsan"]=$temresultdiemthamquan[$x]["jsondacsan"]."</br>".$rowds["jsondacsan"];
         }
         $jsondiemthamquan = json_encode($temresultdiemthamquan,JSON_UNESCAPED_UNICODE);
       } 
     }  
   }
    
    if($length_dtq > 0){
       echo $jsondiemthamquan;
    }else{
         $b = array(0);
         echo json_encode($b);
    }

     //  $b = array();

   // echo "Empty array output as array: ", json_encode($b), "\n";

      
      $conn->close();

  }
	

?>