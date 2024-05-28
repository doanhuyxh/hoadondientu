<style>
    .bill-border {
        padding: 8px;
        border: 8px solid #efa4a4;
    }

    .img-fluid {
        width: 100%;
    }

    .line {
        width: 100%;
        height: 3px;
        background: #000;
    }
    .text-right{
        text-align: right;
    }

</style>

<?php

function convert_date_to_string($date) {
    // Kiểm tra xem chuỗi ngày có đúng định dạng không
    if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        // Tách chuỗi ngày thành các phần tử
        $parts = explode('-', $date);

        // Lấy các phần tử ngày, tháng, năm
        $year = (int)$parts[0];
        $month = (int)$parts[1];
        $day = (int)$parts[2];

        // Định dạng chuỗi ngày tháng năm theo yêu cầu
        $formattedDate = "Ngày " . $day . " tháng " . $month . " năm " . $year;

        return $formattedDate;
    } else {
        // Trả về thông báo lỗi nếu chuỗi ngày không đúng định dạng
        return "Định dạng ngày không hợp lệ.";
    }
}
function convert_number_to_words($number)
{
    $hyphen = ' ';
    $conjunction = ' và ';
    $separator = ' ';
    $negative = 'âm ';
    $decimal = ' phẩy ';
    $dictionary = array(
        0 => 'không',
        1 => 'một',
        2 => 'hai',
        3 => 'ba',
        4 => 'bốn',
        5 => 'năm',
        6 => 'sáu',
        7 => 'bảy',
        8 => 'tám',
        9 => 'chín',
        10 => 'mười',
        11 => 'mười một',
        12 => 'mười hai',
        13 => 'mười ba',
        14 => 'mười bốn',
        15 => 'mười lăm',
        16 => 'mười sáu',
        17 => 'mười bảy',
        18 => 'mười tám',
        19 => 'mười chín',
        20 => 'hai mươi',
        30 => 'ba mươi',
        40 => 'bốn mươi',
        50 => 'năm mươi',
        60 => 'sáu mươi',
        70 => 'bảy mươi',
        80 => 'tám mươi',
        90 => 'chín mươi',
        100 => 'trăm',
        1000 => 'nghìn',
        1000000 => 'triệu',
        1000000000 => 'tỷ',
        1000000000000 => 'nghìn tỷ',
        1000000000000000 => 'triệu tỷ',
        1000000000000000000 => 'tỷ tỷ'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int)($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string)$fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode($separator, $words);
    }

    return $string;
}

?>

<div class="container">
    <div class="w-100 shadow-lg bg-body rounded bill-border">

        <div class="row">
            <div class="col-3">
                <div class="img-fluid">
                    <img src="/public/assets/img/logo/Logo-FPT.png" style="width: 100% ; height: auto">
                </div>
            </div>
            <div class="col-6">
                <div class="text-center">
                    <h3 class="text-danger text-uppercase">HÓA ĐƠN GIÁ TRỊ GIA TĂNG</h3>
                    <h3 class="text-danger text-uppercase">(VAT INVOICE)</h3>
                    <h5 class="text-danger">Bản thể hiện hóa đơn điện tử</h5>
                    <p class="text-dark">
                        <?php echo convert_date_to_string($data['bill']->InvoiceDate) ?>
                    </p>
                    <p class="text-dark fw-bold">CQT: <?php echo $data['settings']["cqt"] ?></p>
                </div>
            </div>
            <div class="col-3">
                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <div class="container" style="transform: translateY(-35px)">
                        <p class="m-0">Ký hiệu (Series): <strong>1C24TEU</strong></p>
                        <p class="m-0">Số (No.): <span class="text-danger fs-2 fw-bold"> <?php echo $data['bill']->InvoiceNumber ?> </span></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="line"></div>

        <div class="container">
            <table class="table">
                <tr>
                    <td class="col-2">Đơn vị bán hàng</td>
                    <td class="text-danger fs-3">
                        <?php echo $data['bill']->SellerName ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Mã số thuế</td>
                    <td class="col-7 text-danger">
                        <?php echo $data['bill']->SellerTaxCode ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Địa chỉ</td>
                    <td>
                        <?php echo $data['bill']->SellerAddress ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Điện thoại</td>
                    <td>
                        <?php echo $data['bill']->SellerPhone ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Số tài khoản</td>
                    <td></td>
                </tr>

            </table>
        </div>
        <div class="line"></div>

        <div class="container">
            <table class="table">
                <tr>
                    <td class="col-2">Họ tên người mua hàng </td>
                    <td>
                        <?php echo $data['bill']->BuyerName ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Tên đơn vị</td>
                    <td class="col-7 text-danger">
                        <?php echo $data['bill']->BuyerName ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Địa chỉ</td>
                    <td>
                        <?php echo $data['bill']->BuyerName ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-2">Số tài khoản</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="col-2">Hình thức thanh toán</td>
                    <td class="row">
                        <div class="col-7">
                            <?php echo $data['bill']->PaymentMethod ?>
                        </div>
                        <div class="col-3">Mã số thuế: <?php echo $data['bill']->BuyerTaxCode ?></div>
                    </td>
                </tr>

            </table>
        </div>

        <div>
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th>Tên hàng hóa</th>
                    <th>Đơn vị tính</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6=5x4</th>
                </tr>
                <?php
                if (isset($data['listItem']) && is_array($data['listItem'])) {
                    foreach ($data['listItem'] as $index => $item) {
                        echo '<tr>
            <td> ' . ($index + 1) . ' </td>
            <td>
                <p class="form-control-static">' . htmlspecialchars($item->ItemDescription) . '</p>
            </td>
            <td>
                <p class="form-control-static">' . htmlspecialchars($item->unit) . '</p>
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

        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>Thuế suất VAT: <?php echo $data['bill']->TaxRate?>%</p>
                </div>
                <div class="col-6">
                    <table class="">
                        <tr>
                            <td class="col-4 text-right">Tổng tiền hàng: </td>
                            <td>
                                <?php echo $data['bill']->SubTotal?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4 text-right">Tiền thuế: </td>
                            <td>
                                <?php echo $data['bill']->TaxAmount?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4 text-right">Tổng tiền thanh toán: </td>
                            <td>
                                <?php echo $data['bill']->TotalAmount?>
                            </td>
                        </tr>

                    </table>
                </div>

            </div>
        </div>

        <div class="container">
            <p class="font-weight-bold">Số tiền băng chữ: <?php echo convert_number_to_words($data['bill']->TotalAmount) ?></p>
        </div>


    </div>
</div>