<?php
class NumberModel extends Model
{

    public function createNumber($name): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_number (name) VALUES (?)');
        $stmt->bindParam(1, $name);
        $stmt->execute();
    }
    public function GetNumberById($id)
    {
        $stmt = $this->connection->prepare('SELECT id, name FROM web_number WHERE id = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);

    }
    public function getNumberItem()
    {
        $stmt = $this->connection->prepare('SELECT id, name FROM web_number');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }


    public function GetNumber($pageSize, $start, $searchValue, $sortColumn, $sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE name LIKE :searchValue ';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, name FROM web_number $searchCondition $sortOrder LIMIT :limit OFFSET :offset" . ";");

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

    public function UpdateNumber($id, $name)
    {
        $stmt = $this->connection->prepare('UPDATE web_number SET name= ? where id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }

    function DeleteNumber($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_number WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
