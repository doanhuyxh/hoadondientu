<?php

class SettingMailModel extends Model
{
    public function CreateSettingMail($name, $content): void
    {
        $stmt = $this->connection->prepare('INSERT INTO web_setting_email (name, content) VALUES (?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $content);
        $stmt->execute();
    }

    public function UpdateSettingMail($id, $name, $content): void
    {
        $stmt = $this->connection->prepare('UPDATE web_setting_email SET name = ?, content = ? WHERE id = ?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $content);
        $stmt->bindParam(3, $id);
        $stmt->execute();
    }

    public function GetSettingMailItem(): array
    {
        $stmt = $this->connection->query('SELECT id, name, content FROM web_setting_email');
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function GetSettingMailContentById($id)
    {
        $stmt = $this->connection->prepare('SELECT content FROM web_setting_email where id = :id');
        $stmt->execute(array('id' => $id));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['content'];
    }

    public function DeleteSettingMail($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM web_setting_email WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}