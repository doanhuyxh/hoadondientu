<h2>Chi tiết user</h2>

<div class="container d-flex justify-content-center mt-5">
    <div class="form-group w-75 shadow-lg p-3 mb-5 bg-body rounded">
        <table class="table">
            <tr>
                <th class="text-nowrap">Mã số thuế</th>
                <td class="text-nowrap"><?php echo $data['user']->tax_code; ?></td>
            </tr>
            <tr>
                <th class="text-nowrap">Tên đăng nhập</th>
                <td class="text-nowrap"><?php echo $data['user']->user_name; ?></td>
            </tr>
            <tr>
                <th>role</th>
                <td><?php echo $data['role']->name; ?></td>
            </tr>
            <tr>
                <th class="text-nowrap">Quyền hạn</th>
                <td class="d-flex flex-wrap gap-3">
                    <div class="form-group">
                        <h5>User</h5>
                        <div class="form-check">
                            <input id="listUser" value="listUser" class="form-check-input" type="checkbox">
                            <label for="listUser" class="form-check-label">Xem</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditUser" value="addEditUser" class="form-check-input" type="checkbox">
                            <label for="addEditUser" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteUser" value="deleteUser" class="form-check-input" type="checkbox">
                            <label for="deleteUser" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Mẫu email</h5>
                        <div class="form-check">
                            <input id="listEmail" value="listEmail" class="form-check-input" type="checkbox">
                            <label for="listEmail" class="form-check-label">Xem</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditEmail" value="addEditCustomer" class="form-check-input" type="checkbox">
                            <label for="addEditEmail" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteEmail" value="deleteEmail" class="form-check-input" type="checkbox">
                            <label for="deleteEmail" class="form-check-label">xóa mẫu</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Khách hàng</h5>
                        <div class="form-check">
                            <input id="listCustomer" value="listCustomer" class="form-check-input" type="checkbox">
                            <label for="listCustomer" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditCustomer" value="addEditCustomer" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditCustomer" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteCustomer" value="deleteCustomer" class="form-check-input" type="checkbox">
                            <label for="deleteCustomer" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Mhà cung cấp</h5>
                        <div class="form-check">
                            <input id="listSupplier" value="listSupplier" class="form-check-input" type="checkbox">
                            <label for="listSupplier" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditSupplier" value="addEditSupplier" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditSupplier" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteSupplier" value="deleteSupplier" class="form-check-input" type="checkbox">
                            <label for="deleteSupplier" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Mhà cung cấp</h5>
                        <div class="form-check">
                            <input id="listSupplier" value="listSupplier" class="form-check-input" type="checkbox">
                            <label for="listSupplier" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditSupplier" value="addEditSupplier" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditSupplier" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteSupplier" value="deleteSupplier" class="form-check-input" type="checkbox">
                            <label for="deleteSupplier" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Hàng hóa</h5>
                        <div class="form-check">
                            <input id="listGoods" value="listGoods" class="form-check-input" type="checkbox">
                            <label for="listGoods" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditGoods" value="addEditGoods" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditGoods" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteGoods" value="deleteGoods" class="form-check-input" type="checkbox">
                            <label for="deleteGoods" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Tỷ giá</h5>
                        <div class="form-check">
                            <input id="listExchangeRate" value="listExchangeRate" class="form-check-input"
                                   type="checkbox">
                            <label for="listExchangeRate" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditExchangeRate" value="addEditExchangeRate" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditExchangeRate" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteExchangeRate" value="deleteExchangeRate" class="form-check-input"
                                   type="checkbox">
                            <label for="deleteExchangeRate" class="form-check-label">xóa</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>Cấp số</h5>
                        <div class="form-check">
                            <input id="listNumber" value="listNumber" class="form-check-input" type="checkbox">
                            <label for="listNumber" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditNumber" value="addEditNumber" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditNumber" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteNumber" value="deleteNumber" class="form-check-input" type="checkbox">
                            <label for="deleteNumber" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Tờ khai</h5>
                        <div class="form-check">
                            <input id="listDeclaration" value="listDeclaration" class="form-check-input"
                                   type="checkbox">
                            <label for="listDeclaration" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditDeclaration" value="addEditDeclaration" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditDeclaration" class="form-check-label">tạo, cập nhật</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteDeclaration" value="deleteDeclaration" class="form-check-input"
                                   type="checkbox">
                            <label for="deleteDeclaration" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Hóa đơn</h5>
                        <div class="form-check">
                            <input id="listBill" value="listBill" class="form-check-input" type="checkbox">
                            <label for="listBill" class="form-check-label">Xem danh sách</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditBill" value="addEditBill" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditBill" class="form-check-label">tạo</label>
                        </div>
                        <div class="form-check">
                            <input id="ApproveBill" value="ApproveBill" class="form-check-input"
                                   type="checkbox">
                            <label for="ApproveBill" class="form-check-label">Phê duyệt</label>
                        </div>
                        <div class="form-check">
                            <input id="deleteBill" value="deleteBill" class="form-check-input" type="checkbox">
                            <label for="deleteBill" class="form-check-label">xóa</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Cấu hình hệ thống</h5>
                        <div class="form-check">
                            <input id="listSetting" value="listSetting" class="form-check-input" type="checkbox">
                            <label for="listSetting" class="form-check-label">Xem</label>
                        </div>
                        <div class="form-check">
                            <input id="addEditSetting" value="addEditSetting" class="form-check-input"
                                   type="checkbox">
                            <label for="addEditSetting" class="form-check-label">Cập nhật</label>
                        </div>
                    </div>

                </td>
            </tr>
        </table>
        <div class="w-100 d-flex">
            <button class="btn btn-success w-25 m-auto" onclick="Save()">Lưu</button>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        let checked = '<?php echo $data['user']->permission; ?>'
        $.each(JSON.parse(checked), function (index, value) {
            $('input[type="checkbox"][value="' + value + '"]').prop('checked', true);
        });
    })

    function Save() {
        let checkedValues = [];
        $('input[type="checkbox"]:checked').each(function () {
            checkedValues.push($(this).val());
        });
        let formData = new FormData();
        formData.append("userId", '<?php echo $data['user']->id; ?>');
        formData.append("permission", JSON.stringify(checkedValues));
        fetch('/admin-save-permission', {
            method: "POST",
            body: formData
        })
    }
</script>