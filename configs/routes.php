<?php
$routes['default_controller'] = "Home";
$routes['trang-chu'] = "Home/index";
$routes['dang-nhap'] = "Auth/Login";
$routes['dang-xuat'] = "Auth/LogOut";
$routes['dang-ky'] = "Auth/Signin";
$routes['get-role'] = "Auth/getRole";

//admin
$routes['admin-index'] = "Admin/index";


//admin user
$routes['admin-user'] = "AdminUser/index";
$routes['admin-get-user'] = "AdminUser/getUser";
$routes['admin-get-user-id'] = "AdminUser/getUserById";
$routes['admin-save-user'] = "AdminUser/SaveUser";
$routes['admin-delete-user'] = "AdminUser/DeleteUser";

//admin khách hàng
$routes['admin-customer'] = "AdminCustomer/index";
$routes['admin-get-customer'] = "AdminCustomer/getCustomer";
$routes['admin-get-customer-id'] = "AdminCustomer/getCustomerById";
$routes['admin-save-customer'] = "AdminCustomer/SaveCustomer";
$routes['admin-delete-customer'] = "AdminCustomer/DeleteCustomer";

//admin nhà cung cấp
$routes['admin-supplier'] = "AdminSupplier/index";
$routes['admin-get-supplier'] = "AdminSupplier/getSupplier";
$routes['admin-get-supplier-item'] = "AdminSupplier/getSupplierItem";
$routes['admin-get-supplier-id'] = "AdminSupplier/getSupplierById";
$routes['admin-save-supplier'] = "AdminSupplier/SaveSupplier";
$routes['admin-delete-supplier'] = "AdminSupplier/DeleteSupplier";

//admin hàng hóa
$routes['admin-goods'] = "AdminGoods/index";
$routes['admin-get-goods'] = "AdminGoods/getGoods";
$routes['admin-get-goods-id'] = "AdminGoods/getGoodsById";
$routes['admin-save-goods'] = "AdminGoods/SaveGoods";
$routes['admin-delete-goods'] = "AdminGoods/DeleteGoods";

//admin tỷ giá
$routes['admin-exchange-rate'] = "AdminExchangeRate/index";
$routes['admin-get-exchange-rate'] = "AdminExchangeRate/getExchangeRate";
$routes['admin-get-exchange-rate-id'] = "AdminExchangeRate/getExchangeRateById";
$routes['admin-save-exchange-rate'] = "AdminExchangeRate/SaveExchangeRate";
$routes['admin-delete-exchange-rate'] = "AdminExchangeRate/DeleteExchangeRate";

//admin cấu hình
$routes['admin-mail'] = "AdminSetting/mail";
$routes['admin-get-mail-id'] = "AdminSetting/getMailContent";
$routes['admin-save-mail'] = "AdminSetting/saveMail";
$routes['admin-setting'] = "AdminSetting/setting";
$routes['admin-save-key'] = "AdminSetting/SaveKey";


// router khác
$routes['upload-images'] = "UploadMedia/Images";
?>
