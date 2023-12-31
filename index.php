<?php
session_start();
ob_start();
include "model/pdo.php";
include "model/danhmuc.php";
include "model/sanpham.php";
include "model/taikhoan.php";
include "model/order.php";
include "view/header.php";
include "global.php";


if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (!isset($_SESSION['success'])) $_SESSION['success'] = [];

$spnew = loadall_sanpham_home();
$dsdm = loadall_danhmuc();
$dstop5 = loadall_sanpham_top5();

if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'listcart':
            // Kiểm tra xem giỏ hàng có dữ liệu hay không
            if (!empty($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];

                // Tạo mảng chứa ID các sản phẩm trong giỏ hàng
                $productId = array_column($cart, 'id');

                // Chuyển đôi mảng id thành một cuỗi để thực hiện truy vấn
                $idList = implode(',', $productId);

                // Lấy sản phẩm trong bảng sản phẩm theo id
                $dataDb = loadone_sanphamCart($idList);
                // var_dump($dataDb);
            }
            include "view/cart/listCartOrder.php";
            break;
        case "order":
            if (isset($_SESSION['cart'])) {
                $cart = $_SESSION['cart'];
                // print_r($cart);
                if (isset($_POST['order_confirm'])) {
                    $txthoten = $_POST['txthoten'];
                    $txttel = $_POST['txttel'];
                    $txtemail = $_POST['txtemail'];
                    $txtaddress = $_POST['txtaddress'];
                    $pttt = $_POST['pttt'];
                    if (isset($_SESSION['user'])) {
                        $id_user = $_SESSION['user']['id'];
                    } else {
                        $id_user = 0;
                    }

                    $idBill = addOrder($id_user, $txthoten, $txttel, $txtemail, $txtaddress, $_SESSION['resultTotal'], $pttt);
                    foreach ($cart as $item) {
                        addOrderDetail($idBill, $item['id'], $item['price'], $item['quantity'], $item['price'] * $item['quantity']);
                    }

                    if ($_POST['pttt'] == 2) {
                        unset($_SESSION['cart']);
                        $_SESSION['donhang'] = $idBill;
                        require_once 'PHPMailer/sendmail.php';
                        header("location:view/momo/xulythanhtoanmomo.php");
                    }
                    if ($_POST['pttt'] == 1) {
                        unset($_SESSION['cart']);
                        $_SESSION['donhang'] = $idBill;
                        require_once 'PHPMailer/sendmail.php';
                        header("Location: index.php?act=donhang");
                    }
                }
                include "view/cart/order.php";
            } else {
                header("Location: index.php?act=listCart");
            }
            break;
        case 'donhang':
            $listdonhang = loadall_donhang($taikhoan['id']);
            include "view/cart/donhang.php";
            break;
        case 'donhangct':
            if (isset($_GET['id_order'])) {
                $id_order = $_GET['id_order'];
                // $list_dhct=loadall_donhangct($id_order);
                $onedh = loadone_donhangchitiet($id_order);
            }
            include "view/cart/donhangct.php";
            break;
        case 'sanpham':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $dssp = loadall_sanpham($kyw, $iddm);
            $tendm = load_ten_dm($iddm);
            include "view/sanpham.php";
            break;
        case 'sanpham_full':
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $dssp = loadall_sanpham($kyw, $iddm);
            $tendm = load_ten_dm($iddm);
            $spnew = loadall_sanpham_home();
            include "view/sanpham.php";
            break;
        case 'sanphamct':
            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                $id = $_GET['idsp'];
                // $soluong =$_POST['soluong'];
                // $price =$_POST['price_sale'];
                // $_SESSION['cart']=
                // [ 'id'=> $id,
                // 'name'=> $name,
                // 'price'=> $price];
                $onesp = loadone_sanpham($id);
                extract($onesp);
                $sp_cung_loai = load_sanpham_cungloai($id, $iddm);
                include "view/sanphamct.php";
            } else {
                include "view/home.php";
            }

            break;
        case 'dangky':
            if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $checkemail = checkemail_dangky($email);
                $typeEmail = isEmail($email);
                $error = [];
                // validate email: bat buoc nhap, email dung dinh dang, email ton tai
                if (!$typeEmail) {
                    $error['email'] = '*Email không đúng định dạng.';
                } else {
                    if (!empty($checkemail)) {
                        $error['email'] = '*Email này đã tồn tại vui lòng nhập email khác.';
                    }
                }

                // validate hoten
                if (empty($user)) {
                    $error['user'] = '*Họ và tên không được để trống.';
                }

                if (empty(trim($pass))) {
                    $error['pass'] = '*Mật khẩu không được để trống';
                }

                if (empty($error)) {
                    insert_taikhoan($email, $user, $pass);
                    $thongbao = "Đã đăng ký thành công. Vui lòng đăng nhập để thực hiện chức năng bình luận!";
                }
            }
            include "view/taikhoan/dangky.php";
            break;
        case 'dangnhap':
            if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $checkuser = checkuser($user, $pass);
                if (is_array($checkuser)) {
                    $_SESSION['taikhoan'] = $checkuser;
                }
                if (is_array($checkuser)) {
                    $_SESSION['user'] = $checkuser;
                } else {
                    $thongbao = "Tài khoản không tồn tại. Vui lòng kiểm tra hoặc đăng ký!";
                }

                $error = [];
                if (empty($user)) {
                    $error['user'] = "*Họ tên không được để trống.";
                } else if ($user !== $checkuser) {
                    $error['user'] = "*Tên người dùng không tồn tại vui lòng nhập lại. ";
                }
                if (empty($pass)) {
                    $error['pass'] = "*Mật khẩu không được để trống.";
                } else if ($pass !== $checkuser) {
                    $error['pass'] =  "*Mật khẩu không trùng khớp.";
                }

                if (isset($_SESSION['user']) && $_SESSION['taikhoan']['role'] == 1) {
                    header("location:/admin/index.php");
                } else {
                    if (isset($_SESSION['user']) && $_SESSION['taikhoan']['role'] == 0) {
                        header("location: index.php");
                    }
                }
            }
            include "view/taikhoan/dangnhap.php";
            break;
        case "dangxuat":
            unset($_SESSION["user"]);
            header("location: index.php");
            break;

        case 'edit_taikhoan':
            if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $id = $_POST['id'];

                update_taikhoan($id, $user, $pass, $email, $address, $tel);
                $_SESSION['user'] = checkuser($user, $pass);
                header("location: index.php?act=edit_taikhoan");
            }
            include "view/taikhoan/edit_taikhoan.php";
            break;
        case 'quenmk':
            if (isset($_POST['guiemail']) && ($_POST['guiemail'])) {
                $email = $_POST['email'];
                $checkemail = checkemail($email);
                if (is_array($checkemail)) {
                    $thongbao = "Mật khẩu của bạn là: " . $checkemail['pass'];
                } else {
                    $thongbao = "Email này không tồn tại.";
                }
            }
            include "view/taikhoan/quenmk.php";
            break;

        case 'lienhe':
            include "view/lienhe.php";
            break;
        case 'gioithieu':
            include "view/gioithieu.php";
            break;
        case 'blog':
            include "view/blog.php";
            break;
        default:
            include "view/home.php";
            break;
    }
} else {
    include "view/home.php";
}

include "view/footer.php";

ob_flush();
