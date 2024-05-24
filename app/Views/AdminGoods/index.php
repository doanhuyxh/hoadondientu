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
                <td>Tên hàng hóa</td>
                <td>Số lượng</td>
                <td>Đơn vị</td>
                <td>Nhà cung cấp</td>
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
                    <label for="name" class="form-label">Tên hàng hóa </label>
                    <input class="form-control" name="name" id="name"/>
                </div>
                <div class="form-group">
                    <label for="quantity" class="form-label">Số lượng </label>
                    <input class="form-control" name="quantity" type="number" id="quantity"/>
                </div>

                <div class="form-group">
                    <label for="unit" class="form-label">Đơn vị </label>
                    <input class="form-control" name="unit" id="unit"/>
                </div>

                <div class="form-group">
                    <label for="supplier" class="form-label">Nhà cung cấp </label>
                    <select class="form-control" name="supplier" id="supplier">
                        <option selected disabled>--vui lòng chọn</option>
                    </select>
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
        let quantity = $("#quantity").val()
        let unit = $("#unit").val()
        let supplier = $("#supplier").val()

        fetch("/admin-save-goods", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "id": Id,
                "name": name,
                "quantity": quantity,
                "unit": unit,
                "supplier": supplier,
            })
        })
            .then(res => res.json())
            .then(res => {
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Lưu thành công",
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
                        title:res.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            })
    }

    async function AddEdit(id) {
        if (id == 0) {
            $("#exampleModalLabel").text("Thêm hàng hóa")
            $("#id").val(0)
            $("#name").val("")
            $("#supplier").val('')
            $("#unit").val('')
            $("#quantity").val(0)
        } else {
            $("#exampleModalLabel").text("Cập nhật hàng hóa");

            let formData = new FormData();
            formData.append('id', id);
            const res = await fetch("/admin-get-goods-id", {
                method: "POST",
                body: formData
            })
            const resJson = await res.json()
            $("#id").val(resJson.id)
            $("#name").val(resJson.name)
            $("#supplier").val(resJson.supplier)
            $("#unit").val(resJson.unit)
            $("#quantity").val(resJson.quantity)

        }

        $("#exampleModal").modal("show");
    }

    function Delete(id) {
        fetch("/admin-delete-goods?id=" + id)
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
                        title:res.message,
                        showConfirmButton: false,
                        timer: 3000
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
                url: '/admin-get-goods',
                "datatype": "json"
            },
            columns: [
                {"data": "id", "name": "id"},
                {"data": "name", "name": "name"},
                {"data": "quantity", "name": "quantity"},
                {"data": "unit", "name": "unit"},
                {"data": "supplier", "name": "supplier"},
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

        fetch("/admin-get-supplier-item")
            .then(res=>res.json())
            .then(supplier=>{
                supplier.forEach(function(item) {
                    $('#supplier').append($('<option>', {
                        value: item.name,
                        text: item.name
                    }));
                });
            })
    })

</script>