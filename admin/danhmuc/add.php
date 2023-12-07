<div class="pcoded-content">

    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-layers bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>DANH MỤC</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Quản lý danh mục</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Thêm mới </h5>
                                </div>
                                <div class="card-block">
                                    <form action="index.php?act=adddm" method="post">
                                        <label for="name">Name</label>
                                        <input type="text" name="tenloai" class="form-control">
                                        
                                        <span style="color:red"><?php echo !empty($error['tenloai']) ? $error['tenloai'] : false   ?> </span><br>

                                        <input type="submit" name="btn-submit" class="btn btn-info mt-3" value="Submit">
                                        <a href="index.php?act=listdm" class="btn btn-primary mt-3">Quay lại d/s</a>

                                    </form><br>
                                    <?php
                                    if (!empty($thongbao) && ($thongbao != "")) {
                                    ?> <h5 style="color:green"><?= $thongbao ?></h5><?php
                                                                                }
                                                                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>