<?php
class Orders extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }
        $this->isLogged = isLoggedIn();
        $this->ordersModel = $this->model('Order');
        $this->userModel = $this->model('User');

        $this->subCategoryModel = $this->model('SubCategory');
        $this->subSubCategoryModel = $this->model('SubSubCategory');
        $this->categoryModel = $this->model('Category');
        $categories = $this->categoryModel->getCategories();
        $ssCategories = $this->subSubCategoryModel->getSubSubCategories();
        $subcategories = $this->subCategoryModel->getSubCategories();
        $subCat = [];
        $this->cate = [];
        foreach ($subcategories as $sb) {
            $sbc = [];
            foreach ($ssCategories as $ssc) {
                if ($ssc->sub_category_name == $sb->sub_category_name)
                    $sbc[] = $ssc;
            }
            $sb->ssCategories = $sbc;
            $subCat[] = $sb;
        }

        foreach ($categories as $c) {
            $subc = [];
            foreach ($subCat as $sc) {
                if ($sc->category_name == $c->category_name)
                    $subc[] = $sc;
            }
            $c->subcategories = $subc;
            $this->cate[] = $c;
        }
    }
    public function index()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }
        $data = [
            "orders" => $this->ordersModel->getUserOrder($_SESSION['user_id']),
            "categories" => $this->cate,
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.orders", $data);
    }
    public function details($ref = '', $p2 = '')
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }

        if (!empty($p2)) {
            redirect("404");
        }
        if (empty($ref)) {
            redirect("404");
        }

        $data = [
            "orders" => $this->ordersModel->getOrderItems($ref),
            "user" => $this->userModel->getUserById($_SESSION['user_id']),
            "categories" => $this->cate,
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.OrderDetails", $data);
    }
}
