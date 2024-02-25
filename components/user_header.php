<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <img src="img/logo.png" width="150" height="70" alt="Trang Review Mỹ Phẩm N2" href="home.php">

      <form action="search.php" method="POST" class="search-form">
         <input type="text" name="search_box" class="box" maxlength="100" placeholder="Tìm kiếm" required>
         <button type="submit" class="fas fa-search" name="search_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <nav class="navbar">
         <a href="home.php"> <i class="fas fa-angle-right"></i>Trang Chủ</a>
         <a href="posts.php"> <i class="fas fa-angle-right"></i>Bài Đăng</a>
         <a href="all_category.php"> <i class="fas fa-angle-right"></i>Danh mục</a>
         <a href="authors.php"> <i class="fas fa-angle-right"></i>Tác Giả</a>
         <!-- <a href="login.php"> <i class="fas fa-angle-right"></i> Đăng nhập</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> Đăng Ký</a> -->
      </nav>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <a href="update.php" class="btn">Cập nhập tài khoản</a>
         <div class="flex-btn">
            <!-- <a href="update.php" class="option-btn">Cập nhập tài khoản</a> -->
            <a href="login.php" class="option-btn">Đăng nhập</a>
            <a href="register.php" class="option-btn">Đăng ký</a>
         </div> 
         <a href="components/user_logout.php" onclick="return confirm('Bạn muốn đăng xuất?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
            <p class="name">Xin mời đăng nhập !</p>
            <a href="login.php" class="option-btn">Đăng nhập</a>
         <?php
            }
         ?>
      </div>

   </section>
<style>
.option-btn {
  width: 140px;
  height: 40px;
  font-size: 13px;
}

.btn {
  width: 265px;
  height: 40px;
  color: #ffff;
  font-size: 18px;
  background-color: #FB8B24;
}

.header {
  background-color: #7003BB;
}

</style>
</header>