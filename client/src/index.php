<?php
// require_once ("./config/config.inc.php");

// require_once ("./controller/home_controller.php");
// require_once ("./controller/login_controller.php");
// require_once ("./controller/welcome_controller.php");
// require_once ("./controller/faild_controller.php");
// require_once ("./controller/logout_controller.php");
// require_once ("./controller/profile_controller.php");
// require_once ("./controller/update_profile_controller.php");
// require_once ("./controller/search_controller.php");
// require_once ("./controller/detail_item_controller.php");
// require_once ("./controller/new_paper_controller.php");



// require_once ("./model/home_model.php");
// require_once ("./model/login_model.php");
// require_once ("./model/search_model.php");
// require_once ("./model/profile_model.php");
// require_once ("./model/update_profile_model.php");
// require_once ("./model/detail_page_model.php");
// session_start();

// $action = "";

// if (isset($_REQUEST["action"])) {
//     $action = $_REQUEST["action"];
// }

session_start(); // Bắt đầu session
// Kiểm tra xem session đã được khởi tạo và biến có tồn tại không
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

switch ($action) {
    case "login":
        require_once"view/shared/login.php";
        break;
    case "Welcome":
        require_once"view/shared/welcome.php";
        break;
    case "faild":
        require_once"view/shared/faild.php";
        break;
    case "homepage":
        $curentSidebar = 'document.getElementById("all-employees").classList.add("current_page")';
        $current_tab = 'homepage';
        $VIEW = 'view/manager/all_employees.php';
        require_once"view/manager/template.php";
        break;
    case "create-employee":
        $curentSidebar = 'document.getElementById("create-employee").classList.add("current_page")';
        $current_tab = 'create-employee';
        require_once"view/manager/template.php";
        break;
    case "leave":
        $VIEW ="view/manager/show_requests.php";
        $curentSidebar = 'document.getElementById("leave").classList.add("current_page")';
        $current_tab = 'leave';
        require_once"view/manager/template.php";
        break;
    case "update-time":
        $VIEW ="view/manager/show_requests.php";
        $curentSidebar = 'document.getElementById("update-time").classList.add("current_page")';
        $current_tab = 'update-time';
        require_once"view/manager/template.php";
        break;   
    case "work-from-home":
        $VIEW ="view/manager/show_requests.php";
        $curentSidebar = 'document.getElementById("work-from-home").classList.add("current_page")';
        $current_tab = 'work-from-home';
        require_once"view/manager/template.php";
        break;   
    case "all-activities":
        $VIEW ="view/manager/all_events.php";
        $curentSidebar = 'document.getElementById("all-activities").classList.add("current_page")';
        $current_tab = 'all-activities';
        require_once"view/manager/template.php";
        break;   
    case "create-activity":
        $curentSidebar = 'document.getElementById("create-activity").classList.add("current_page")';
        $current_tab = 'create-activity';
        require_once"view/manager/template.php";
        break;   
    case "all-vouchers":
        $VIEW = "view/manager/point_voucher.php";
        $curentSidebar = 'document.getElementById("all-vouchers").classList.add("current_page")';
        $current_tab = 'all-vouchers';
        require_once"view/manager/template.php";
        break;
    case "create-voucher":
        $curentSidebar = 'document.getElementById("create-voucher").classList.add("current_page")';
        $current_tab = 'create-voucher';
        require_once"view/manager/template.php";
        break; 
    case "client":
        require_once"view/staff/template.php";
        break;           
    default:
        $VIEW = "view/manager/work_from_home.php";
        require_once"view/manager/template.php";
        break;
};

?>