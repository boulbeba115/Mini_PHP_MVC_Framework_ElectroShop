<?php
class Products extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->productModel = $this->model('Product');
        $this->subCategoryModel = $this->model('SubCategory');
        $this->subSubCategoryModel = $this->model('SubSubCategory');
        $this->categoryModel = $this->model('Category');
    }
    public function index()
    {
        $subCategories = $this->subCategoryModel->getSubCategories();
        $ssCategoryModel = $this->subSubCategoryModel->getSubSubCategories();
        $categories = $this->categoryModel->getCategories();
        $data = [
            'products' => $this->productModel->getProducts(),
            'ssCategories' => $ssCategoryModel,
            'subcategories' => $subCategories,
            'categories' => $categories
        ];
        $this->view("admin.Products.product", $data);
    }
    public function create()
    {
        $subCategories = $this->subCategoryModel->getSubCategories();
        $ssCategoryModel = $this->subSubCategoryModel->getSubSubCategories();
        $categories = $this->categoryModel->getCategories();
        $data = [
            'ssCategories' => $ssCategoryModel,
            'subcategories' => $subCategories,
            'categories' => $categories
        ];
        $this->view("admin.Products.create", $data);
    }
    public function add()
    {
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $errors = [];
        $noImg = false;
        $noSubSub = false;
        $data = [
            'ProdReference' => trim($_POST['ProdReference']),
            'ProdName' => trim($_POST['ProdName']),
            'ProdBrand' => trim($_POST['ProdBrand']),
            'subcategory' => trim($_POST['subcategory']),
            'subsubcategory' => trim($_POST['subsubcategory']),
            'qtStock' => trim($_POST['qtStock']),
            'prix' => trim($_POST['prix']),
            'shortDesc' => trim($_POST['shortDesc']),
            'longDesc' => trim($_POST['longDesc']),
            'is_trend' => 0
        ];
        if (isset($_POST['productImages']))
            $data['productImages'] = $_POST['productImages'];
        else
            $noImg = true;

        if (isset($_POST['technicalFile']))
            $data['technicalFile'] = $_POST['technicalFile'];

        if (empty($data['ProdReference']))
            $errors['reference_err'] = 'Reference field is empty';
        if (empty($data['ProdName']))
            $errors['ProdName_err'] = 'Product Name field is empty';
        if (empty($data['qtStock']))
            $errors['qtStock_err'] = 'Stock Quantity  field is empty';
        if (empty($data['prix']))
            $errors['prix_err'] = 'Product Price field is empty';
        if (empty($data['shortDesc']))
            $errors['shortDesc_err'] = 'Product short description field is empty';
        if (empty($data['subcategory']))
            $errors['subcategory_err'] = 'SubCategory not Selected';
        if (empty($data['subsubcategory'])) {
            $noSubSub = true;
            $data['withSubSub'] = false;
        } else {
            $data['withSubSub'] = true;
        }
        if (count($errors) > 0) {
            $errors['status'] = 'error';
            echo json_encode($errors);
            die();
        } else {
            $ext = $this->productModel->addProduct($data);
            if ($ext) {
                if (!$noImg) {
                    foreach ($data['productImages'] as $a) {
                        if (isset($a['image'])) {
                            $src = decodeImgs($a['image']);
                            $image = [
                                "src" => $src,
                                "alt" => $data['ProdName'],
                                "ref" => $data['ProdReference']
                            ];
                            $ext = $this->productModel->saveImages($image);
                        }
                    }
                }
                if (isset($data['technicalFile'])) {
                    if (count($data['technicalFile']) > 0) {
                        $spec = [
                            "prodRef" => $data['ProdReference'],
                            "prodName" => $data['ProdName'],
                            "specs" => $data['technicalFile']
                        ];
                        toJson($spec, "TechFiles\Products.json");
                        $keyDat = [];
                        foreach ($data['technicalFile'] as $d) {
                            array_push($keyDat, array_keys($d)[0]);
                        }
                        $keys = [
                            "subId" => $data['subcategory'],
                            "subsubId" => $data['subsubcategory'],
                            "keys" => $keyDat
                        ];
                        toJson($keys, "SpecByCat\speckeys.json");
                    }
                }
            } else {
                $errors['status'] = 'error';
                echo json_encode($errors);
                die();
            }
        }
        $response["status"] = "done";
        echo json_encode($errors);
        die();
    }
}
