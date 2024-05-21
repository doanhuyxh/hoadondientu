<link rel="stylesheet" href="<?php echo _WEB_ROOT . "/public/assets/css/home.css" ?>">

<section id="tra_cuu" class="container">
    <div class="title-main d-flex justify-content-center">
        <h2 class="text-center">Tra cứu hóa đơn điện tử</h2>

    </div>
    <div  class="main-tra-cuu">
        <div class="row">
            <div class="col-12 col-md-4 bd-right">
                <div class="mb-3">
                    <label for="mst" class="form-label">MST người bán <span class="text-danger">(*)</span> </label>
                    <input type="text" class="form-control" id="mst" >
                </div>
                <div class="mb-3">
                    <label for="mst" class="form-label">Loại hóa đơn <span class="text-danger">(*)</span> </label>
                    <select name="" id="" class="form-control">
                        <option>
                            Hóa đơn điển tự giá trị gia tăng
                        </option>
                        <option>
                            Hóa đơn bán hàng
                        </option>
                        <option>
                            Hóa đơn bán tài khoản công
                        </option>
                        <option>
                            Hóa đơn khác
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="shd" class="form-label">Số hóa đơn <span class="text-danger">(*)</span> </label>
                    <input type="text" class="form-control" id="shd" >
                </div>
                <div class="mb-3">
                    <label for="tienThue" class="form-label">Tổng tiền thuế </label>
                    <input type="text" class="form-control" id="tienThue" >
                </div>
                <div class="mb-3">
                    <label for="tienThanhToan" class="form-label">Tổng tiền thanh toán </label>
                    <input type="text" class="form-control" id="tienThanhToan" >
                </div>
                <div class="btn-search">
                    <button type="submit" class=""><span>Tìm kiếm</span></button>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div>

                    <?php
                    if(isset($_SESSION['fullname'])){
                        echo "<h3 class='alert alert-success'> Mã số thuế: " . $_SESSION['fullname'] . "</h3>";
                        echo "<h3 class='alert alert-success'> Role: " . $_SESSION['role_name'] . "</h3>";
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>



</section>
