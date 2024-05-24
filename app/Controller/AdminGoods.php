<?php

class AdminGoods extends Controller
{

    protected $modelGoods;
    public function __construct()
    {
        $this->modelGoods=$this->model("GoodsModel");
    }

    function index()
    {

        if(!$this->CheckPermission("listGoods")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }


        return $this->Views("Share/AdminLayout", ['subview' => 'AdminGoods/index']);
    }

    function getGoods()
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
            $gridItems = $this->modelGoods->GetAllGoods($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

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

    function getGoodsById()
    {
        $id = intval($_POST["id"]);
        $Supplier = $this->modelGoods->GetGoodsById($id);
        echo json_encode($Supplier);
    }

    function SaveGoods()
    {
        if(!$this->CheckPermission("addEditGoods")){
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
            $quantity = $data['quantity'];
            $unit = $data['unit'];
            $supplier = $data['supplier'];


            try {
                if ($id == 0) {
                    $this->modelGoods->CreateGoods($name, $unit, $quantity, $supplier);
                } else {
                    $this->modelGoods->UpdateGoods($id, $name, $unit, $quantity, $supplier);
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

    function DeleteGoods()
    {
        if(!$this->CheckPermission("deleteGoods")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }



        $check = $this->modelGoods->DeleteGoods($_GET['id']);
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