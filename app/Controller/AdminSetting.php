<?php

class AdminSetting extends Controller
{
    protected $modelSettingMail;
    protected $modelConfig;

    public function __construct()
    {
        $this->modelSettingMail = $this->model("SettingMailModel");
        $this->modelConfig = $this->model("WebConfigModel");
    }

    function mail()
    {
        $data = $this->modelSettingMail->GetSettingMailItem();
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminSetting/mail', 'data' => $data]);
    }

    function getMailContent()
    {
        $id = intval($_GET["id"]);

        $data = $this->modelSettingMail->GetSettingMailContentById($id);
        echo $data;
    }

    function saveMail()
    {
        try {

            $id = intval($_POST['id']);
            $name = $_POST['name'];
            $content = $_POST['content'];

            if ($id == 0) {
                $this->modelSettingMail->CreateSettingMail($name, $content);
            } else {
                $this->modelSettingMail->UpdateSettingMail($id, $name, $content);

            }

            echo json_encode([
                'status' => '200',
                'message' => "success"
            ]);

        } catch (Exception $ex) {
            echo json_encode([
                'status' => '500',
                'message' => $ex
            ]);
        }
    }

    function setting()
    {

        $title =$this->modelConfig->GetKey('title');
        $css =$this->modelConfig->GetKey('css');
        $script =$this->modelConfig->GetKey('script');
        return $this->Views("Share/AdminLayout", ['subview' => 'AdminSetting/setting', 'title' => $title, 'css' => $css, 'script' => $script]);


    }

    function SaveKey()
    {
        $title = $_POST['title'];
        $css = $_POST['css'];
        $script = $_POST['script'];

        $this->modelConfig->UpdateKey("title", $title);
        $this->modelConfig->UpdateKey("css", $css);
        $this->modelConfig->UpdateKey("script", $script);
    }
}