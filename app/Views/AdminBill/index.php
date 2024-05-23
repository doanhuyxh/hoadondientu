<h2>Quản lý hóa đơn</h2>

<div class="container-fluid mt-5">

    <a href="/admin-create-bill" class="btn btn-success">Thêm hóa đơn mới</a>

    <div class="table-responsive">
        <table class="table" id="table_bill">
            <thead>
            <tr>
                <td class="text-nowrap">Số hóa đơn</td>
                <td class="text-nowrap">Ngày lập hóa đơn</td>
                <td class="text-nowrap">Tên <strong>(bán)</strong></td>
                <td class="text-nowrap">SĐT <strong>(bán)</strong></td>
                <td class="text-nowrap">Mã số thuế <strong>(bán)</strong></td>
                <td class="text-nowrap">Địa chỉ <strong>(bán)</strong></td>

                <td class="text-nowrap">Tên <strong>(mua)</strong></td>
                <td class="text-nowrap">SĐT <strong>(mua)</strong></td>
                <td class="text-nowrap">Mã số thuế <strong>(mua)</strong></td>
                <td class="text-nowrap">Địa chỉ <strong>(mua)</strong></td>

                <td class="text-nowrap">Tổng cộng trước thuế</td>
                <td class="text-nowrap">Thuế</td>
                <td class="text-nowrap">Tiền thuế</td>
                <td class="text-nowrap">Tổng thanh toán</td>

                <td class="text-nowrap">Kiểu thanh toán</td>
                <td class="text-nowrap">Ngân hàng</td>
                <td class="text-nowrap">Số tài khoản</td>
                <td class="text-nowrap">Người lập hóa đơn</td>
                <td class="text-nowrap">Trạng thái</td>
                <td></td>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>

    function Delete(id) {
        fetch("/admin-delete-bill?id=" + id)
            .then(es => es.json())
            .then(res => {
                console.log(res)
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Xóa thành công",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(r => {
                        $("#table_bill").DataTable().ajax.reload()
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

    function View(id) {
        window.location.href="/view-bill?id="+id
    }


    $(document).ready(() => {
        $("#table_bill").DataTable({
            paging: true,
            select: true,
            "order": [[0, "desc"]],
            dom: 'Bfrtip',

            buttons: [
                'pageLength',
            ],

            serverSide: true,

            "processing": true,
            "filter": true,
            "orderMulti": false,
            "stateSave": true,

            ajax: {
                url: '/admin-get-bill',
                "datatype": "json"
            },
            columns: [
                {"data": "InvoiceNumber", "name": "InvoiceNumber"},
                {"data": "InvoiceDate", "name": "InvoiceDate"},

                {"data": "SellerName", "name": "SellerName"},
                {"data": "SellerPhone", "name": "SellerPhone"},
                {"data": "SellerTaxCode", "name": "SellerTaxCode"},
                {"data": "SellerAddress", "name": "SellerAddress"},

                {"data": "BuyerName", "name": "BuyerName"},
                {"data": "BuyerPhone", "name": "BuyerPhone"},
                {"data": "BuyerTaxCode", "name": "BuyerTaxCode"},
                {"data": "BuyerAddress", "name": "BuyerAddress"},

                {"data": "TaxRate", "name": "TaxRate"},
                {"data": "SubTotal", "name": "SubTotal"},
                {"data": "TaxAmount", "name": "TaxAmount"},
                {"data": "TotalAmount", "name": "TotalAmount"},
                {"data": "PaymentMethod", "name": "PaymentMethod"},
                {"data": "BankName", "name": "BankName"},
                {"data": "BankAccount", "name": "BankAccount"},
                {"data": "IssuerName", "name": "IssuerName"},
                {"data": "Status", "name": "Status"},
                {
                    data: null, render: function (data, type, row) {

                        return "<a href='javascript:void(0)' class='btn btn-primary mx-1' onclick=View('" + row.id + "');>" +
                            '<i class="fa-solid fa-eye"></i>' +
                            "</a>" + "<a href='javascript:void(0)' class='btn btn-danger mx-1' onclick=Delete('" + row.id + "');>" +
                            '<i class="fa-solid fa-trash"></i>' +
                            "</a>";
                    }

                },

            ],
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }]

        });
    })
</script>