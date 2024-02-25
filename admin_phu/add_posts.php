<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['publish'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'active';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]);

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'image name repeated!';
      }elseif($image_size > 2000000){
         $message[] = 'Kích thước ảnh quá lớn!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 AND $image != ''){
      $message[] = 'Tên ảnh quá dài!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = 'Đăng bài thành công!';
   }
   
}

if(isset($_POST['draft'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'deactive';
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
   $select_image->execute([$image, $admin_id]); 

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'Tên ảnh đã tồn tại!';
      }elseif($image_size > 2000000){
         $message[] = 'Kích thước ảnh quá lớn!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_image->rowCount() > 0 AND $image != ''){
      $message[] = 'Mời đổi tên ảnh!';
   }else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES(?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
      $message[] = 'Đã lưu bản nháp!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>posts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body style="padding-left: 0 !important;">


<!-- <?php include '../components/admin_header.php' ?> -->

<section class="post-editor">

   <h1 class="heading">Thêm bài viết mới</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <p>Tiêu đề bài viết <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="Thêm tiêu đề" class="box">
      <p>Nhập mô tả <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000" placeholder="Viết mô tả" cols="30" rows="10"></textarea>
      <p>Danh mục <span>*</span></p>
      <select name="category" class="box" required>
      <option value="" selected disabled>--Chọn danh mục sản phẩm-- </option>
         <option value="Chăm sóc da">Chăm sóc da</option>
         <option value="Chăm sóc cổ">Chăm sóc cổ</option>
         <option value="Chăm sóc mắt">Chăm sóc mắt</option>
         <option value="Chăm sóc trắng da">Chăm sóc trắng da</option>
         <option value="Chăm sóc cơ thể">Chăm sóc cơ thể</option>
         <option value="Chăm sóc nếp nhăn">Chăm sóc nếp nhăn</option>
         <option value="Chống nắng">Chống nắng</option>
         <option value="Thực phẩm chức năng">Thực phẩm chức năng</option>
         <option value="Tẩy da chết">Tẩy da chết</option>
         <option value="Sữa rửa mặt">Sữa rửa mặt</option>
         <option value="Tẩy trang">Tẩy trang</option>
         <option value="Dầu gội">Dầu gội</option>
         <option value="Dầu xả">Dầu xả</option>
         <option value="Kem dưỡng da">Kem dưỡng da</option>
         <option value="Lotion">Lotion</option>
         <option value="Toner">Toner</option>
         <option value="Xịt khoáng">Xịt khoáng</option>
         <option value="Trang điểm mặt">Trang điểm mặt</option>
         <option value="Trang điểm mắt">Trang điểm mắt</option>
         <option value="Trang điểm môi">Trang điểm môi</option>
         <option value="Mặt nạ">Mặt nạ</option>
      </select>
      <p>Thêm hình ảnh</p>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Đăng bài" name="publish" class="btn">
         <input type="submit" value="Lưu bản nháp" name="draft" class="btn">
         <!-- <button class="btn" href="dashboard.php">Quay lại</button> -->
         <a class="btn" href="dashboard.php">Quay lại quản lý</a>

      </div>
   </form>

</section>




<style>

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #FF9800;
    color: #fff;
    cursor: pointer;
}

.btn:hover {
    background-color: #B6C4B6;
    color: #000;
}

</style>





<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>