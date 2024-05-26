<?php
$fields = [
    'origin' => 'Tên đơn vị',
    'under' => 'Trực thuộc',
    'mst' => 'Mã số thuế',
    'mail' => 'Email',
    'city' => 'Thành phố',
    'address' => 'Địa chỉ',
    'account' => 'Tài khoản',
    'cqt_cap_tren' => 'Cơ quan thuế cấp trên',
    'mst_cap_hd' => 'Mã số thuế cấp hợp đồng',
    'phone' => 'Số điện thoại',
    'district' => 'Quận/Huyện',
    'wards' => 'Phường/Xã',
    'bank_name' => 'Ngân hàng',
    'cqt' => 'Cơ quan thuế'
];
?>


<h3>Cấu hình web</h3>

<div class="container-fluid mt-5">

    <div class="row gap-5">
        <?php foreach ($fields as $key => $label): ?>
            <div class="col-3 shadow-lg rounded">
                <div class="form-group">
                    <label class="form-label text-nowrap"><?php echo $label; ?></label>
                    <input class="form-control" id="<?php echo $key; ?>" name="<?php echo $key; ?>"
                           value="<?php echo $data[$key]; ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="form-group float-end">
        <button class="btn btn-success" onclick="Save()">Lưu</button>
    </div>


</div>

<script>

    function Save() {
        let formData = new FormData()
        document.querySelectorAll('.form-control').forEach(input => {
            formData.append(input.name, input.value);
        });

        fetch("/admin-save-key", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(res => {
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(r => {
                        $("#table_bill").DataTable().ajax.reload()
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
    }

</script>