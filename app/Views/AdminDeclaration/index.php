<h2>Quản lý hóa đơn</h2>

<div class="container-fluid mt-5">

    <a href="/admin-declaration-create" class="btn btn-success">Thêm tờ khai mới</a>

    <div class="table-responsive">
        <table class="table" id="table_category">
            <thead>
            <tr>
                <td class="text-nowrap">Họ tên</td>
                <td class="text-nowrap">CMND/CCCD</td>
                <td class="text-nowrap">Email</td>
                <td class="text-nowrap">SĐT</td>
                <td class="text-nowrap">Địa chỉ</td>
                <td class="text-nowrap">Ngày nộp</td>

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
        fetch("/admin-delete-declaration?id=" + id)
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
                        $("#table_category").DataTable().ajax.reload()
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
        window.location.href="/view-declaration?id="+id
    }


    $(document).ready(() => {
        $("#table_category").DataTable({
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
                url: '/admin-get-declaration',
                "datatype": "json"
            },
            columns: [
                {"data": "full_name", "name": "full_name"},
                {"data": "personal_id", "name": "personal_id"},
                {"data": "email", "name": "email"},
                {"data": "phone_number", "name": "phone_number"},
                {"data": "filing_date", "name": "filing_date"},
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