<?php
$dsdm = loadall_danhmuc();
// $tendm = load_ten_dm($iddm);
?>
<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="/login/wphix.com/template/pabna/pabna/img/favicon.ico">

  <link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico">
  <!-- Place favicon.ico in the root directory -->

  <!-- all css here -->
  <!-- bootstrap v3.3.6 css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="/funnypet/css/bootstrap.min.css">
  <link rel="stylesheet" href="/template/funnypet/css/animate.css">
  <link rel="stylesheet" href="/template/funnypet/css/jquery-ui.min.css">
  <link rel="stylesheet" href="/template/funnypet/css/meanmenu.min.css">
  <link rel="stylesheet" href="/template/funnypet/css/owl.carousel.css">
  <link rel="stylesheet" href="/template/funnypet/css/slick.css">
  <link rel="stylesheet" href="/template/funnypet/css/font-awesome.min.css">
  <link rel="stylesheet" href="/template/funnypet/css/style.css">
  <link rel="stylesheet" href="/template/funnypet/css/responsive.css">
  <link rel="stylesheet" href="/css/style2.css">
  <script src="/template/funnypet/js/vendor/modernizr-2.8.3.min.js"></script>

  <style>
    .mr{
    margin-right: 2%;
  }
  </style>

</head>

<body>

  <header class="header-pos">
    <!-- Menu pc -->
    <div class="header-bottom-area">
      <div class="container">
        <div class="inner-container">
          <div class="row">
            <div class="col-md-2 col-sm-4 col-xs-5">
              <div class="logo">
                <a href="index.html"><img src="img\2-removebg-preview.png" alt="" /></a>
              </div>
            </div>
            <div class="col-md-8 hidden-xs hidden-sm">
              <div class="main-menu">
                <nav>
                  <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="gioithieu.php">Giới thiệu</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li class="static"><a href="shop.html">Thú cưng</a>
                      <div class="mega-menu">
                        <div class="mega-left">
                          <span>
                          <a href="#" class="mega-title">Thú cưng</a>
                          <?php
                            foreach ($dsdm as $dm) {
                              extract($dm);
                              $linkdm = "index.php?act=sanpham&iddm=" . $id;
                              echo '
                                  <a href="' . $linkdm . '">' . $name . '</a>
                                ';
                            }

                            ?>
                          
                          </span>
                        </div>
                        <div class="mega-right">
                          <span class="mega-menu-img">
                            <a href="shop.html"><img alt="" src="/img/product/p1.jpg"></a>
                          </span>
                        </div>
                      </div>
                    </li>
                    <li><a href="shop.html">Phụ kiện</a>
                      <div class="mega-menu mega-menu-2">
                        <div class="mega-left">
                          <span>
                            <a href="shop.html">BALO</a>
                            <a href="shop.html">CÁT VỆ SINH</a>
                            <a href="shop.html">CHUỒNG</a>
                            <a href="shop.html">MỸ PHẨM & LÀM ĐẸP</a>
                          </span>
                          <span>
                            <a href="shop.html">NỆM</a>
                            <a href="shop.html">ÁO</a>
                            <a href="shop.html">VÒNG CỔ</a>
                            <a href="shop.html">ĐỒ CHƠI</a>
                            <a href="shop.html">DÂY DẮT</a>
                          </span>

                        </div>

                        <div class="mega-right">
                          <span class="mega-menu-img2">
                            <a href="shop.html"><img alt="" src="/img/product/balo1.jpg"></a>
                          </span>
                        </div>
                      </div>
                    </li>

                    <li><a href="contact.html">Liên hệ</a></li>
                  </ul>
                </nav>
              </div>
            </div>
            <div class="col-md-2 col-sm-8 col-xs-7 header-right">
              <div class="my-cart">
                <div class="total-cart">
                  <a href="cart.html">
                    <i class="fa fa-shopping-cart"></i>
                    <span>2</span>
                  </a>
                </div>
                <ul>
                  <li>
                    <div class="cart-img">
                      <a href="#"><img alt="" src="img/cart/1.jpg"></a>
                    </div>
                    <div class="cart-info">
                      <h4><a href="#">Vestibulum suscipit</a></h4>
                      <span>£165.00 <span>x 1</span></span>
                    </div>
                    <div class="del-icon">
                      <i class="fa fa-times-circle"></i>
                    </div>
                  </li>
                  <li>
                    <div class="cart-img">
                      <a href="#"><img alt="" src="img/cart/1.jpg"></a>
                    </div>
                    <div class="cart-info">
                      <h4><a href="#">Vestibulum suscipit</a></h4>
                      <span>£165.00 <span>x 1</span></span>
                    </div>
                    <div class="del-icon">
                      <i class="fa fa-times-circle"></i>
                    </div>
                  </li>
                  <li class="cart-border">
                    <div class="subtotal-text">Subtotal: </div>
                    <div class="subtotal-price">£300.00</div>
                  </li>
                  <li>
                    <a class="cart-button" href="checkout.html">view cart</a>
                    <a class="checkout" href="checkout.html">checkout</a>
                  </li>
                </ul>
              </div>
              <div class="user-meta">
                <a href="#"><i class="fa fa-cog"></i></a>
                <ul>
                  <li><a href="index.php?act=dangky">Tài khoản</a></li>
                  <!-- <li><a href="#">Đăng nhập</a></li>
                  <li><a href="#">Checkout</a></li> -->

                </ul>
              </div>
              <div class="header-search">
                <i class="fa fa-search"></i>
                <div class="header-form">
                  <form action="index.php?act=sanpham" method="post">
                    <input type="text" name="kyw" placeholder="search" />
                    <button type="submit"><i class="fa fa-search" ></i></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  

  </header>