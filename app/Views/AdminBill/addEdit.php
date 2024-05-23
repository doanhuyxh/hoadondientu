<h2>Thông tin hóa đơn mới</h2>

<div class="container d-flex justify-content-center mt-5" id="appVue">
    <div class="form-group w-75 shadow-lg p-3 mb-5 bg-body rounded">

        <div class="mb-3">
            <label class="form-label">Số hóa đơn</label>
            <input class="form-control" id="InvoiceNumber" name="InvoiceNumber" type="number">
        </div>

        <div class="mb-3">
            <label class="form-label">Ngày lập hóa đơn</label>
            <input class="form-control" id="InvoiceDate" name="InvoiceDate" type="date">
        </div>

        <div class="mb-3">
            <label class="form-label">Tên công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <input class="form-control" id="SellerName" name="SellerName" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <input class="form-control" id="SellerAddress" name="SellerAddress" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại công ty hoặc cá nhân <strong>(bán hàng)</strong></label>
            <input class="form-control" id="SellerPhone" name="SellerPhone" type="tel">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã số thuế công ty hoặc cá nhân <strong>(bán hàng)</strong> <strong>(nếu
                    có)</strong></label>
            <input class="form-control" id="SellerTaxCode" name="SellerTaxCode" type="tel">
        </div>

        <div class="mb-3">
            <label class="form-label">Tên công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <input class="form-control" id="BuyerName" name="BuyerName" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <input class="form-control" id="BuyerAddress" name="BuyerAddress" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại công ty hoặc cá nhân <strong>(mua hàng)</strong></label>
            <input class="form-control" id="BuyerPhone" name="BuyerPhone" type="tel">
        </div>

        <div class="mb-3">
            <label class="form-label">Mã số thuế công ty hoặc cá nhân <strong>(mua hàng)</strong> <strong>(nếu
                    có)</strong></label>
            <input class="form-control" id="BuyerTaxCode" name="BuyerTaxCode" type="tel">
        </div>

        <div class="mb-3">
            <label class="form-label">Thông tin sản phẩm và dịch vụ</label>
            <table class="table">
                <thead class="table-active">
                <tr>
                    <td>STT</td>
                    <td class="text-nowrap">Sản phẩm</td>
                    <td class="text-nowrap">Số lượng</td>
                    <td class="text-nowrap">Đơn giá</td>
                    <td class="text-nowrap">Tổng cộng</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, index) in itemInBill">
                    <td>{{index}}</td>
                    <td>
                        <input class="form-control" v-model="item.ItemDescription">
                    </td>
                    <td>
                        <input class="form-control" v-model="item.Quantity" type="number"
                               v-on:input="calculateTotalPrice(index)">
                    </td>
                    <td>
                        <input class="form-control" v-model="item.UnitPrice" type="number"
                               v-on:input="calculateTotalPrice(index)">
                    </td>
                    <td>
                        <input class="form-control" v-model="item.TotalPrice" disabled>
                    </td>
                    <td>
                        <span class="btn btn-danger" v-on:click="DeleteItem(index)">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5"></td>
                    <td>
                        <span class="btn btn-success" v-on:click="AddItem">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="mb-3">
            <label class="form-label">Tổng tiền truớc thuế</label>
            <input class="form-control" id="SubTotal" name="SubTotal" type="number" disabled v-model="totalAmount">
        </div>

        <div class="mb-3">
            <label class="form-label">Thuế suất (%)</label>
            <input class="form-control" id="TaxRate" name="TaxRate" type="number" v-model="TaxRate">
        </div>

        <div class="mb-3">
            <label class="form-label">Tiền thuế</label>
            <input class="form-control" id="TaxAmount" name="TaxAmount" type="number" v-model="taxAmount" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Tiền sau thuế</label>
            <input class="form-control" id="TotalAmount" name="TotalAmount" type="number" disabled>
        </div>


        <div class="mb-3">
            <label class="form-label">Phương thức thanh toán</label>
            <select class="form-control" id="PaymentMethod" name="PaymentMethod">
                <option disabled selected>--vui lòng chọn</option>
                <option value="Chuyển khoản">Chuyển khoản</option>
                <option value="Tiền mặt">Tiền mặt</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tên ngân hàng <strong>(nếu chuyển khoản)</strong></label>
            <input class="form-control" id="BankName" name="BankName" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Số tài khoản <strong>(nếu chuyển khoản)</strong></label>
            <input class="form-control" id="BankAccount" name="BankAccount" pattern="" type="text">
        </div>

        <div class="mb-3">
            <label class="form-label">Người lập hóa đơn</label>
            <input class="form-control" id="IssuerName" name="IssuerName" type="text">
        </div>

        <div class="mb-3 d-flex justify-content-center">
            <button class="btn btn-success w-25" v-on:click="Save">Lưu</button>
        </div>


    </div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    var appVue = new Vue({
        el: "#appVue",
        data: {
            itemInBill: [],
            TaxRate: 0,
            taxAmount: 0,
            totalAmount: 0
        },
        computed: {},
        watch: {
            itemInBill: {
                handler: function (newVal, oldVal) {
                    let total = 0;
                    for (let i = 0; i < newVal.length; i++) {
                        total += newVal[i].TotalPrice;
                    }
                    this.totalAmount = total;
                },
                deep: true
            },
            TaxRate: {
                handler(newVal, oldVal) {
                    this.taxAmount = this.totalAmount / 100 * newVal
                    let value = this.taxAmount + this.totalAmount
                    $("#TotalAmount").val(value)
                }
            }
        },
        methods: {
            AddItem() {
                this.itemInBill.push({
                    ItemDescription: "",
                    Quantity: 0,
                    UnitPrice: 0,
                    TotalPrice: 0
                })
            },
            DeleteItem(index) {
                this.itemInBill.splice(index, 1)
            },
            calculateTotalPrice(index) {
                const item = this.itemInBill[index];
                item.TotalPrice = item.UnitPrice * item.Quantity;
            },
            Save() {
                let formData = new FormData()
                formData.append("InvoiceNumber", $("#InvoiceNumber").val())
                formData.append("InvoiceDate", $("#InvoiceDate").val())

                formData.append("SellerName", $("#SellerName").val())
                formData.append("SellerAddress", $("#SellerAddress").val())
                formData.append("SellerPhone", $("#SellerPhone").val())
                formData.append("SellerTaxCode", $("#SellerTaxCode").val())

                formData.append("BuyerName", $("#BuyerName").val())
                formData.append("BuyerAddress", $("#BuyerAddress").val())
                formData.append("BuyerPhone", $("#BuyerPhone").val())
                formData.append("BuyerTaxCode", $("#BuyerTaxCode").val())

                formData.append("SubTotal", $("#SubTotal").val())
                formData.append("TaxRate", $("#TaxRate").val())
                formData.append("TaxAmount", $("#TaxAmount").val())
                formData.append("TotalAmount", $("#TotalAmount").val())
                formData.append("PaymentMethod", $("#PaymentMethod").val())
                formData.append("BankAccount", $("#BankAccount").val())
                formData.append("BankName", $("#BankName").val())
                formData.append("IssuerName", $("#IssuerName").val())

                formData.append("ItemInBill", JSON.stringify(this.itemInBill))

                $("#overlay").fadeIn();

                fetch("/admin-save-bill",{
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
                                window.location.href="/admin-bill"
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
        }
    })
</script>