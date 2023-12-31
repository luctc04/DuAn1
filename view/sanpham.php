<div class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="breadcrumb-list">
					<h1>DANH MỤC CỬA HÀNG</h1>
					<ul>
						<li><a href="index.php">Trang chủ</a> <span class="divider">|</span></li>
						<li><a href="index.php?act=sanpham_full">Thú cưng</a> <span class="divider"></span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="shop-area">
	<div class="container">
		<div class="row">
			<!-- left-sidebar start -->
			<div class=" col-md-3  col-xs-12">
				<!-- widget-categories start -->
				<aside class="widget widget-categories">
					<h3 class="sidebar-title">Danh Mục</h3>
					<ul class="sidebar-menu">
						<?php
						foreach ($dsdm as $dm) {
							extract($dm);
							$linkdm = "index.php?act=sanpham&iddm=" . $id;
							echo '<li>
									<a href="' . $linkdm . '">' . $name . '</a>
								</li>';
						}

						?>
					</ul>
				</aside>
				<aside class="widget widget-categories">
					<h3 class="sidebar-title">Top yêu thích</h3>
					<div class="recent-product">
						<?php
						foreach ($dstop5 as $sp) :
							extract($sp);
							$linksp = "index.php?act=sanphamct&idsp=" . $id;
							$img = $img_path . $img;
						?>
							<div class="single-product">
								<div class="product-img">
									<a href="<?= $linksp ?>">
										<img src="<?= $img ?>" alt="" />
									</a>
								</div>
								<div class="product-content">
									<h3><a href="<?= $linksp ?>"><?= $name ?></a></h3>
									<div class="price">
										<span><?= number_format((int)$price_sale, 0, ",", ".") ?><u>đ</u></span>
										<span class="old"><?= number_format((int)$price, 0, ",", ".") ?><u>đ</u></span>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>

					</div>
				</aside>
				<aside class="widget product-tag">
					<h3 class="sidebar-title">Popular Tags</h3>
					<ul>
						<li><a href="#">Top</a></li>
						<li><a href="#">Fashion</a></li>
						<li><a href="#">Collection</a></li>

					</ul>
				</aside>
				<!-- widget-tags end -->
				<aside class="widget sale-off hidden-sm">
					<div class="sale-off-carosel">
						<div class="single-sale">
							<a href="#">
								<img src="img/product/p6.jpg" alt="" />
								<h2>sale off</h2>
							</a>
						</div>
						<div class="single-sale">
							<a href="#">
								<img src="img/product/p7.jpg" alt="" />
								<h2>sale off</h2>
							</a>
						</div>
						<div class="single-sale">
							<a href="#">
								<img src="img/product/p4.jpg" alt="" />
								<h2>sale off</h2>
							</a>
						</div>
					</div>
				</aside>
			</div>
			<div class="col-md-9  col-xs-12">
				<div>
					<!-- Nav tabs -->
					<ul class="shop-tab" role="tablist">
						<li><span class="sorting-name"> View as: </span></li>
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i></a></li>
						<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<!--  -->
				<div class="row" style="margin-top: 50px;">
					<?php
					$i = 0;
					foreach ($dssp as $sp) :
						extract($sp);
						$linksp = "index.php?act=sanphamct&idsp=" . $id;
						$hinh = $img_path . $img;
						if (($i == 2) || ($i == 5) || ($i == 8) || ($i == 11)) {
							$mr = "";
						} else {
							$mr = "mr";
						}
					?>
						<div class="single-product " style="width: 250px;margin-left: 20px; margin-bottom:30px">

							<div class="product-img">
								<a href="<?= $linksp ?>">
									<img src="<?= $hinh ?>" alt="" width="100%" />
								</a>
								<span class="tag-line">new</span>
								<div class="product-action">
									<div class="button-top">
										<a href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-search"></i></a>
										<a href="#"><i class="fa fa-heart"></i></a>
									</div>
									<div class="button-cart">
										<button data-id="<?= $id ?>" class="btnCart" onclick="addToCart(<?= $id ?>, '<?= $name ?>', <?= $price_sale ?>)"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
									</div>

								</div>
							</div>
							<div class="product-content">
								<h3><a href="<?= $linksp ?>"><?= $name ?></a></h3>
								<div class="price">
									<span><?= number_format((int)$price_sale, 0, ",", ".") ?><u>đ</u></span>
									<span class="old"><?= number_format((int)$price, 0, ",", ".") ?><u>đ</u></span>
								</div>
							</div>

						</div>

					<?php
						$i++;
					endforeach;
					?>
				</div>
				<!--  -->


			</div>
		</div>
	</div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
	let totalProduct = document.getElementById('totalProduct');

	function addToCart(productId, productName, productPrice) {
		// console.log(productId, productName, productPrice);
		// Sử dụng jQuery
		$.ajax({
			type: 'POST',
			// Đường dẫ tới tệp PHP xử lý dữ liệu
			url: './view/cart/addToCart.php',
			data: {
				id: productId,
				name: productName,
				price: productPrice
			},
			success: function(response) {
				totalProduct.innerText = response;
				alert('Bạn đã thêm sản phẩm vào giỏ hàng thành công!')
			},
			error: function(error) {
				console.log(error);
			}
		});
	}
</script>