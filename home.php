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
   <title>Trang Chủ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

       <!-- Required meta tags -->
       <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-footer-02/css/bootstrap.min.css">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="bootstrap-footer-02/css/style.css">
    <link rel="stylesheet" href="bar/bar.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>



<section class="home-grid">

   <div class="box-container">

      <div class="box">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
               $count_user_comments->execute([$user_id]);
               $total_user_comments = $count_user_comments->rowCount();
               $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
               $count_user_likes->execute([$user_id]);
               $total_user_likes = $count_user_likes->rowCount();
         ?>
         <p> Xin chào <span><?= $fetch_profile['name']; ?></span></p>
         <p>Tổng số comments : <span><?= $total_user_comments; ?></span></p>
         <p>Bài viết được thích : <span><?= $total_user_likes; ?></span></p>
         <!-- <a href="update.php" class="btn">update profile</a> -->

         <div class="flex-btn">
                    <?php if ($user_id) { ?>
                    <a href="/N2/admin_phu/add_posts.php" class="option-btn">Đăng bài</a>
                <?php } else { ?>
                    <a href="/N2/admin_phu/admin_login.php" class="option-btn">Đăng bài</a>
                <?php } ?>
            <!-- <a href="/N2/admin_phu/admin_login.php" class="option-btn">Đăng bài</a> -->
            <a href="nap_tien.php" class="option-btn">Nạp tiền</a>
            <a href="user_likes.php" class="option-btn">likes</a>
            <a href="user_comments.php" class="option-btn">comments</a>
         </div>
         <?php
            }
            else{
         ?>
            <p class="name">Đăng nhập hoặc đăng kí !</p>
            <div class="flex-btn">
               <a href="login.php" class="option-btn">Đăng nhập</a>
               <a href="register.php" class="option-btn">Đăng kí</a>
            </div> 
         <?php 
          }  
         ?>
      </div> 

      <div class="box">
         <p>Tác giả</p>
         <div class="flex-box">
         <?php
            $select_authors = $conn->prepare("SELECT DISTINCT name FROM `admin` LIMIT 10");
            $select_authors->execute();
            if($select_authors->rowCount() > 0){
               while($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)){ 
         ?>
            <a href="author_posts.php?author=<?= $fetch_authors['name']; ?>" class="links"><?= $fetch_authors['name']; ?></a>
            <?php
            }
         }else{
            echo '<p class="empty">Chưa có bài viết nào !</p>';
         }
         ?>  
         <a href="authors.php" class="hienthitatca">Hiển thị tất cả</a>
     
         </div>
      </div>

   </div>

</section>

<!-- Slideshow container -->
<div class="slideshow-container"  >

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="bar/anh1.jpg" style="width:100%">
    <div class="text">Caption Text</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="bar/anh2.jpg" style="width:100%">
    <div class="text">Caption Two</div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="bar/anh3.jpg" style="width:100%">
    <div class="text">Caption Three</div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
<style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }
/* 
        .bg_video {
            position: relative;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center; /* Căn giữa theo chiều ngang */
            align-items: center; /* Căn giữa theo chiều dọc */
        } */

        #myVideo {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* .video_bg {
            position: relative;
            height: 0;
            overflow: hidden;
            padding-bottom: 40%; /* Tính theo tỉ lệ 16:9 */
            width: 100%;
            margin: auto;
        } */

        .content_bg {
            position: absolute;
            bottom: 29px;
            left: 20px; /* Đặt vị trí bên trái */
            color: white;
            width: calc(50% - 20px); /* Đặt chiều rộng của content_bg */
        }
        .hienthitatca {
            width: 265px;
            height: 20px;
            color: #000;
            font-size: 18px;
            /* background-color: #FB8B24; */
            text-align: bottom;
            vertical-align: top;
          }

        .content_inner {
            text-align: left;
            padding: 20px;
            line-height: 1.5;
            border-radius: 10px; /* Đường viền cong */
            margin-left: 160px;
            margin-bottom: 30px;
            font-size: 20px;
            color: white;
        }

        #myBtn {
            width: 100px;
            font-size: 18px;
            padding: 10px;
            border: none;
            background: #000;
            color: #fff;
            cursor: pointer;
        }

        #myBtn:hover {
            background: #ddd;
            color: black;
        }
    </style>
</head>
<body>
<div class="bg_video" style="width: 100%">
  <div class="video_bg">
  <video autoplay muted loop id="myVideo" object-fit="cover" width="100%" height="70%" style="margin: 0; padding: 0;">
  <source src="../N2/video/quangcao.mp4" type="video/mp4">
</video>
  </div>
  <div class="content_bg">
    <div class="content_inner">
      <h1 style="color:black">RLIXIR OIL SERUM</h1>
      <p style="color:black">Với tinh chất Pitera – được chiết xuất từ sự thủy phân hoá đậu nành và protein từ men nấm – chứa nhiều vitamin, axit amino và các axit hữu cơ khác sẽ giải quyết được tình trạng lão hóa của làn da. </p>
      <button id="myBtn" onclick="myFunction()">Pause</button>
    </div>
  </div>
