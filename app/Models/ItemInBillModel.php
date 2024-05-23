<?php

class ItemInBillModel extends Model
{

    public function createItemInBill($bill_id, $ItemDescription, $Quantity, $UnitPrice): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_item_in_bill (bill_id, ItemDescription, Quantity, UnitPrice) VALUES (?,?,?,?)');
        $stmt->bindParam(1, $bill_id);
        $stmt->bindParam(2, $ItemDescription);
        $stmt->bindParam(3, $Quantity);
        $stmt->bindParam(4, $UnitPrice);
        $stmt->execute();
    }

    public function updateItemInBill($id, $bill_id, $ItemDescription, $Quantity, $UnitPrice): void
    {
        $stmt = $this->connection->prepare('UPDATE web_item_in_bill SET ItemDescription = ?, Quantity = ?, UnitPrice = ?, bill_id = ? WHERE id = ?');
        $stmt->bindParam(1, $ItemDescription);
        $stmt->bindParam(2, $Quantity);
        $stmt->bindParam(3, $UnitPrice);
        $stmt->bindParam(4, $bill_id);
        $stmt->bindParam(5, $id);
        $stmt->execute();
    }

    public function getItemInBillId($billId)
    {
        $stmt = $this->connection->prepare('SELECT * FROM web_item_in_bill where bill_id = :bill_id');
        $stmt->execute(array('bill_id' => $billId));
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteItemInBillId($billId)
    {
        $stmt = $this->connection->prepare('DELETE FROM web_item_in_bill where bill_id = :bill_id');
        $stmt->execute(array('bill_id' => $billId));

    }

}