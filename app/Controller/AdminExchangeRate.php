<?php

class AdminExchangeRate extends Controller
{

    protected $modelExchangeRate;
    public function __construct()
    {
        $this->modelExchangeRate=$this->model("ExchangeRateModel");
    }

    function index()
    {
        if(!$this->CheckPermission("listExchangeRate")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminExchangeRate/index']);
    }

    function getExchangeRate()
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
            $gridItems = $this->modelExchangeRate->GetAllExchangeRate($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

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

    function getExchangeRateById()
    {
        $id = intval($_POST["id"]);
        $Supplier = $this->modelExchangeRate->GetExchangeRateById($id);
        echo json_encode($Supplier);
    }

    function SaveExchangeRate()
    {
        if(!$this->CheckPermission("addEditExchangeRate")){
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
            $rate = $data['rate'];


            try {
                if ($id == 0) {
                    $this->modelExchangeRate->CreateExchangeRate($name, $rate);
                } else {
                    $this->modelExchangeRate->UpdateExchangeRate($id, $name, $rate);
                }
                echo json_encode([
                    'status' => 200,
                    'message' => 'ExchangeRate has been created'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 500,
                    'message' => $e
                ]);
            }


        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'ExchangeRate has been not create'
            ]);
        }
    }

    function DeleteExchangeRate()
    {
        if(!$this->CheckPermission("deleteExchangeRate")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }


        $check = $this->modelExchangeRate->DeleteExchangeRate($_GET['id']);
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