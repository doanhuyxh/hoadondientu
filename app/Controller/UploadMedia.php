<?php

class UploadMedia
{

    function Images()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $check = getimagesize($_FILES["images"]["tmp_name"]);
            if ($check !== false) {
                $imageFileType = strtolower(pathinfo($_FILES["images"]["name"], PATHINFO_EXTENSION));
                $img_path = '/public/upload/' . (new DateTime())->getTimestamp() . '.' . $imageFileType;
                $target = _DIR_ROOT . $img_path;
                if (move_uploaded_file($_FILES["images"]["tmp_name"], $target)) {
                    echo htmlspecialchars($img_path);
                } else {
                    echo "Xin lỗi, đã xảy ra lỗi khi tải tệp lên.";
                }
            } else {
                echo "Tệp không phải là ảnh.";
            }
        } else {
            echo "Vui lòng chọn phương thức POST";
        }
        die();
    }
}