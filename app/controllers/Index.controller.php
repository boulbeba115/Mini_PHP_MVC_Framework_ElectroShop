<?php

use function PHPSTORM_META\type;

class Index extends Controller
{
    public function __construct()
    {
        $this->isLogged = isLoggedIn();
        $this->coverModel = $this->model('Cover');
        $this->trendModel = $this->model('Trend');
        $this->productModel = $this->model('Product');
        $this->subCategoryModel = $this->model('SubCategory');
        $this->subSubCategoryModel = $this->model('SubSubCategory');
        $this->categoryModel = $this->model('Category');
        $this->userModel = $this->model('User');

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
        $data = [
            "covers" => $this->coverModel->getCovers(),
            "categories" => $this->cate,
            "trends" => $this->trendModel->getTrends(),
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.home", $data);
    }

    public function catagory($params, $p2 = '')
    {
        if (!empty($p2)) {
            redirect("404");
        }
        $data = [
            "categories" => $this->cate,
            "products" => $this->model('Product')->byCategory($params),
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.products", $data);
    }
    public function subcatagory($params = [], $p2 = '')
    {
        if (!empty($p2)) {
            redirect("404");
        }
        $data = [
            "categories" => $this->cate,
            "products" => $this->model('Product')->bySubCategory($params),
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.products", $data);
    }
    public function sSCategory($params = [], $p2 = '')
    {
        if (!empty($p2)) {
            redirect("404");
        }
        $data = [
            "categories" => $this->cate,
            "products" => $this->model('Product')->bySubSubCategory($params),
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.products", $data);
    }
    public function product($params = [], $p2 = '')
    {
        if (!empty($p2)) {
            redirect("404");
        }
        $jsondata = JsonToData("\TechFiles\Products.json");
        $key = array_search($params, array_column($jsondata, 'prodRef'));
        $data = [
            "categories" => $this->cate,
            "products" => $this->model('Product')->byReference($params),
            "isLogged" => $this->isLogged,
        ];
        if ($key >= 0) {
            $data['specs'] = $jsondata[$key]->specs;
        }
        if (count($data['products']) < 1) {
            redirect("404");
        }
        $this->view("front.singleProduct", $data);
    }
    public function account()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }

        $data = [
            "categories" => $this->cate,
            "user" => $this->userModel->getUserById($_SESSION['user_id']),
            "isLogged" => $this->isLogged,
        ];
        $this->view("front.myAcount", $data);
    }
}
