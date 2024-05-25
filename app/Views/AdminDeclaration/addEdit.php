<h2>Thông tin tờ khai mới</h2>

<div class="container d-flex justify-content-center mt-5" id="appVue">
    <div class="form-group w-75 shadow-lg p-3 mb-5 bg-body rounded">
        <input type="hidden" id="id" name="id" value="0">
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input class="form-control" id="full_name" name="full_name" type="text" placeholder="họ và tên">
        </div>

        <div class="mb-3">
            <label class="form-label">Số CMND/CCCD</label>
            <input class="form-control" id="personal_id" name="personal_id" type="text" placeholder="CMND/CCCD">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày sinh</label>
            <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="ngày sinh">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <input class="form-control" id="address" name="address" type="text" placeholder="địa chỉ">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input class="form-control" id="phone_number" name="phone_number" type="tel" placeholder="số điện thoại">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" id="email" name="email" type="email" placeholder="email">
        </div>

        <div class="mb-3">
            <label class="form-label">Nghề nghiệp</label>
            <input class="form-control" id="occupation" name="occupation" type="text" placeholder="Nghề ngiệp">
        </div>

        <div class="mb-3">
            <label class="form-label">Tên đơn vị công tác</label>
            <input class="form-control" id="employer_name" name="employer_name" type="text" placeholder="tên công ty">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công tác</label>
            <input class="form-control" id="employer_address" name="employer_address" type="text"
                   placeholder="địa chỉ công ty">
        </div>

        <div class="mb-3">
            <label class="form-label">Thu nhập hàng năm</label>
            <input class="form-control" id="annual_income" name="annual_income" type="number"
                   placeholder="thu nhập hàng năm">
        </div>

        <div class="mb-3">
            <label class="form-label">Các khoản giảm trừ</label>
            <textarea class="form-control" id="tax_deductions" name="tax_deductions"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Thu nhập chịu thuế</label>
            <input class="form-control" id="taxable_income" name="taxable_income" placeholder="thu nhập sau thuế">
        </div>

        <div class="mb-3">
            <label class="form-label">Thuế(%)</label>
            <input class="form-control" id="tax_rate" name="tax_rate" type="number" placeholder="% thuế">
        </div>

        <div class="mb-3">
            <label class="form-label">Số tiền thuế phải nộp</label>
            <input class="form-control" id="tax_amount" name="tax_amount" type="number" placeholder="tiền thuế">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày nộp tờ khai</label>
            <input class="form-control" id="filing_date" name="filing_date" type="date">
        </div>

        <div class="mb-3 d-flex justify-content-center">
            <button class="btn btn-success w-25" onclick="Save()">Lưu</button>
        </div>

    </div>
</div>
<script>
    var appVue = new Vue({
        el: "#appVue",
        data: {},
        computed: {},
        watch: {},
        methods: {}
    })

    function Save() {

        let id = $("#id").val()
        let full_name = $("#full_name").val()
        let personal_id = $("#personal_id").val()
        let date_of_birth = $("#date_of_birth").val()
        let address = $("#address").val()
        let phone_number = $("#phone_number").val()
        let email = $("#email").val()
        let occupation = $("#occupation").val()
        let employer_name = $("#employer_name").val()
        let employer_address = $("#employer_address").val()
        let annual_income = $("#annual_income").val()
        let tax_deductions = $("#tax_deductions").val()
        let taxable_income = $("#taxable_income").val()
        let tax_rate = $("#tax_rate").val()
        let tax_amount = $("#tax_amount").val()
        let filing_date = $("#filing_date").val()

        if (!full_name) {
            alert("Vui lòng điền họ tên");
            return
        }
        if (!personal_id) {
            alert("Vui lòng điền CMND/CCCD");
            return
        }
        if (!date_of_birth) {
            alert("Vui lòng điền ngày sinh");
            return
        }
        if (!address) {
            alert("Vui lòng điền địa chỉ");
            return
        }
        if (!phone_number) {
            alert("Vui lòng điền số điện thoại");
            return
        }
        if (!email) {
            alert("Vui lòng điền email");
            return
        }
        if (!occupation) {
            alert("Vui lòng điền nghề nghiệp");
            return
        }

        if (!employer_name) {
            alert("Vui lòng điền đơn vị công tác");
            return
        }
        if (!employer_address) {
            alert("Vui lòng điền địa chỉ công tác");
            return
        }
        if (!annual_income) {
            alert("Vui lòng điền thu nhập hàng năm sau thuế");
            return
        }
        if (!tax_deductions) {
            alert("Vui lòng điền các khoản giảm trừ");
            return
        }
        if (!tax_rate) {
            alert("Vui lòng điền % thuế");
            return
        }
        if (!tax_amount) {
            alert("Vui lòng điền số tiền thuế nộp");
            return
        }

        let formData = new FormData()
        formData.append("id", id)
        formData.append("full_name", full_name)
        formData.append("personal_id", personal_id)
        formData.append("date_of_birth", date_of_birth)
        formData.append("address", address)
        formData.append("phone_number", phone_number)
        formData.append("email", email)
        formData.append("occupation", occupation)
        formData.append("employer_name", employer_name)
        formData.append("employer_address", employer_address)
        formData.append("annual_income", annual_income)
        formData.append("tax_deductions", tax_deductions)
        formData.append("taxable_income", taxable_income)
        formData.append("tax_rate", tax_rate)
        formData.append("tax_amount", tax_amount)
        formData.append("filing_date", filing_date)

        fetch("/admin-save-declaration",{
            method:"POST",
            body:formData
        })
            .then(res=>res.json())
            .then(res=>{
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Thành công",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(r => {
                        window.location.href="/admin-declaration"
                    });
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Thất bại",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })


    }

</script>