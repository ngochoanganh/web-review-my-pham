<?php

include '../components/connect.php';

// Kết nối đến cơ sở dữ liệu
$conn = new PDO($db_name, $user_name, $user_password);

$userId = $_POST['abc'];
// Lấy thông tin của thực thể cần chuyển đổi`

$select = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select->execute([$userId]);


// $sql = "SELECT * FROM `users` WHERE id = ?";
// $result = $conn->query($sql);
// Xóa thực thể khỏi bảng user
// $delete =  $conn->prepare("DELETE FROM `users` WHERE id = ?");
// $delete->execute([$userId]);

// Kiểm tra xem có hay không có hàng nào bị ảnh hưởng bởi câu lệnh `SELECT`
if ($select->rowCount() > 0) {
    // Lấy tất cả các tài khoản người dùng
    $users = $select->fetchAll(PDO::FETCH_ASSOC);

    // Duyệt qua các tài khoản người dùng
    foreach ($users as $user) {
        // Lấy thông tin tài khoản người dùng
        $username = $user["name"];
        $password = $user["password"];
    }
     // Kiểm tra xem tài khoản đã tồn tại trong bảng admin chưa
     $check_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
     $check_admin->execute([$username]);

     if ($check_admin->rowCount() == 0) {
        // Nếu chưa có tài khoản trong bảng admin, thêm mới
        $sql = "INSERT INTO admin (name, password) VALUES ('$username', '$password')";
        $conn->query($sql);

    
        echo "Thực hiện chuyển đổi thành công!";
    } else {
        echo "Không tìm thấy người dùng có ID là $userId";
    }
}

// Đóng kết nối đến cơ sở dữ liệu
// $conn->disconnect();

 header("Location: dashboard.php");

?>