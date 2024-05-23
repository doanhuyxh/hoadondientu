<h3>Cấu hình web</h3>

<div class="container-fluid mt-5 gap-5">

    <div class="form-group d-flex">
        <label class="form-label mx-2">Title</label>
        <input class="form-control" id="title" name="title" value="<?php echo $data['title'] ?>">
    </div>

    <div class="form-group">
        <label class="form-label mx-2">JavaScript nhúng</label>
        <textarea class="form-control" name="script" id="script">
                <?php echo $data['script'] ?>
        </textarea>
    </div>


    <div class="form-group">
        <label class="form-label mx-2">CSS nhúng</label>
        <textarea class="form-control" name="css" id="css">
            <?php echo $data['css'] ?>
        </textarea>
    </div>

    <div class="form-group float-end">
        <button class="btn btn-success" onclick="Save()">Lưu</button>
    </div>


</div>

<script>

    function Save() {

        let formData = new FormData()

        formData.append("title", $("#title").val())
        formData.append("css", $("#css").val())
        formData.append("script", $("#script").val())

        fetch("/admin-save-key", {
            method: "POST",
            body: formData
        })
    }

</script>