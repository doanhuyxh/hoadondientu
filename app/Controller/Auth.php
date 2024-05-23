<?php
class Auth extends Controller
{
    protected $modelUser;
    protected $modelRole;

    function __construct()
    {
        $this->modelUser = $this->model("AuthModel");
        $this->modelRole = $this->model("RoleModel");
    }

    public function Login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["userName_lg"];
            $password = $_POST["password_lg"];


            try {

                $data = $this->modelUser->GetUser(trim($username), trim(md5($password)));
                var_dump($data);


                if (isset($data)) {
                    $_SESSION["username"] = $username;
                    $_SESSION["tax_code"] = $data->tax_code;
                    $role_name = $this->modelRole->GetRoleId($data->roleId);
                    $_SESSION["role_name"] = $role_name->name;

                    if($role_name->name === "admin"){
                        header('Location: ' . _WEB_ROOT . '/admin');
                        die();
                    }else{
                    header('Location: ' . _WEB_ROOT . '/trang-chu');
                        die();
                    }
                } else {
                    session_destroy();                    
                    return $this->Views("Share/Layout", ['subview' => 'Home/index', 'error'=> true, 'user'=> $username, 'pass'=> $password]);
                }
            } catch (Exception $ex) {
                echo 123123;
                die();
                session_destroy();
                return $this->Views("Share/Layout", ['subview' => 'Home/index', 'error'=> true, 'user'=> $username, 'pass'=> $password]);
            }
        }

        header('Location: ' . _WEB_ROOT . '/trang-chu');
    }

    public function LogOut()
    {
        session_destroy();
        header('Location: ' . _WEB_ROOT . '/trang-chu');
    }

    public function Signin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $userName = $_POST["userName"];
            $password = $_POST["password"];
            $roleId = $_POST["role"];

           $this->modelUser->createUser($name, $userName, trim(md5($password)), $roleId, "");
            header('Location: ' . _WEB_ROOT . '/trang-chu');
        } else {
            header('Location: ' . _WEB_ROOT . '/trang-chu');
        }
    }

    public function getRole()
    {
        $data =  $this->modelRole->GetRole();
        echo json_encode($data);
        die;
    }
}
