<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hóa đơn điện tử</title>
    <link href="<?php echo _WEB_ROOT . "/public/assets/css/sb-admin-2.min.css" ?>" rel="stylesheet">
    <link href="<?php echo _WEB_ROOT . "/public/lib/bootstrap/bootstrap.min.css" ?>" rel="stylesheet">
    <script src="<?php echo _WEB_ROOT . "/public/lib/bootstrap/bootstrap.bundle.min.js" ?>"></script>
    <script src="<?php echo _WEB_ROOT . "/public/lib/jquery-3.6.3.js" ?>"></script>

    <script src="<?php echo _WEB_ROOT . "/public/lib/CkEditor/ckeditor.js" ?>"></script>
    <script src="<?php echo _WEB_ROOT . "/public/lib/CkEditor/config.js" ?>"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.5/axios.min.js"></script>

    <style>
        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>

</head>
<body>

<div id="wrapper">


    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">admin</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="/admin-index">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities"
               aria-expanded="false" aria-controls="collapseUtilities">
                <i class="fa-solid fa-gear"></i>
                <span>Hệ thống</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-bs-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin-user">Quản lý user</a>
                    <a class="collapse-item" href="">Mẫu hoá đơn</a>
                    <a class="collapse-item" href="/admin-mail">Mẫu email</a>
                    <a class="collapse-item" href="/admin-setting">Cấu hình hệ thống</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities1"
               aria-expanded="false" aria-controls="collapseUtilities">
                <i class="fa-solid fa-list"></i>
                <span>Danh mục</span>
            </a>
            <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                 data-bs-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin-customer">Khách hàng</a>
                    <a class="collapse-item" href="/admin-supplier">Nhà cung cấp</a>
                    <a class="collapse-item" href="/admin-goods">Hàng hóa</a>
                    <a class="collapse-item" href="/admin-exchange-rate">Tỷ giá</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities2"
               aria-expanded="false" aria-controls="collapseUtilities2">
                <i class="fa-solid fa-receipt"></i>
                <span>Hóa đơn</span>
            </a>
            <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                 data-bs-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin-bill">Hóa đơn</a>
                    <a class="collapse-item" href="/admin-create-bill">Lập hóa đơn</a>
                    <a class="collapse-item" href="/admin-number">Cấp số</a>
                    <a class="collapse-item" href="">Duyệt hoá đơn</a>
                    <a class="collapse-item" href="">Thông báo sai sót</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUtilities3"
               aria-expanded="false" aria-controls="collapseUtilities3">
                <i class="fa-solid fa-receipt"></i>
                <span>Đăng kí  sử dụng</span>
            </a>
            <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
                 data-bs-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="/admin-declaration-create">Lập tờ khai</a>
                    <a class="collapse-item" href="/admin-declaration">Tra cứu tờ khai</a>
                </div>
            </div>
        </li>

        <li class="nav-item active">
            <a class="nav-link" href="/admin-report">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Báo cáo</span>
            </a>
        </li>

    </ul>
    <!-- End of Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                           aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                       placeholder="Search for..." aria-label="Search"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                        <img class="img-profile rounded-circle"
                             src="https://i.pravatar.cc/300">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="DangXuat()">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->
        <div class="container-fluid">
            <?php require_once _DIR_ROOT . "/app/Views/" . $data['subview'] . '.php' ?>
        </div>
    </div>
</div>

<script>
    function DangXuat() {
        window.location.href = "/dang-xuat"
    }
</script>

</body>
</html>