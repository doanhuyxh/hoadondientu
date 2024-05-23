<?php

class GoodsModel extends Model
{

    function GetAllGoods($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE name LIKE :searchValue OR quantity LIKE :searchValue OR unit LIKE :searchValue OR supplier LIKE :searchValue ';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, name, quantity, unit, supplier FROM web_goods $searchCondition $sortOrder LIMIT :limit OFFSET :offset" . ";");

        $stmt->bindParam(':limit', $pageSize, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $start, PDO::PARAM_INT);
        if (!empty($searchValue)) {
            $searchParam = "%$searchValue%";
            $stmt->bindParam(':searchValue', $searchParam, PDO::PARAM_STR);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;

    }

    function GetGoodsById($id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, quantity, unit, supplier FROM web_goods WHERE id= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results[0];
    }

    function DeleteGoods($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_goods WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    function UpdateGoods($id, $name, $unit, $quantity, $supplier)
    {
        $stmt = $this->connection->prepare('UPDATE web_goods SET name = ?, unit = ?, quantity = ?, supplier = ?WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $unit);
        $stmt->bindParam(3, $quantity);
        $stmt->bindParam(4, $supplier);
        $stmt->bindParam(6, $id);
        $stmt->execute();
    }

    public function CreateGoods($name, $unit, $quantity, $supplier)
    {
        $stmt = $this->connection->prepare('INSERT INTO web_goods (name, unit, quantity, supplier) VALUES (?,?,?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $unit);
        $stmt->bindParam(3, $quantity);
        $stmt->bindParam(4, $supplier);
        $stmt->execute();
    }

}