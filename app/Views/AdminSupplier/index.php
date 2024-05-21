<h3 class="m-auto"> Quản lý nhà cung cấp</h3>

<div class="mt-4">
    <div class="btn-group gap-2">
        <button type="button" class="btn btn-success" onclick="AddEdit(0)">
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <div class="container">
        <table class="table" id="table_category">
            <thead>
            <tr>
                <td>STT</td>
                <td>Tên nhà cung cấp</td>
                <td>Số điện thoại</td>
                <td>Email</td>
                <td>Địa chỉ</td>
                <td></td>
            </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control" name="id" type="number" id="id" hidden/>
                <div class="form-group">
                    <label for="name" class="form-label">Tên nhà cung cấp </label>
                    <input class="form-control" name="name" id="name"/>
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email </label>
                    <input class="form-control" name="email" id="email"/>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Số điện thoại </label>
                    <input class="form-control" name="phone" id="phone"/>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Địa chỉ </label>
                    <input class="form-control" name="address" id="address"/>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="Save()">Lưu</button>
            </div>
        </div>
    </div>
</div>


<script>

    function Save() {
        let Id = $("#id").val()
        let name = $("#name").val()
        let phone = $("#phone").val()
        let email = $("#email").val()
        let address = $("#address").val()

        fetch("/admin-save-supplier", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "id": Id,
                "name": name,
                "email":email,
                "phone":phone,
                "address":address
            })
        })
            .then(res => res.json())
            .then(res => {
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Xóa thành công",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(r => {
                        $("#table_category").DataTable().ajax.reload();
                        $("#exampleModal").modal("hide");
                    });
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
    }

    async function AddEdit(id) {
        if (id == 0) {
            $("#exampleModalLabel").text("Thêm nhà cung cấp")
            $("#id").val(0)
            $("#name").val("")
            $("#phone").val('')
            $("#email").val('')
            $("#address").val('')
        } else {
            $("#exampleModalLabel").text("Cập nhật nhà cung cấp");

            let formData = new FormData();
            formData.append('id', id);
            const res = await fetch("/admin-get-supplier-id", {
                method: "POST",
                body: formData
            })
            const resJson = await res.json()
            $("#id").val(resJson.id)
            $("#name").val(resJson.name)
            $("#phone").val(resJson.phone)
            $("#email").val(resJson.email)
            $("#address").val(resJson.address)

        }

        $("#exampleModal").modal("show");
    }

    function Delete(id) {
        fetch("/admin-delete-supplier?id=" + id)
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
                        position: "top-end",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })
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
                url: '/admin-get-supplier',
                "datatype": "json"
            },
            columns: [
                {"data": "id", "name": "id"},
                {"data": "name", "name": "name"},
                {"data": "phone", "name": "phone"},
                {"data": "email", "name": "email"},
                {"data": "address", "name": "address"},
                {
                    data: null, render: function (data, type, row) {

                        return "<a href='javascript:void(0)' class='btn btn-primary mx-1' onclick=AddEdit('" + row.id + "');>" +
                            '<i class="fa-solid fa-pen-to-square"></i>' +
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