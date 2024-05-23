<?php

class WebConfigModel extends Model
{

    function GetKey($key)
    {
        $stmt = $this->connection->prepare('SELECT web_value FROM web_config WHERE web_key= ?');
        $stmt->bindParam(1, $key);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['web_value'];
    }

    function CreateKey($key, $value)
    {
        $stmt = $this->connection->prepare('INSERT INTO web_config (web_key, web_value) VALUES (?,?)');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $content);
        $stmt->execute();
    }


    function UpdateKey($key, $value)
    {
        $stmt = $this->connection->prepare('UPDATE web_config SET web_value=? WHERE web_key=?');
        $stmt->bindParam(1, $value);
        $stmt->bindParam(2, $key);
        $stmt->execute();
    }

    function DeleteKey($key){
        $stmt = $this->connection->prepare('DELETE FROM web_config WHERE web_key=?');
        $stmt->bindParam(1, $key);
        $stmt->execute();
    }
}