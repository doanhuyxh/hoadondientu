
<!-- Modal -->
<div class="modal fade" id="loginForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginFormLabel">Đăng nhập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formBx">
                    <form action="/dang-nhap" method="post">
                        <div class="mb-3">
                            <label for="userName_lg" class="form-label">Tên đăng nhập</label>
                            <input type="text" name="userName_lg" class="form-control" id="userName_lg" placeholder="user789">
                        </div>
                        <div class="mb-3">
                            <label for="password_lg" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password_lg" id="password_lg" >
                        </div>
                        <input type="submit" name="" value="Đăng nhập" />
                        <p class="signup">
                            Bạn chưa có tài khoản?
                            <a href="#" onclick="toggleForm();">Đăng ký</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="registerForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerFormLabel">Đăng ký</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formBx">
                    <form action="/dang-ky" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Mã số thuế</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="87422312348">
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" name="userName" id="userName" placeholder="user789">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" id="password" >
                        </div>
                        <div class="mb-3">
                            <label for="rePassword" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" onkeyup="CheckPass()" id="rePassword" >
                            <span class="text-danger" style="display: none" id="error_pass">Mật khẩu không khớp</span>
                        </div>

                        <input name="role" id="role" value="2" hidden>

                        <input type="submit" id="btn_dangKy" value="Đăng Ký" />
                        <p class="signup">
                            Bạn đã có tài khoản?
                            <a href="#" onclick="toggleForm();">Đăng nhập</a>
                        </p>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleForm() {
        $('#loginForm').modal('toggle');
        $('#registerForm').modal('toggle');
    }

    function CheckPass(){
        let pass = $("#password").val()
        let re_pass = $("#rePassword").val()

        if(pass != re_pass){
            $("#error_pass").show()
            $("#btn_dangKy").attr("disabled", true)
        }else{
            $("#error_pass").hide()
            $("#btn_dangKy").attr("disabled", false)
        }
    }

    // Initialize modals as hidden
    $(document).ready(function() {
        $('#loginForm').modal({ show: false });
        $('#registerForm').modal({ show: false });

        fetch("/get-role")
            .then(res=>res.json())
            .then(roles=>{
                roles.forEach(function(role) {
                    $('#role').append($('<option>', {
                        value: role.id,
                        text: role.name
                    }));
                });
            })

    });
</script>