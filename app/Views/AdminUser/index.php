<h3 class="m-auto"> Quản lý người dùng</h3>

<div class="mt-4">
    <div class="btn-group gap-2">
        <button type="button" class="btn btn-success" onclick="AddEdit(0)">
            <i class="fa-solid fa-user-plus"></i>
        </button>
        <button type="button" class="btn btn-primary">Role</button>
    </div>
    <div class="container">
        <table class="table" id="table_user">
            <thead>
            <tr>
                <td>STT</td>
                <td>Mã số thuế</td>
                <td>Tên đăng nhập</td>
                <td>Role</td>
                <td></td>
            </tr>
            </thead>
        </table>
    </div>
</div>

<!--user-->
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
                    <label for="tax_code" class="form-label">Mã số thuế </label>
                    <input class="form-control" name="tax_code" id="tax_code"/>
                </div>

                <div class="form-group">
                    <label for="user_name" class="form-label">Tên đăng nhập</label>
                    <input class="form-control" name="user_name" id="user_name"/>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mật khẩu </label>
                    <input class="form-control" name="password" id="password" type="password"/>
                </div>

                <div class="form-group">
                    <label for="roleId" class="form-label">Mã số thuế </label>
                    <select name="roleId" class="form-control" id="roleId">
                        <option disabled selected>--vui lòng chọn--</option>
                    </select>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Lưu</button>
                <button type="button" class="btn btn-primary" onclick="Save()">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>

    function Save(){
        let userId = $("#id").val()
        let tax_code = $("#tax_code").val()
        let user_name = $("#user_name").val()
        let password = $("#password").val()
        let roleId = $("#roleId").val()

        fetch("/admin-save-user",{
            method:"POST",
            headers:{
                'Content-Type': 'application/json'
            },
            body:JSON.stringify({
                "id":userId,
                "tax_code":tax_code,
                "user_name":user_name,
                "password":password,
                "roleId":roleId
            })
        })
            .then(res=>res.json())
            .then(res=>{
                if (res.status == 200) {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Xóa thành công",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(r => {
                        $("#table_user").DataTable().ajax.reload();
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

    async function  AddEdit(id) {

        if(id == 0){
            $("#exampleModalLabel").text("Thêm người dùng")
            $("#password").prop("disabled", false);
            $("#id").val(0)
            $("#tax_code").val("")
            $("#user_name").val("")
            $("#roleId").val(0)
        }else{
            $("#exampleModalLabel").text("Cập nhật người dùng");

            let formData = new FormData();
            formData.append('id', id);
            const res = await fetch("/admin-get-user-id",{
                method:"POST",
                body:formData
            })
            const resJson = await res.json()

            console.log(resJson)
            $("#id").val(resJson.id)
            $("#tax_code").val(resJson.tax_code)
            $("#password").prop("disabled", true);
            $("#user_name").val(resJson.user_name)
            $("#roleId").val(resJson.roleId)

        }

        $("#exampleModal").modal("show");
    }

    function Delete(id) {
        fetch("/admin-delete-user?id=" + id)
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
                        $("#table_user").DataTable().ajax.reload()
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

        $("#table_user").DataTable({
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
                url: '/admin-get-user',
                "datatype": "json"
            },
            columns: [
                {"data": "id", "name": "id"},
                {"data": "tax_code", "name": "tax_code"},
                {"data": "user_name", "name": "user_name"},
                {
                    data: "roleId",
                    name: "roleId",
                    render: function (data, type, row) {
                        return row.role;
                    },
                    orderable: true

                },
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

        fetch("/get-role")
            .then(res=>res.json())
            .then(roles=>{
                roles.forEach(function(role) {
                    $('#roleId').append($('<option>', {
                        value: role.id,
                        text: role.name
                    }));
                });
            })


    })

</script>