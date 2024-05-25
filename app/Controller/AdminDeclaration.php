<?php

class AdminDeclaration extends Controller
{
    protected $modelDeclaration;

    public function __construct()
    {
        $this->modelDeclaration = $this->model("DeclarationModel");
    }

    public function index()
    {
        if(!$this->CheckPermission("listDeclaration")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminDeclaration/index']);
    }

    function create()
    {
        if(!$this->CheckPermission("addEditDeclaration")){
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminDeclaration/addEdit']);
    }

    function getDeclaration()
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
                $sortColumn = 'InvoiceNumber';
                $sortColumnAscDesc = 'asc';
            }
            $pageSize = $length !== null ? (int)$length : 0;
            $skip = $start !== null ? (int)$start : 0;

            $gridItems = $this->modelDeclaration->GetAllDeclaration($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

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

    function SaveDeclaration()
    {
        if(!$this->CheckPermission("addEditDeclaration")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }

        try {

            $id = intval($_POST['id']);
            $full_name = $_POST['full_name'];
            $personal_id = $_POST['personal_id'];
            $date_of_birth = $_POST['date_of_birth'];
            $address = $_POST['address'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $occupation = $_POST['occupation'];
            $employer_name = $_POST['employer_name'];
            $employer_address = $_POST['employer_address'];
            $annual_income = $_POST['annual_income'];
            $tax_deductions = $_POST['tax_deductions'];
            $taxable_income = $_POST['taxable_income'];
            $tax_amount = $_POST['tax_amount'];
            $tax_rate = $_POST['tax_rate'];
            $filing_date = $_POST['filing_date'];

            if ($id == 0) {
                $this->modelDeclaration->createDeclaration($full_name, $personal_id, $date_of_birth, $address, $phone_number, $email, $occupation, $employer_name, $employer_address, $annual_income, $tax_deductions, $taxable_income, $tax_rate, $tax_amount, $filing_date);
            } else {
                $this->modelDeclaration->updateDeclaration($id, $full_name, $personal_id, $date_of_birth, $address, $phone_number, $email, $occupation, $employer_name, $employer_address, $annual_income, $tax_deductions, $taxable_income, $tax_rate, $tax_amount, $filing_date);
            }

            echo json_encode([
                'status' => '200',
                'message' => "success"
            ]);

        } catch (Exception $ex) {
            echo json_encode([
                'status' => '500',
                'message' => $ex
            ]);
        }
    }

    function DeleteDeclaration()
    {
        if(!$this->CheckPermission("deleteDeclaration")){
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }

        $check = $this->modelDeclaration->DeleteDeclaration($_GET['id']);
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

    function ViewDeclaration()
    {
        $id = intval($_GET['id']);
        $data = $this->modelDeclaration->GetDeclarationById($id);

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminDeclaration/detail', 'data' => $data]);
    }


}