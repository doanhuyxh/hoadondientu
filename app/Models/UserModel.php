<?php

class UserModel extends Model{


    function GetAllUser($pageSize, $start, $searchValue, $sortColumn,$sortColumnAscDesc): array
    {

        $searchCondition = '';
        if (!empty($searchValue)) {
            $searchCondition = 'WHERE user_name LIKE :searchValue OR tax_code LIKE :searchValue';
        }
        $sortOrder = '';
        if (!empty($sortColumn)) {
            $sortOrder = "ORDER BY $sortColumn $sortColumnAscDesc";
        }

        $stmt = $this->connection->prepare("SELECT id, user_name, tax_code, roleId FROM web_user $searchCondition $sortOrder LIMIT :limit OFFSET :offset".";");

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

    function GetUserById($id){
        $stmt = $this->connection->prepare("SELECT id, user_name, tax_code, roleId, permission FROM web_user WHERE id= :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results[0];
    }

    function DeleteUser($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_user WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function updateUser($id,$tax_code, $user_name, $pass, $roleId): void
    {
        $stmt = $this->connection->prepare('UPDATE web_user SET user_name = ?, roleId = ?, tax_code = ? WHERE id = ?');
        $stmt->bindParam(1, $user_name);
        $stmt->bindParam(2, $roleId);
        $stmt->bindParam(3, $tax_code);
        $stmt->bindParam(4, $id);
        $stmt->execute();
    }

    public function createUser($tax_code, $user_name, $pass, $roleId): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_user (tax_code, user_name, password, roleId) VALUES (?, ?, ?, ?)');
        $stmt->bindParam(1, $tax_code);
        $stmt->bindParam(2, $user_name);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $roleId);
        $stmt->execute();
    }

    function updatePermission($id, $permission)
    {
        $stmt = $this->connection->prepare('UPDATE web_user SET permission = ? WHERE id = ?');
        $stmt->bindParam(1, $permission);
        $stmt->bindParam(2, $id);
        $stmt->execute();
    }
}
