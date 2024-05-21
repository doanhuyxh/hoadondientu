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
$routes['admin-get-supplier-id'] = "AdminSupplier/getSupplierById";
$routes['admin-save-supplier'] = "AdminSupplier/SaveSupplier";
$routes['admin-delete-supplier'] = "AdminSupplier/DeleteSupplier";



?>
