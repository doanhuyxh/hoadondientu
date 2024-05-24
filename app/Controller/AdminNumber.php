<?php

class AdminNumber extends Controller
{
    protected $modelNumber;
    public function __construct()
    {
        $this->modelNumber = $this->model("NumberModel");
    }

    function index()
    {
        if(!$this->CheckPermission("listNumber")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminNumber/index']);
    }

    function getNumber()
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
            $gridItems = $this->modelNumber->GetNumber($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

            echo json_encode([
                'draw' => $draw,
                'recordsFiltered' => count($gridItems),
                'recordsTotal' => count($gridItems),
                'data' => $gridItems
            ]);
        } catch (Exception $exception) {
            echo json_encode([
                'draw' => "null",
                'recordsFiltered' => 0,
                'recordsTotal' => 0,
                'data' => [],
            ]);
        }
    }

    function getNumberById()
    {
        $id = intval($_POST["id"]);
        $number = $this->modelNumber->GetNumberById($id);
        echo json_encode($number);
    }

    function SaveNumber()
    {
        if(!$this->CheckPermission("addEditNumber")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }



        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $id = intval($data['id']);
            $name = $data['name'];


            try {
                if ($id == 0) {
                    $this->modelNumber->createNumber($name);
                } else {
                    $this->modelNumber->UpdateNumber($id, $name);
                }
                echo json_encode([
                    'status' => 200,
                    'message' => 'Tạo thành công'
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
                'message' => 'Tạo thất bại'
            ]);
        }
    }

    function DeleteNumber()
    {
        if(!$this->CheckPermission("deleteNumber")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }


        $check = $this->modelNumber->DeleteNumber($_GET['id']);
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
}