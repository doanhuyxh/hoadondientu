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
$routes['admin-save-permission'] = "AdminUser/SavePermission";
$routes['admin-delete-user'] = "AdminUser/DeleteUser";
$routes['admin-view-user'] = "AdminUser/ViewUser";

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

//admin hóa đơn
$routes['admin-bill'] = "AdminBill/index";
$routes['admin-create-bill'] = "AdminBill/createBill";
$routes['admin-get-bill'] = "AdminBill/getBill";
$routes['admin-get-bill-id'] = "AdminBill/getBillById";
$routes['admin-save-bill'] = "AdminBill/SaveBill";
$routes['admin-delete-bill'] = "AdminBill/DeleteBill";
$routes['view-bill'] = "AdminBill/ViewBill";

//admin cấp số
$routes['admin-number'] = 'AdminNumber/index';
$routes['admin-get-number'] = "AdminNumber/getNumber";
$routes['admin-get-number-id'] = "AdminNumber/getNumberById";
$routes['admin-save-number'] = "AdminNumber/SaveNumber";
$routes['admin-delete-number'] = "AdminNumber/DeleteNumber";

//admin tờ khai
$routes['admin-declaration'] = "AdminDeclaration/index";
$routes['admin-declaration-create'] = "AdminDeclaration/create";
$routes['admin-get-declaration'] = "AdminDeclaration/getDeclaration";
$routes['admin-get-declaration-id'] = "AdminDeclaration/getDeclarationById";
$routes['admin-save-declaration'] = "AdminDeclaration/SaveDeclaration";
$routes['admin-delete-declaration'] = "AdminDeclaration/DeleteDeclaration";
$routes['view-declaration'] = "AdminDeclaration/ViewDeclaration";

//admin cấu hình
$routes['admin-mail'] = "AdminSetting/mail";
$routes['admin-get-mail-id'] = "AdminSetting/getMailContent";
$routes['admin-save-mail'] = "AdminSetting/saveMail";
$routes['admin-delete-mail'] = "AdminSetting/deleteMail";
$routes['admin-setting'] = "AdminSetting/setting";
$routes['admin-save-key'] = "AdminSetting/SaveKey";


// router khác
$routes['upload-images'] = "UploadMedia/Images";
?>
