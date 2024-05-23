<?php

class AdminCustomer extends Controller
{

    protected $CustomerModel;

    public function __construct()
    {
        $this->CustomerModel = $this->model("CustomerModel");
    }

    function index()
    {
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminCustomer/index']);
    }

    function getCustomer()
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
            $gridItems = $this->CustomerModel->GetAllCustomer($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

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

    function getCustomerById()
    {
        $id = intval($_POST["id"]);
        $customer = $this->CustomerModel->GetCustomerById($id);
        echo json_encode($customer);

    }

    function SaveCustomer()
    {
        $json_data = file_get_contents('php://input');
        $data = json_decode($json_data, true);

        if ($data !== null) {
            $id = intval($data['id']);
            $name = $data['name'];
            $phone = $data['phone'];
            $email = $data['email'];
            $address = $data['address'];


            try {
                if ($id == 0) {
                    $this->CustomerModel->CreateCustomer($name, $phone, $email, $address, "");
                } else {
                    $this->CustomerModel->UpdateCustomer($id, $name, $phone, $email, $address, "");
                }
                echo json_encode([
                    'status' => 200,
                    'message' => 'Customer has been created'
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
                'message' => 'User has been not create'
            ]);
        }
    }

    function DeleteCustomer()
    {
        $check = $this->CustomerModel->DeleteCustomer($_GET['id']);
        if ($check) {
            echo json_encode([
                'status' => 200,
                'message' => 'User has been deleted'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => ''
            ]);
        }
    }
}