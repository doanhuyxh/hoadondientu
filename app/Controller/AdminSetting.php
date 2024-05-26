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

    function deleteMail()
    {
        $check = $this->modelSettingMail->DeleteSettingMail($_GET['id']);
        if ($check) {
            echo json_encode([
                'status' => 200,
                'message' => 'Goods has been deleted'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => ''
            ]);
        }
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

        if (!$this->CheckPermission("listSetting")) {
            header('Location: ' . _WEB_ROOT . '/admin');
            die();
        }

        $keys = [
            'origin', 'mst', 'under', 'mail', 'city', 'address',
            'account', 'cqt_cap_tren', 'mst_cap_hd', 'phone',
            'district', 'wards', 'bank_name', 'cqt'
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = $this->modelConfig->GetKey($key);
        }

        return $this->Views("Share/AdminLayout", ['subview' => 'AdminSetting/setting',
            'origin' => $settings['origin'],
            'mst' => $settings['mst'],
            'under' => $settings['under'],
            'mail' => $settings['mail'],
            'city' => $settings['city'],
            'address' => $settings['address'],
            'account' => $settings['account'],
            'cqt_cap_tren' => $settings['cqt_cap_tren'],
            'mst_cap_hd' => $settings['mst_cap_hd'],
            'phone' => $settings['phone'],
            'district' => $settings['district'],
            'wards' => $settings['wards'],
            'bank_name' => $settings['bank_name'],
            'cqt' => $settings['cqt']
        ]);


    }

    function SaveKey()
    {
        if (!$this->CheckPermission("addEditSetting")) {
            echo json_encode([
                'status' => 500,
                'message' => 'Bạn không có quyền'
            ]);
            die();
        }
        try {
            $keys = [
                'origin', 'mst', 'under', 'mail', 'city', 'address',
                'account', 'cqt_cap_tren', 'mst_cap_hd', 'phone',
                'district', 'wards', 'bank_name', 'cqt'
            ];

            foreach ($keys as $key) {
                if (isset($_POST[$key])) {
                    $this->modelConfig->UpdateKey($key, $_POST[$key]);
                }
            }

            echo json_encode([
                'status' => 200,
                'message' => 'Cập nhât thành công'
            ]);

        } catch (Exception $exception) {
            echo json_encode([
                'status' => 500,
                'message' => 'Cập nhật không thành công'
            ]);
        }

    }
}