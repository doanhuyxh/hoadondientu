<?php

class SupplierModel extends Model
{
    function GetAllSupplier($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE name LIKE :searchValue OR phone LIKE :searchValue OR email LIKE :searchValue OR address LIKE :searchValue ';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, name, phone, email, address, type FROM web_supplier $searchCondition $sortOrder LIMIT :limit OFFSET :offset" . ";");

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

    function GetSupplierById($id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, email, phone, address ,type FROM web_supplier WHERE id= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results[0];
    }

    function GetSupplierItem()
    {
        $stmt = $this->connection->prepare("SELECT id, name FROM web_supplier");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    function DeleteSupplier($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_supplier WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    function UpdateSupplier($id, $name, $phone, $email, $address, $type)
    {
        $stmt = $this->connection->prepare('UPDATE web_supplier SET name = ?, phone = ?, email = ?, address = ?, type = ? WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $phone);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $address);
        $stmt->bindParam(5, $type);
        $stmt->bindParam(6, $id);
        $stmt->execute();
    }

    public function CreateSupplier($name, $phone, $email, $address, $type): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_supplier (name, phone, email, address, type) VALUES (?,?,?,?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $phone);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $address);
        $stmt->bindParam(5, $type);
        $stmt->execute();
    }
}