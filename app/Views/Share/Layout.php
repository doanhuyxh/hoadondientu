<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn điện tử</title>
    <link rel="icon" type="image/x-icon" href="<?php echo _WEB_ROOT . "/public/assets/img/NTT_Logo.jpg" ?>">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/solid.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/regular.min.css" />

    <link href="<?php echo _WEB_ROOT . "/public/lib/bootstrap/bootstrap.min.css" ?>" rel="stylesheet">
    <script src="<?php echo _WEB_ROOT . "/public/lib/jquery-3.6.3.js" ?>"></script>
    <script src="<?php echo _WEB_ROOT . "/public/lib/bootstrap/bootstrap.bundle.min.js" ?>"></script>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="<?php echo _WEB_ROOT . "/public/assets/css/styles.css" ?>">



</head>

<body class="overflow-hidden">

    <header class="container-fluid">
        <div class="header-main">
            <div class="img-header">
                <img src="<?php echo _WEB_ROOT . "/public/assets/img/NTT_Logo.jpg" ?>" alt="logo">
            </div>
            <div class="right-header">
                <ul>
                    <li>
                        <a href="#">Trang chủ</a>
                    </li>
                    <li>
                        <a href="#">Tra cứu dữ liệu</a>
                    </li>
                    <li>
                        <a href="#">Quản lý hoá đơn</a>
                    </li>
                    <li>
                        <a href="#">Tra cứu bảng tổng hợp</a>
                    </li>
                    <li>
                        <a href="#">Báo cáo</a>
                    </li>

                    <?php
                    if(isset($_SESSION['username'])){
                        echo '<li> <a class="pe-auto" onclick="DangXuat()" data-bs-toggle="tooltip" data-bs-placement="top"  data-bs-title="đăng xuất"> Xin chào ' . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . '</a></li>';
                    } else {
                        echo '<li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#loginForm">Đăng nhập</a>
                    </li>
                    <li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#registerForm">Đăng ký</a>
                    </li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </header>

    <?php require_once _DIR_ROOT . "/app/Views/" . $data['subview'] . '.php' ?>

    <?php require_once _DIR_ROOT . "/app/Views/Auth/index.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script>
        function DangXuat(){
            window.location.href="/dang-xuat"
        }
    </script>
        

</body>

</html>