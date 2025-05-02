<?php
include_once 'lib/session.php';
Session::init();

include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function($className) {
    include_once "classes/" . $className . ".php";
});

$db = new database();
$fm = new format();
$ct = new cart();
$us = new user();
$cat = new category();
$product = new product();
$cs = new customer();
$dir = new direct();

// Header cache
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Shop DIY Huế</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
  <link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
  <script src="js/jquerymain.js"></script>
  <script src="js/script.js" type="text/javascript"></script>
  <script type="text/javascript" src="js/nav.js"></script>
  <script type="text/javascript" src="js/move-top.js"></script>
  <script type="text/javascript" src="js/easing.js"></script>
  <script type="text/javascript" src="js/nav-hover.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Monda&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Doppio+One&display=swap" rel="stylesheet">
  <script type="text/javascript">
    $(document).ready(function($){
        $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4', speed:'fast', effect:'fade'});
    });
  </script>
</head>
<body>
  <div class="wrap">
    <div class="header_top">
      <div class="logo">
        <a href="index.php"><img src="images/2020-01-10.png" alt="Logo Shop" /></a>
      </div>

      <div class="header_top_right">
        <div class="search_box">
          <form action="search.php" method="get">
            <input type="text" name="fsearch" placeholder="Tìm kiếm sản phẩm">
            <input type="submit" name="search" value="Tìm kiếm">
          </form>
        </div>

        <div class="shopping_cart">
          <div class="cart">
            <a href="cart.php" title="Xem giỏ hàng" rel="nofollow">
              <span class="cart_title">Giỏ hàng:</span>
              <span class="no_product">
                <?php
                  $check_cart = $ct->check_cart();
                  if ($check_cart) {
                      $qty = Session::get("qty");
                      echo $qty;
                  } else {
                      echo 'Trống';
                  }
                ?>
              </span>
            </a>
          </div>
        </div>

        <div class="login">
          <?php
            $login_check = Session::get('customer_login');
            if ($login_check == false) {
                echo '<a href="login.php">Đăng nhập</a>';
            } else {
                echo '<a href="logout.php">Đăng xuất</a>';
            }
          ?>
        </div>
        <div class="clear"></div>
      </div>
      <div class="clear"></div>
    </div>

    <div class="menu">
      <ul id="dc_mega-menu-orange" class="dc_mm-orange">
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="introduce.php">Giới thiệu</a></li>
        <li><a href="products.php">Sản phẩm</a></li>
        <li><a href="cart.php">Giỏ hàng</a></li>
        <li><a href="contact.php">Liên hệ</a></li>
        <li><a href="direct.php">Hướng dẫn</a></li>
        <?php
          if ($login_check) {
              echo '<li><a href="profile.php">Thông tin khách hàng</a></li>';
              echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
          }
        ?>
        <div class="clear"></div>
      </ul>
    </div>