</div>

    <script>
        var video = document.getElementById("myVideo");
        var btn = document.getElementById("myBtn");

        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    </script>
</body>
<section class="posts-container">

   <h1 class="heading">Bài viết gần nhất</h1>

   <div class="box-container">

      <?php
         $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 6 ");
         $select_posts->execute(['active']);
         if($select_posts->rowCount() > 0){
            while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
               
               $post_id = $fetch_posts['id'];

               $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
               $count_post_comments->execute([$post_id]);
               $total_post_comments = $count_post_comments->rowCount(); 

               $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
               $count_post_likes->execute([$post_id]);
               $total_post_likes = $count_post_likes->rowCount();

               $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
               $confirm_likes->execute([$user_id, $post_id]);
      ?>
      <form class="box" method="post" >
         <input type="hidden" name="post_id" value="<?= $post_id; ?>">
         <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
         <div class="post-admin">
            <i class="fas fa-user"></i>
            <div>
               <a href="author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a>
               <div>Đăng vào ngày <?= $fetch_posts['date']; ?>, lúc <?= $fetch_posts['time']; ?></div>
            </div>
         </div>
         
         <?php
            if($fetch_posts['image'] != ''){  
         ?>
         <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image" alt="">
         <?php
         }
         ?>
         <div class="post-title"><?= $fetch_posts['title']; ?></div>
         <div class="post-content content-150"><?= $fetch_posts['content']; ?></div>
         <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">Xem thêm</a>
         <a href="category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"> <i class="fas fa-tag"></i> <span><?= $fetch_posts['category']; ?></span></a>
         <div class="icons">
            <a href="view_post.php?post_id=<?= $post_id; ?>"><i class="fas fa-comment"></i><span>(<?= $total_post_comments; ?>)</span></a>
            <button type="submit" name="like_post"><i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>  "></i><span>(<?= $total_post_likes; ?>)</span></button>
         </div>
      
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">Chưa có bài viết nào được thêm !</p>';
      }
      ?>
   </div>

   <div class="more-btn" style="text-align: center; margin-top:1rem;">
      <a href="posts.php" class="inline-btn">Xem tất cả bài viết</a>
   </div>

</section>
<!-- <footer id="footerSection"> -->
    <!-- <div id="footerContent">
      <div id="footer_logo">
        <img src="https://review-ty.com/assets/icons/logo.svg" alt="logo">
      </div>
      <div id="social_media">
        <div><img src="	https://in.sugarcosmetics.com/desc-images/facebook.svg" alt=""></div>
        <div><svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
            <path
              d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 14H4V8l8 5 8-5v10zm-8-7L4 6h16l-8 5z">
            </path>
          </svg></div>
        <div><img src="https://in.sugarcosmetics.com/desc-images/Instagram.svg" alt=""></div>
        <div><img src="https://in.sugarcosmetics.com/desc-images/Pinterest.svg" alt=""></div>
        <div><img src="https://in.sugarcosmetics.com/desc-images/Tumblr.svg" alt=""></div>
        <div><img src="https://in.sugarcosmetics.com/desc-images/Youtube.svg" alt=""></div>
        <div>
          <svg  class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
            <path
              d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z">
            </path>
          </svg>
        </div>
      </div>
      <div id="mainContent">
        <div id="cont_left">
          <div id="sub_email">
            <h3>THEO DÕI BẢN TIN CỦA CHÚNG TÔI</h3>
            <label><input type="email" required id="subEmail" placeholder="Địa chỉ email của bạn"><span id="span">Sign
                Up</span></label>
          </div>
        </div>
        <div id="cont_right">
          <h3> TẢI ỨNG DỤNG TẠI</h3>
          <div>
            <div>
              <p>Tận hưởng trải nghiệm tốt hơn </p>
            </div>
            <div>
              <img style="height: 40px;" src="https://in.sugarcosmetics.com/playstore.png" alt="">
              <img style="height: 40px;" src="https://in.sugarcosmetics.com/apple-store.png" alt="">
            </div>
          </div>
        </div>
      </div>
    <hr> -->

    <!-- <footer class="footer-32892 pb-0">
      <div class="site-section">
        <div class="container">

          
          <div class="row">

            <div class="col-md pr-md-5 mb-4 mb-md-0">
              <h3>Về chúng tôi - Reviewty</h3>
              <p class="mb-4">
