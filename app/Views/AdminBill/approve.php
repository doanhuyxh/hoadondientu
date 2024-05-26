<h2>Phê duyệt hóa đơn</h2>

<div class="container-fluid mt-5">

    <a href="/admin-create-bill" class="btn btn-success">Thêm hóa đơn mới</a>

    <div class="table-responsive">
        <table class="table" id="table_bill">
            <thead>
            <tr>
                <td class="text-nowrap">Ngày lập hóa đơn</td>
                <td class="text-nowrap">Số hóa đơn</td>
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

    function Accept(id) {
        fetch(`/admin-bill-approve-status?id=${id}&status=accept`)
            .then(es => es.json())
            .then(res => {
                console.log(res)
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Thành công",
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

    function Refuse(id) {
        fetch(`/admin-bill-approve-status?id=${id}&status=refuse`)
            .then(es => es.json())
            .then(res => {
                console.log(res)
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Thành công",
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
                data: function (d) {
                    d.status = 'pending';
                },
                "datatype": "json"
            },
            columns: [
                {"data": "InvoiceDate", "name": "InvoiceDate"},
                {"data": "InvoiceNumber", "name": "InvoiceNumber"},


                {"data": "IssuerName", "name": "IssuerName"},
                {
                    "data": "Status", "name": "Status",
                    "render": function (data, type, row) {
                        if(data =='Pending'){
                            return "Đang chờ"
                        }else {
                            return "Đã phê duyệt"
                        }
                    }
                },
                {
                    data: null, render: function (data, type, row) {

                        return "<a href='javascript:void(0)' class='btn btn-primary mx-1' onclick=View('" + row.id + "');>" +
                            '<i class="fa-solid fa-eye"></i>' +
                            "</a>" +
                            "<a href='javascript:void(0)' class='btn btn-success mx-1' onclick=Accept('" + row.id + "');>" +
                            '<i class="fa-solid fa-check"></i>' +
                            "</a>" +
                            "<a href='javascript:void(0)' class='btn btn-warning mx-1' onclick=Refuse('" + row.id + "');>" +
                            '<i class="fa-solid fa-xmark"></i>' +
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