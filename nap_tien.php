<?php

include 'components/connect.php';

session_start();



if(isset($_POST['submit'])){

  $tien = $_POST['tien'];

  if ($tien > 100) {
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
        $select_user->execute([$user_id]);
        if ($select_user->rowCount() > 0) {
            $users = $select_user->fetchAll(PDO::FETCH_ASSOC);
        foreach ($users as $user) {
            $username = $user["name"];
            $password = $user["password"];
            $tiencu = $user["tien"];
        }
         // Kiểm tra xem tài khoản đã tồn tại trong bảng admin chưa
         $check_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
         $check_admin->execute([$username]);

         if ($check_admin->rowCount() == 0) {
            // Nếu chưa có tài khoản trong bảng admin, thêm mới
            $sql = "INSERT INTO admin (name, password) VALUES ('$username', '$password')";
            $conn->query($sql);
        }
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         print_r($row);
        $tien_moi = $tiencu + $tien;
        $update_user = $conn->prepare("UPDATE `users` SET tien = ? WHERE id = ?");
         $update_user->execute([$tien_moi, $user_id]);
    
            echo "Thực hiện chuyển đổi thành công!";
        } else {
            alert ("Không tìm thấy người dùng có ID là $userId");
        }
        
        }
     else{
        $user_id = '';
     };
    

  header("Location: admin_phu/admin_login.php");
  } else {
    echo 'Số tiền phải lớn hơn 100!';
  }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="bootstrap-footer-02/css/bootstrap.min.css">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="bootstrap-footer-02/css/style.css">
    <link rel="stylesheet" href="bar/bar.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>
<section class="form-container">
   <form action="" method="post">
      <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
      <input type="int" name="tien" required placeholder="Nhập số tiền" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" name="submit" class="btn">
      <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
      <a href="home.php" class="ql">Quay lại trang chủ</a></p>
   </form>
</section>
<?php include 'components/footer.php'; ?>
</body>
<style>
.ql{
   font-size: 20px;
}
</style>
</html>
