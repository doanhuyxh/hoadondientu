<?php
$bill = $data['bill'];
?>

<h2>Thông tin hóa đơn </h2>

<div class="container d-flex justify-content-center mt-5" id="appVue">
    <div class="form-group w-75 shadow-lg p-3 mb-5 bg-body rounded">

        <div class="mb-3">
            <label class="form-label">Số hóa đơn</label>
            <p class="form-control"> <?php echo $bill->InvoiceNumber ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày lập hóa đơn</label>
            <p class="form-control"> <?php echo $bill->InvoiceDate ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->SellerName ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->SellerAddress ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->SellerPhone ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Mã số thuế công ty hoặc cá nhân <strong>(bán hàng)</strong> <strong>(nếu
                    có)</strong></label>
            <p class="form-control"> <?php echo $bill->SellerTaxCode ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->BuyerName ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->BuyerAddress ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <p class="form-control"> <?php echo $bill->BuyerPhone ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Mã số thuế công ty hoặc cá nhân <strong>(mua hàng)</strong> <strong>(nếu
                    có)</strong></label>
            <p class="form-control"> <?php echo $bill->BuyerTaxCode ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Thông tin sản phẩm và dịch vụ</label>
            <table class="table table-bordered">
                <thead class="table-active">
                <tr>
                    <td>STT</td>
                    <td class="text-nowrap">Sản phẩm</td>
                    <td class="text-nowrap">Số lượng</td>
                    <td class="text-nowrap">Đơn giá</td>
                    <td class="text-nowrap">Tổng cộng</td>

                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($data['listItem']) && is_array($data['listItem'])) {
                    foreach ($data['listItem'] as $index => $item) {
                        echo '<tr>
            <td> ' . ($index + 1) . ' </td>
            <td>
                <p class="form-control-static">' . htmlspecialchars($item->ItemDescription) . '</p>
            </td>
            <td>
                <p class="form-control-static">' . htmlspecialchars($item->Quantity) . '</p>
            </td>
            <td>
                <p class="form-control-static">' . htmlspecialchars($item->UnitPrice) . '</p>
            </td>
            <td>
                 <p class="form-control-static">' . htmlspecialchars($item->UnitPrice * $item->Quantity) . '</p>
            </td>
        </tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">Không có dữ liệu để hiển thị</td></tr>';
                }
                ?>

                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <label class="form-label">Tổng tiền truớc thuế</label>
            <p class="form-control"> <?php echo $bill->SubTotal ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Thuế suất (%)</label>
            <p class="form-control"> <?php echo $bill->TaxRate ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tiền thuế</label>
            <p class="form-control"> <?php echo $bill->TaxAmount ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tiền sau thuế</label>
            <p class="form-control"> <?php echo $bill->TotalAmount ?> </p>
        </div>


        <div class="mb-3">
            <label class="form-label">Phương thức thanh toán</label>
            <p class="form-control"> <?php echo $bill->PaymentMethod ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên ngân hàng <strong>(nếu chuyển khoản)</strong></label>
            <p class="form-control"> <?php echo $bill->BankName ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số tài khoản <strong>(nếu chuyển khoản)</strong></label>
            <p class="form-control"> <?php echo $bill->BankAccount ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Người lập hóa đơn</label>
            <p class="form-control"> <?php echo $bill->IssuerName ?> </p>
        </div>


    </div>
</div>

