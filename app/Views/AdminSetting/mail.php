<h3 class="m-auto"> Mẫu email</h3>

<div class="btn-group float-end">
    <button type="button" class="btn btn-success addJS" onclick="AddEdit(0)">
        <i class="fa-solid fa-plus"></i>
    </button>
</div>
<div class="container">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Tên mẫu</th>
            <th>Nội dung</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data['data'] as $item) {
            echo '
                <tr>
                    <td>
                        <div class="form-group">
                            <input class="form-control" disabled id="name_' . $item->id . '" value="' . $item->name . '">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control" disabled id="content_' . $item->id . '">' . htmlentities($item->content, ENT_QUOTES, 'UTF-8') . '</textarea>
                        </div>
                    </td>
                    <td style="width: 3em">
                        <div class="btn-group w-25">
                            <span class="btn btn-warning" onclick="AddEdit(' . $item->id . ')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span class="btn btn-success saveJS_' . $item->id . ' d-none" onclick="Save(' . $item->id . ')">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span class="btn btn-danger" onclick="Delete(' . $item->id . ')">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                            
                        </div>
                    </td>
                </tr>
                ';
        }
        ?>
        </tbody>
    </table>
</div>


<script>

    function AddEdit(id){
        if(editorCK){
            editorCK.destroy()
        }

        if(id == 0){

            const html = `
        <tr>
                    <td>
                        <div class="form-group">
                            <input class="form-control" disabled id="name_0" value="">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <textarea class="form-control" disabled id="content_0"></textarea>
                        </div>
                    </td>
                    <td style="width: 3em">
                        <div class="btn-group">
                            <span class="btn btn-warning" onclick="AddEdit(0)">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <span class="btn btn-success saveJS_0' d-none" onclick="Save(0)">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </span>
                            <span class="btn btn-danger" onclick="Delete(0)">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                    </td>
                </tr>
    `;
            document.querySelector('tbody').insertAdjacentHTML('afterbegin', html);

            configureCKEditor(`#content_0`, this, '')

        }else{
            fetch("/admin-get-mail-id?id="+id)
                .then(res=>res.text())
                .then(content=>{
                    configureCKEditor(`#content_${id}`, this, content)
                })
        }

        $("#content_"+id).removeClass("d-none")
        $(`#name_${id}`).prop("disabled", false)
        $(".saveJS_"+id).removeClass('d-none')
        $(".addJS").addClass('d-none')
    }

    function Save(id) {
        editorCK.destroy()
        $(".saveJS_"+id).addClass('d-none')
        $(`#name_${id}`).prop("disabled", true)
        $(".addJS").removeClass('d-none')

        let formData = new FormData()
        formData.append("id", id)
        formData.append("name", $(`#name_${id}`).val())
        formData.append("content", ckText)

        fetch('/admin-save-mail',{
            method:"POST",
            body:formData
        })
    }

    function Delete(id){
        fetch("/admin-delete-mail?id=" + id)
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

</script>