Cuối năm 2018 đầu năm 2019, tại Việt Nam vẫn chưa có ứng dụng nào chuyên về review làm đẹp, mỹ phẩm, trong khi thị trường mỹ phẩm tại Việt Nam đang trên đà phát triển và trở nên phức tạp hơn.
Reviewty cung cấp thông tin đa dạng và đáng tin cậy, livestream và các video ngắn, giới thiệu những cửa hàng và thương hiệu uy tín; từ đó giúp khách hàng có thể lựa chọn sản phẩm làm đẹp một cách thông thái hơn.</p>
              <ul class="list-unstyled quick-info mb-4">
                <li><a href="#" class="d-flex align-items-center"><span class="icon mr-3 icon-phone"></span>0984910512</a></li>
                <li><a href="#" class="d-flex align-items-center"><span class="icon mr-3 icon-envelope"></span> reviewtyinfo@gmail.com</a></li>
              </ul>

              <form action="#" class="subscribe">
                <input type="text" class="form-control" placeholder="Enter your e-mail">
                <input type="submit" class="btn btn-submit" value="Send">
              </form>
            </div>
            <div class="col-md mb-4 mb-md-0">
              <h3>THÀNH TỰU</h3>
              <ul class="list-unstyled tweets">
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div>Ra mắt từ năm 2019, Reviewty nhanh chóng có được sự đón nhận tích cực từ người tiêu dùng mỹ phẩm và nhiều influencers như Đào Bá Lộc, Võ Hà Linh, Heo Mi Nhon, ...</div>
                </li>
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div>Tập hợp nhiều chức năng, không chỉ mang tính ứng dụng cao mà còn độc đáo! Chỉ có thể tìm thấy tại Reviewty!</div>
                </li>
                <li class="d-flex">
                  <div class="mr-4"><span class="icon icon-twitter"></span></div>
                  <div>Tìm mua, Kiểm tra độ tin cậy của sản phẩm, Phân tích thành phần, Cảm nhận chân thật, Tư vấn chia sẻ, Sáng tạo video, Thực phẩm chức năng</div>
                </li>
              </ul>
            </div>


            <div class="col-md-3 mb-4 mb-md-0">
              <h3>Hình ảnh</h3>
              <div class="row gallery">
                <div class="col-6">
                  <a href="#"><img src="bootstrap-footer-02/images/img_1.jpg" alt="Image" class="img-fluid"></a>
                  <a href="#"><img src="bootstrap-footer-02/images/img_2.jpg" alt="Image" class="img-fluid"></a>
                </div>
                <div class="col-6">
                  <a href="#"><img src="bootstrap-footer-02/images/img_3.jpg" alt="Image" class="img-fluid"></a>
                  <a href="#"><img src="bootstrap-footer-02/images/img_4.jpg" alt="Image" class="img-fluid"></a>
                </div>
              </div>
            </div>
            
            <div class="col-12">
              <div class="py-5 footer-menu-wrap d-md-flex align-items-center">
                <ul class="list-unstyled footer-menu mr-auto">
                  <li><a href="#">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Our works</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Blog</a></li>
                  <li><a href="#">Contacts</a></li>
                </ul>
                <div class="site-logo-wrap ml-auto">
                  <a href="#" class="site-logo">
                    ReviewTy
                  </a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>

    
  </footer>

      
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
#footerSection{
  background-color: white;
  box-sizing: border-box;
  padding: 15px 140px;
  color: white;
  width: 100%;
  margin-top: auto;

}
#footer_logo>img{
  width: 9%;
  
  display: block;
  margin: auto;
}
#social_media{
  display: flex;
  width: 300px;
  margin: 10px auto;
  
  justify-content: space-around;
}
#social_media>div>img{
  width: 20px;
  height: 20px;
  
  display: block;


}
.MuiSvgIcon-root{
  width: 20px;
  height: 20px;
  background-color: white;
}
#mainContent{
  display: flex;
  justify-content: space-between;
  width: 95%;
  margin-top: 45px;
  
}
#cont_right{
  
  width: 410px;
}
#sub_email{
  margin-left: 20px;
}
#cont_right>div{
  display: flex;
  margin-top: 20px;
}

#cont_right>div>div{
  display: flex;
  width: 200px;
  color: #99996D;
  margin-right: -10px;
}
#sub_email>h3{
  font-family: Poppins, sans-serif;
  font-size: 14px;
}
#cont_right>h3{
  font-family: Poppins, sans-serif;
  font-size: 14px;
}
#sub_email>label{
  margin-top: 20px;
  
  font-family: Poppins, sans-serif;
  display: flex;
}
#sub_email>label>input{
  background-color: black;
  width: 300px;
  color: #6F8989;
  padding: 5px;
  border: 0px;
  border-bottom: 1px solid #6F8989;
}
#sub_email>label>span{
  font-size: 16px;
  display: flex;
  width: 80px;
  height: 40px;
  border-radius: 5px;
  justify-content: center;
  align-items: center;
  background-color: #FC2779;
}
hr{
  border: 1px solid #6F8989;
  margin-top: 40px;
  margin-bottom: 20px;
}
hr+p{
  text-align: center;
  font-size: 15px;
}

  </style>--> 

<script src="js/script.js"></script>
<script src="bar/bar.js"></script> 
<?php include 'components/footer.php' ?>
</body>
</html>