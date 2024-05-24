<?php

class AdminUser extends Controller
{
    protected $modelUser;
    protected $modelRole;

    function __construct()
    {
        $this->modelUser = $this->model("UserModel");
        $this->modelRole = $this->model("RoleModel");
    }

    function index()
    {
        if(!$this->CheckPermission("listUser")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminUser/index']);
    }

    function getUser()
    {

        try {
            $draw = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : null;
            $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : null;
            $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : null;

            $orderColumnIndex = isset($_REQUEST['order'][0]['column']) ? $_REQUEST['order'][0]['column'] : null;
            $sortColumn = isset($_REQUEST['columns'][$orderColumnIndex]['name']) ? $_REQUEST['columns'][$orderColumnIndex]['name'] : null;
            $sortColumnAscDesc = isset($_REQUEST['order'][0]['dir']) ? $_REQUEST['order'][0]['dir'] : null;
            $searchValue = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : null;
            if ($sortColumn === null) {
                $sortColumn = 'id';
                $sortColumnAscDesc = 'asc';
            }
            $pageSize = $length !== null ? (int)$length : 0;
            $skip = $start !== null ? (int)$start : 0;
            // lấy dữ liệu từ db
            $roles = $this->modelRole->getRole();
            $gridItems = $this->modelUser->GetAllUser($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);
            //gán role
            foreach ($gridItems as &$item) {
                $roleId = $item->roleId;
                $roleName = '';
                foreach ($roles as $role) {
                    if ($role->id == $roleId) {
                        $roleName = $role->name;
                        break;
                    }
                }
                $item->role = $roleName;
            }


            echo json_encode([
                'draw' => $draw,
                'recordsFiltered' => count($gridItems),
                'recordsTotal' => count($gridItems),
                'data' => $gridItems
            ]);
        }catch (Exception $exception){
            echo json_encode([
                'draw' => "null",
                'recordsFiltered' => 0,
                'recordsTotal' => 0,
                'data' => [],
            ]);
        }
    }

    function getUserById()
    {
        $userId = intval($_POST["id"]);
        $user = $this->modelUser->GetUserById($userId);
        echo json_encode($user);

    }

    function SaveUser()
    {
        if(!$this->CheckPermission("addEditUser")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }


        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $userId = intval($data['id']);
            $tax_code = $data['tax_code'];
            $user_name = $data['user_name'];
            $password = $data['password'];
            $roleId = intval($data['roleId']);


            try {
                if ($userId == 0) {
                    $this->modelUser->createUser($tax_code, $user_name, trim(md5($password)), $roleId);
                } else {
                    $this->modelUser->updateUser($userId, $tax_code, $user_name, trim(md5($password)), $roleId);
                }
                echo json_encode([
                    'status' => 200,
                    'message' => 'Tạo thành công user'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 500,
                    'message' => "Tạo thất bại"
                ]);
            }


        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'User has been not create'
            ]);
        }
    }

    function DeleteUser()
    {
        if(!$this->CheckPermission("deleteUser")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }

        $check = $this->modelUser->DeleteUser($_GET['id']);
        if ($check) {
            echo json_encode([
                'status' => 200,
                'message' => 'Xóa thành công'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Xóa thất bại'
            ]);
        }
    }
    function SavePermission()
    {

        $userId = intval($_POST["userId"]);
        $permission = $_POST["permission"];
        var_dump($permission);
        $this->modelUser->updatePermission($userId, $permission);

    }
    function ViewUser()
    {
        $id = $_GET['id'];
        $data = $this->modelUser->GetUserById($id);
        $role_name = $this->modelRole->GetRoleId($data->roleId);
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminUser/detail', 'user'=>$data, 'role'=>$role_name] );
    }

}