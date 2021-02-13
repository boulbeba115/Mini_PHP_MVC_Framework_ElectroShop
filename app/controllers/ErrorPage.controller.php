<?php
class ErrorPage extends Controller
{
    public function __construct()
    {
        $this->isLogged = isLoggedIn();
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
        $data = [
            "isLogged" => $this->isLogged,
            "categories" => $this->cate,
        ];
        $this->view("front.404", $data);
    }
    public function notFound()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->view("admin.404");
    }
}
