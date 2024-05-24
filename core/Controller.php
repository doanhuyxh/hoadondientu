<?php

class Controller
{

    public function CheckPermission($action)
    {


        $permission = $this->model("AuthModel")->GetPermission($_SESSION['userId']);
        if($_SESSION["role_name"] == 'admin'){
            return true;
        }else{
            return strpos($permission, $action) !== false;
        }
    }

    public function model($model)
    {
        if (file_exists(_DIR_ROOT . '/app/Models/' . $model . '.php')) {
            require_once _DIR_ROOT . '/app/Models/' . $model . '.php';
            if (class_exists($model)) {
                $model = new $model();
                return $model;
            }
        }
        return false;

    }

    function Views($view, $data = [])
    {
        if (file_exists(_DIR_ROOT . '/app/Views/' . $view . '.php')) {
            require_once _DIR_ROOT . '/app/Views/' . $view . '.php';
        }

    }
}
