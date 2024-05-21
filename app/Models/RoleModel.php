<?php
class RoleModel extends Model
{

    public function createRole($roleName): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_role (name) VALUES (?)');
        $stmt->bindParam(1, $roleName);
        $stmt->execute();
    }

    public function GetRole(): array
    {
        $stmt = $this->connection->query('SELECT id, name FROM web_role');
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function GetRoleId($roleId)
    {
        $stmt = $this->connection->prepare('SELECT id, name FROM web_role where id = :roleId');
        $stmt->execute(array('roleId' => $roleId));
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }
}
