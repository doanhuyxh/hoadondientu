<?php

class ExchangeRateModel extends Model
{
    function GetAllExchangeRate($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE name LIKE :searchValue OR rate LIKE :searchValue';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, name, rate FROM web_ExchangeRate $searchCondition $sortOrder LIMIT :limit OFFSET :offset" . ";");

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

    function GetExchangeRateById($id)
    {
        $stmt = $this->connection->prepare("SELECT id, name, rate FROM web_ExchangeRate WHERE id= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results[0];
    }

    function DeleteExchangeRate($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_ExchangeRate WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    function UpdateExchangeRate($id, $name, $rate)
    {
        $stmt = $this->connection->prepare('UPDATE web_ExchangeRate SET name = ?, rate = ? WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $rate);
        $stmt->bindParam(3, $id);
        $stmt->execute();
    }

    public function CreateExchangeRate($name, $rate)
    {
        $stmt = $this->connection->prepare('INSERT INTO web_ExchangeRate (name, rate) VALUES (?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $rate);
        $stmt->execute();
    }
}