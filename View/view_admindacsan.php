<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Tour du lịch</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

  

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

     

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php">Trang chủ</a></li>
   <!--         <li><a href="../tourdulich/View/searchTourDuLich.php">Tìm Tour du lịch</a></li>
           <li><a href="../tourdulich/View/searchDTQByDacSan.php">Tìm Đặc sản</a></li> -->
            <li><a href="index.php?xem=thongke">Thống kê</a></li>
          <li class="menu-has-children"><a href="">Quản lý</a>
            <ul>
              <li><a href="index.php?xem=dacsan">Đặc sản</a></li>
              <li><a href="index.php?xem=diemthamquan">Điểm tham quan</a></li>
              <li><a href="index.php?xem=tourdulich">Tour du lịch</a></li>
             
            </ul>
          </li>
        
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro">

    <div class="intro-content">
      <h2 style="color: #fff">QUẢN LÝ TOUR DU LỊCH</h2>
      
    </div>

    <div id="intro-carousel" class="owl-carousel" >
    <div class="item" style="background-image: url('img/intro-carousel/phuquoc2.jpg');"></div>
    <div class="item" style="background-image: url('img/intro-carousel/hoadai1.jpg');"></div>
    <div class="item" style="background-image: url('img/intro-carousel/sapa1.jpg');"></div>
    <div class="item" style="background-image: url('img/intro-carousel/phuquoc1.jpg');"></div>
 
      <!-- <div class="item" style="background-image: url('img/intro-carousel/mientay1.jpg');"></div> -->
      <!-- <div class="item" style="background-image: url('img/intro-carousel/5.jpg');"></div> -->
    </div>

  </section><!-- #intro -->

  <main id="main">
<?php
include('Controller/conn.php');
?>

 <form action="admin_dacsan.php" method="post">
               <table class="table table-bordered">
                        <tr>
                          <td colspan='7' align="center"><h4> <strong><font color="#006600" simadacsanze='5'>QUẢN LÝ ĐẶC SẢN</font></strong></h4></td>
                        </tr>
                        <tr>
                          <td colspan='7' align="right"><a href="index.php?xem=add_dacsan"><b>Thêm</b></a></td>
                        </tr>
                        <tr>
                           <th>STT</th>
                            <!-- <th>Hình ảnh</th> -->
                            <th>Mã đặc sản </th>
                            <th>Tên đặc sản </th>
                            <th>Mô tả </th>
                             <th colspan="2"> </td>
                          </tr>
                          
                          <?php
              $stt=0;
              $quser=mysqli_query($conn,"select * from `dacsan`");
              while($row=mysqli_fetch_array($quser))
                {
                $stt++;
                echo"<tr>";
                echo "<td class='nd'>".$stt."</td>";
                // echo "<td class='nd'><img src=uploads/".$row['hinhanh']." width='70' height='50' /></td>";
                echo "<td class='nd'>".$row['madacsan']."</td>";
                echo "<td class='nd'>".$row['tendacsan']."</td>";
                echo "<td class='nd'>".$row['mota']."</td>";                              
                echo "<td class='nd'><a href='index.php?xem=edit_dacsan&ma=$row[madacsan]'><img src='image/edit.png' width='30px' height='30px'/></a> </td>";
                echo "<td class='nd'><a href='index.php?xem=del_dacsan?id=$row[madacsan]'><img src='image/delete.png'width='30px' height='30px'/></a> </td>";
                  echo "</tr>";               
                 
                }
                
                    ?>
                            
                        </table>
                    
</form>
    

      

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong> Lê Thị Hồng Chiêu </strong></br>
                           <strong>Phan Thị Thúy Kiều</strong><br>
                             <strong>Nguyễn Hoàng Thái</strong>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
