<?php

class CustomerModel extends Model
{

    function GetAllCustomer($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE name LIKE :searchValue OR phone LIKE :searchValue OR email LIKE :searchValue OR address LIKE :searchValue ';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, name, phone, email, address FROM web_customer $searchCondition $sortOrder LIMIT :limit OFFSET :offset" . ";");

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

    function GetCustomerById($id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, email, phone, address FROM web_customer WHERE id= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results[0];
    }

    function DeleteCustomer($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_customer WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    function UpdateCustomer($id, $name, $phone, $email, $address)
    {
        $stmt = $this->connection->prepare('UPDATE web_customer SET name = ?, phone = ?, email = ?, address = ? WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $phone);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $address);
        $stmt->bindParam(5, $id);
        $stmt->execute();
    }

    public function CreateCustomer($name, $phone, $email, $address): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_customer (name, phone, email, address) VALUES (?,?,?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $phone);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $address);
        $stmt->execute();
    }

}