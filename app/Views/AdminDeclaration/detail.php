<h2>Thông tin tờ khai</h2>

<div class="container d-flex justify-content-center mt-5" id="appVue">
    <div class="form-group w-75 shadow-lg p-3 mb-5 bg-body rounded">
        <input type="hidden" id="id" name="id" value="0">
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <p class="form-control"> <?php echo $data['data']->full_name ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số CMND/CCCD</label>
            <p class="form-control"> <?php echo $data['data']->personal_id ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày sinh</label>
            <p class="form-control"> <?php echo $data['data']->date_of_birth ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <p class="form-control"> <?php echo $data['data']->address ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <p class="form-control"> <?php echo $data['data']->phone_number ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <p class="form-control"> <?php echo $data['data']->email ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Nghề nghiệp</label>
            <p class="form-control"> <?php echo $data['data']->occupation ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên đơn vị công tác</label>
            <p class="form-control"> <?php echo $data['data']->employer_name ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công tác</label>
            <p class="form-control"> <?php echo $data['data']->employer_address ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Thu nhập hàng năm</label>
            <p class="form-control"> <?php echo $data['data']->annual_income ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Các khoản giảm trừ</label>
            <textarea class="form-control" disabled><?php echo $data['data']->tax_deductions ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thu nhập chịu thuế</label>
            <p class="form-control"> <?php echo $data['data']->taxable_income ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Thuế(%)</label>
            <p class="form-control"> <?php echo $data['data']->tax_rate ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Số tiền thuế phải nộp</label>
            <p class="form-control"> <?php echo $data['data']->tax_amount ?> </p>
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày nộp tờ khai</label>
            <p class="form-control"> <?php echo $data['data']->filing_date ?> </p>
        </div>


    </div>
</div>