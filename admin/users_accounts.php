<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if (isset($_POST['delete'])) {
   // Kiểm tra xem user_id có được gửi từ form không
   if (isset($_POST['user_id'])) {
      $user_id = $_POST['user_id'];

      // Thực hiện các thao tác xóa dữ liệu
      $delete_image = $conn->prepare("SELECT * FROM `posts` WHERE user_id = ?");
      $delete_image->execute([$user_id]);
      while ($fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC)) {
         unlink('../uploaded_img/' . $fetch_delete_image['image']);
      }
      $delete_posts = $conn->prepare("DELETE FROM `posts` WHERE user_id = ?");
      $delete_posts->execute([$user_id]);
      $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE user_id = ?");
      $delete_likes->execute([$user_id]);
      $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE user_id = ?");
      $delete_comments->execute([$user_id]);
      $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
      $delete_admin->execute([$user_id]);

      header('location:../components/admin_logout.php');
   } else {
      // Xử lý lỗi nếu user_id không được gửi từ form
      echo 'Không có ID người dùng.';
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tài khoàn người dùng</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- users accounts section starts  -->

<section class="accounts">

   <h1 class="heading">Tài khoản người dùng</h1>

   <div class="box-container">

   <?php
      $select_account = $conn->prepare("SELECT * FROM `users`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 
            $user_id = $fetch_accounts['id']; 
            $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
            $count_user_comments->execute([$user_id]);
            $total_user_comments = $count_user_comments->rowCount();
            $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
            $count_user_likes->execute([$user_id]);
            $total_user_likes = $count_user_likes->rowCount();
   ?>
   <div class="box">
      <p> users id : <span><?= $user_id; ?></span> </p>
      <p> username : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p> Tổng số bình luận : <span><?= $total_user_comments; ?></span> </p>
      <p> Tổng số likes : <span><?= $total_user_likes; ?></span> </p>
      <div class="flex-btn">
         <?php
            if($fetch_accounts['id'] == $user_id){
         ?>
            <a href="update_profile.php" class="option-btn" style="margin-bottom: .5rem;">update</a>
            <form action="" method="POST">
               <input type="hidden" name="user_id" value="<?= $fetch_accounts['id']; ?>" on>
               <button type="submit" name="delete"onclick="return confirm('Xóa tài khoản này?');" class="delete-btn" style="margin-bottom: .5rem;">Xóa</button>
            </form>
         <?php
            }
         ?>
      </div>
      <form action="add_quyen.php" method="post">
         <input type="hidden" name="abc" value="<?= $fetch_accounts['id']; ?>" on>
         <button type="submit" value="Chuyển đổi" class="btn btn-primary">Chuyển đổi</button>
      </form>

   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Không có tài khoản</p>';
   }
   ?>

   </div>

</section>

<!-- users accounts section ends -->






<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>