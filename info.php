<?php
session_start();
include_once 'lib/database.php';
include_once 'classes/user.php';
$userClass = new user();

$userId = Session::get('userId'); // hoặc $_SESSION['userId']
$user = $userClass->getInfoById($userId);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin người dùng</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 40px;
        }

        .info-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        ul.user-info {
            list-style: none;
            padding: 0;
        }

        ul.user-info li {
            margin-bottom: 12px;
            font-size: 16px;
        }

        ul.user-info li strong {
            width: 120px;
            display: inline-block;
            color: #555;
        }

        .back-home {
            display: block;
            margin-top: 25px;
            text-align: center;
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .back-home:hover {
            text-decoration: underline;
        }

        .no-user {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <div class="info-container">
        <h2>Thông tin người dùng</h2>

        <?php if ($user): ?>
            <ul class="user-info">
                <li><strong>Họ tên:</strong> <?= htmlspecialchars($user['fullname']) ?></li>
                <li><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
                <li><strong>Địa chỉ:</strong> <?= htmlspecialchars($user['address']) ?></li>
            </ul>
        <?php else: ?>
            <p class="no-user">Không tìm thấy thông tin người dùng.</p>
        <?php endif; ?>

        <a class="back-home" href="index.php">← Quay về Trang chủ</a>
    </div>
</body>
</html>
