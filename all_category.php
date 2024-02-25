<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thể loại</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

       <!-- Bootstrap CSS -->
       <link rel="stylesheet" href="bootstrap-footer-02/css/bootstrap.min.css">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="bootstrap-footer-02/css/style.css">
    <link rel="stylesheet" href="bar/bar.css">
</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->




<section class="categories">

   <h1 class="heading">Bài viết về thể loại :</h1>

   <div class="box-container">
      <div class="box"><span>01</span><a href="category.php?category=Chăm sóc da">Chăm sóc da</a></div>
      <div class="box"><span>02</span><a href="category.php?category=Chăm sóc cổ">Chăm sóc cổ</a></div>
      <div class="box"><span>03</span><a href="category.php?category=Chăm sóc mắt">Chăm sóc mắt</a></div>
      <div class="box"><span>04</span><a href="category.php?category=Chăm sóc trắng da">Chăm sóc trắng da</a></div>
      <div class="box"><span>05</span><a href="category.php?category=Chăm sóc cơ thể">Chăm sóc cơ thể</a></div>
      <div class="box"><span>06</span><a href="category.php?category=Chăm sóc nếp nhăn">Chăm sóc nếp nhăn</a></div>
      <div class="box"><span>07</span><a href="category.php?category=Chống nắng">Chống nắng</a></div>
      <div class="box"><span>08</span><a href="category.php?category=Thực phẩm chức năng">Thực phẩm chức năng</a></div>
      <div class="box"><span>09</span><a href="category.php?category=Tẩy da chết">Tẩy da chết</a></div>
      <div class="box"><span>10</span><a href="category.php?category=Sữa rửa mặt">Sữa rửa mặt</a></div>
      <div class="box"><span>11</span><a href="category.php?category=Tẩy trang">Tẩy trang</a></div>
      <div class="box"><span>12</span><a href="category.php?category=Dầu gội">Dầu gội</a></div>
      <div class="box"><span>13</span><a href="category.php?category=Dầu xả">Dầu xả</a></div>
      <div class="box"><span>14</span><a href="category.php?category=Kem dưỡng da">Kem dưỡng da</a></div>
      <div class="box"><span>15</span><a href="category.php?category=Lotion">Lotion</a></div>
      <div class="box"><span>16</span><a href="category.php?category=Toner">Toner</a></div>
      <div class="box"><span>16</span><a href="category.php?category=Xịt khoáng">Xịt khoáng</a></div>
      <div class="box"><span>17</span><a href="category.php?category=Trang điểm mặt">Trang điểm mặt</a></div>
      <div class="box"><span>18</span><a href="category.php?category=Trang điểm mắt">Trang điểm mắt</a></div>
      <div class="box"><span>19</span><a href="category.php?category=Trang điểm môi">Trang điểm môi</a></div>
      <div class="box"><span>20</span><a href="category.php?category=Mặt nạ">Mặt nạ</a></div>
   </div>

</section>








<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
<?php include 'components/footer.php'?>
</html>