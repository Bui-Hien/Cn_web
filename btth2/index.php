<?php
require_once './configs/Database.php';
require_once "./models/Article.php";
require_once "./models/Author.php";
require_once "./models/Category.php";
require_once "./models/User.php";
require_once "./services/ArticleService.php";
require_once "./services/CategoryService.php";
require_once "./services/UserService.php";
require_once "./services/AuthorService.php";


// B1: Bắt giá trị controller và action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// B2: Chuẩn hóa tên trước khi gọi
$controller = ucfirst($controller);
$controller .= 'Controller';
$controllerPath = 'controllers/' . $controller . '.php';

// B3. Để gọi nó Controller
if (!file_exists($controllerPath)) {
    die('Lỗi! Controller này không tồn tại');
}
require_once($controllerPath);
// B4. Tạo đối tượng và gọi hàm của Controller
$myObj = new $controller();  //controller=home > new HomeController()
$myObj->$action(); //action=index > index()

?>

<!--http://localhost/btth02v2/index.php?controller=A&action=B -->