<?php

class BillModel extends Model
{
    public function createBill($InvoiceNumber, $InvoiceDate, $SellerName, $SellerAddress, $SellerPhone, $SellerTaxCode, $BuyerName, $BuyerAddress, $BuyerPhone, $BuyerTaxCode, $SubTotal, $TaxRate, $TaxAmount, $TotalAmount, $PaymentMethod, $BankAccount, $BankName, $IssuerName, $Signature, $CompanySeal, $Status, $userId)
    {
        $stmt = $this->connection->prepare('INSERT INTO web_bill (InvoiceNumber, InvoiceDate, SellerName, SellerAddress, SellerPhone, SellerTaxCode, BuyerName, BuyerAddress, BuyerPhone, BuyerTaxCode, SubTotal, TaxRate, TaxAmount, TotalAmount, PaymentMethod, BankAccount, BankName, IssuerName, Signature, CompanySeal, Status, userId, create_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');

        $stmt->bindParam(1, $InvoiceNumber);
        $stmt->bindParam(2, $InvoiceDate);
        $stmt->bindParam(3, $SellerName);
        $stmt->bindParam(4, $SellerAddress);
        $stmt->bindParam(5, $SellerPhone);
        $stmt->bindParam(6, $SellerTaxCode);
        $stmt->bindParam(7, $BuyerName);
        $stmt->bindParam(8, $BuyerAddress);
        $stmt->bindParam(9, $BuyerPhone);
        $stmt->bindParam(10, $BuyerTaxCode);
        $stmt->bindParam(11, $SubTotal);
        $stmt->bindParam(12, $TaxRate);
        $stmt->bindParam(13, $TaxAmount);
        $stmt->bindParam(14, $TotalAmount);
        $stmt->bindParam(15, $PaymentMethod);
        $stmt->bindParam(16, $BankAccount);
        $stmt->bindParam(17, $BankName);
        $stmt->bindParam(18, $IssuerName);
        $stmt->bindParam(19, $Signature);
        $stmt->bindParam(20, $CompanySeal);
        $stmt->bindParam(21, $Status);
        $stmt->bindParam(22, $userId);

        $stmt->execute();
        $billId = $this->connection->lastInsertId();
        return $billId;
    }


    public function updateBill($id, $InvoiceNumber, $InvoiceDate, $SellerName, $SellerAddress, $SellerPhone, $SellerTaxCode, $BuyerName, $BuyerAddress, $BuyerPhone, $BuyerTaxCode, $SubTotal, $TaxRate, $TaxAmount, $TotalAmount, $PaymentMethod, $BankAccount, $BankName, $IssuerName, $Signature, $CompanySeal, $Status)
    {
        $stmt = $this->connection->prepare('UPDATE web_bill SET InvoiceNumber = :InvoiceNumber, InvoiceDate = :InvoiceDate, SellerName = :SellerName, SellerAddress = :SellerAddress, SellerPhone = :SellerPhone, SellerTaxCode = :SellerTaxCode, BuyerName = :BuyerName, BuyerAddress = :BuyerAddress, BuyerPhone = :BuyerPhone, BuyerTaxCode = :BuyerTaxCode, SubTotal = :SubTotal, TaxRate = :TaxRate, TaxAmount = :TaxAmount, TotalAmount = :TotalAmount, PaymentMethod = :PaymentMethod, BankAccount = :BankAccount, BankName = :BankName, IssuerName = :IssuerName, Signature = :Signature, CompanySeal = :CompanySeal, Status = :Status WHERE id = :id');

        $stmt->bindParam(':InvoiceNumber', $InvoiceNumber);
        $stmt->bindParam(':InvoiceDate', $InvoiceDate);
        $stmt->bindParam(':SellerName', $SellerName);
        $stmt->bindParam(':SellerAddress', $SellerAddress);
        $stmt->bindParam(':SellerPhone', $SellerPhone);
        $stmt->bindParam(':SellerTaxCode', $SellerTaxCode);
        $stmt->bindParam(':BuyerName', $BuyerName);
        $stmt->bindParam(':BuyerAddress', $BuyerAddress);
        $stmt->bindParam(':BuyerPhone', $BuyerPhone);
        $stmt->bindParam(':BuyerTaxCode', $BuyerTaxCode);
        $stmt->bindParam(':SubTotal', $SubTotal);
        $stmt->bindParam(':TaxRate', $TaxRate);
        $stmt->bindParam(':TaxAmount', $TaxAmount);
        $stmt->bindParam(':TotalAmount', $TotalAmount);
        $stmt->bindParam(':PaymentMethod', $PaymentMethod);
        $stmt->bindParam(':BankAccount', $BankAccount);
        $stmt->bindParam(':BankName', $BankName);
        $stmt->bindParam(':IssuerName', $IssuerName);
        $stmt->bindParam(':Signature', $Signature);
        $stmt->bindParam(':CompanySeal', $CompanySeal);
        $stmt->bindParam(':Status', $Status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    function ChangeStatus($id, $status)
    {
        $stmt = $this->connection->prepare('UPDATE web_bill SET Status = :Status WHERE id = :id');
        $stmt->bindParam(':Status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }


    function deleteBill($id)
    {
        $stmt = $this->connection->prepare('DELETE FROM web_bill WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    function getBillById($id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM web_bill WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $bill = $stmt->fetch(PDO::FETCH_OBJ);
        return $bill;

    }

    function getAllBill($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc)
    {
        $conditions = [];
        $params = [];

        if (!empty($searchValue)) {
            $searchFields = ['InvoiceNumber', 'InvoiceDate', 'SellerName', 'SellerAddress', 'SellerPhone', 'SellerTaxCode', 'BuyerName', 'BuyerAddress', 'BuyerPhone', 'BuyerTaxCode', 'SubTotal', 'TaxRate', 'TaxAmount', 'TotalAmount', 'PaymentMethod', 'BankAccount', 'BankName', 'Status'];
            foreach ($searchFields as $field) {
                $conditions[] = "$field LIKE :searchValue";
            }
            $params[':searchValue'] = "%$searchValue%";
        }

        $searchCondition = !empty($conditions) ? 'WHERE ' . implode(' OR ', $conditions) : '';

        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT * FROM web_bill $searchCondition $sortOrder LIMIT :limit OFFSET :offset");

        $stmt->bindParam(':limit', $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $start, PDO::PARAM_INT);

        foreach ($params as $param => $value) {
            $stmt->bindParam($param, $value, PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

}