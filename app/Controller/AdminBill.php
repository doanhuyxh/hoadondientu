<?php

class AdminBill extends Controller
{
    protected $billModel;
    protected $bilItemModel;

    public function __construct()
    {
        $this->billModel = $this->model("BillModel");
        $this->bilItemModel = $this->model("ItemInBillModel");
    }

    function index()
    {
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminBill/index']);
    }

    function getBill()
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

            $gridItems = $this->billModel->getAllBill($pageSize, $skip, $searchValue, $sortColumn, $sortColumnAscDesc);

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

    function createBill()
    {
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminBill/addEdit']);
    }

    function getBillById()
    {

    }

    function SaveBill()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /404");
            die();
        }

        try {

            $InvoiceNumber = $_POST['InvoiceNumber'];
            $InvoiceDate = $_POST['InvoiceDate'];
            $SellerName = $_POST['SellerName'];
            $SellerAddress = $_POST['SellerAddress'];
            $SellerPhone = $_POST['SellerPhone'];
            $SellerTaxCode = $_POST['SellerTaxCode'];
            $BuyerName = $_POST['BuyerName'];
            $BuyerAddress = $_POST['BuyerAddress'];
            $BuyerPhone = $_POST['BuyerPhone'];
            $BuyerTaxCode = $_POST['BuyerTaxCode'];
            $SubTotal = $_POST['SubTotal'];
            $TaxRate = $_POST['TaxRate'];
            $TaxAmount = $_POST['TaxAmount'];
            $TotalAmount = $_POST['TotalAmount'];
            $PaymentMethod = $_POST['PaymentMethod'];
            $BankAccount = $_POST['BankAccount'];
            $BankName = $_POST['BankName'];
            $IssuerName = $_POST['IssuerName'];
            $Signature = "";
            $CompanySeal = "";
            $Status = "Đang chờ";
            $ItemInBill = json_decode($_POST['ItemInBill'], true);

            $billId = $this->billModel->createBill($InvoiceNumber, $InvoiceDate, $SellerName, $SellerAddress, $SellerPhone, $SellerTaxCode, $BuyerName, $BuyerAddress, $BuyerPhone, $BuyerTaxCode, $SubTotal, $TaxRate, $TaxAmount, $TotalAmount, $PaymentMethod, $BankAccount, $BankName, $IssuerName, $Signature, $CompanySeal, $Status, 0);

            foreach ($ItemInBill as $item) {
                $this->bilItemModel->createItemInBill($billId, $item['ItemDescription'], $item['Quantity'], $item['UnitPrice']);
            }

            echo json_encode([
                'status' => 200,
                'message' => 'Bill has been created'
            ]);
        } catch (Exception $ex) {

            echo json_encode([
                'status' => 500,
                'message' => $ex
            ]);

        }

        die();
    }

    function DeleteBill()
    {

        $check = $this->billModel->deleteBill($_GET['id']);
        if ($check) {
            $this->bilItemModel->deleteItemInBillId($_GET['id']);
            echo json_encode([
                'status' => 200,
                'message' => 'Bill has been deleted'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Xóa thất bại'
            ]);
        }
    }

    function ViewBill()
    {

        $id = $_GET['id'];
        $bill = $this->billModel->getBillById($id);
        $listItem = $this->bilItemModel->getItemInBillId($id);

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminBill/detail', 'bill'=>$bill, 'listItem'=>$listItem]);
    }


}