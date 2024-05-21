<?php
class AuthModel extends Model
{

    public function CheckExit($data)
    {
        $stmt = $this->connection->prepare('SELECT * FROM web_user WHERE user_name = :user_name');

        $stmt->execute(['user_name' => $data]);

        $result = $stmt->fetch();

        return ($result['user_name']);
    }

    public function createUser($tax_code, $user, $pass, $roleId): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_user (tax_code, user_name, password, roleId) VALUES (?, ?, ?, ?)');
        $stmt->bindParam(1, $tax_code);
        $stmt->bindParam(2, $user);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $roleId);
        $stmt->execute();
    }

    public function GetUser($username, $password): array
    {
        $stmt = $this->connection->prepare('SELECT id, user_name, tax_code, roleId from web_user WHERE user_name = :username AND password = :password');
        $stmt->execute(array('username' => $username, 'password'=> $password));
        $result = $stmt->fetch();
        return [$result['user_name'], $result['tax_code'], $result['roleId']];
    }
}
