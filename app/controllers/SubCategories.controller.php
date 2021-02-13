<?php
class SubCategories extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->subCategoryModel = $this->model('SubCategory');
        $this->categoryModel = $this->model('Category');
    }
    public function index()
    {
        $subCategories = $this->subCategoryModel->getSubCategories();
        $categories = $this->categoryModel->getCategories();
        $data = [
            'subcategories' => $subCategories,
            'categories' => $categories
        ];
        $this->view("admin.subCategorys.subCategories", $data);
    }
    public function create()
    {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        $this->view("admin.subCategorys.create", $data);
    }
    // Add subCategory
    public function add()
    {
        $output = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'subCategoryName' => trim($_POST['subCategoryName']),
                'category' => trim($_POST['category']),
            ];
            if (empty($data['subCategoryName'])) {
                $data['Name_err'] = 'Please enter subCategory name';
                if (empty($data['category'])) {
                    $data['Category_err'] = 'Please Select the category';
                }
            }

            if (empty($data['Name_err']) && empty($data['Category_err'])) {
                $ext = $this->subCategoryModel->addSubCategory($data);
                if ($ext) {
                    if ($ext > 0)
                        $data['id'] = $ext;
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in adding the SubCategory';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong in adding the SubCategory';
            }
        } else {
            $data = [
                'subCategoryName' => '',
                'category' => '',
            ];
        }
        echo json_encode($output);
        die();
    }
    public function update()
    {
        $output = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => trim($_POST['id']),
                'subCategoryName' => trim($_POST['subCategoryName']),
                'category' => trim($_POST['category']),
            ];
            if (empty($data['subCategoryName'])) {
                $data['Name_err'] = 'Please enter subCategory name';
                if (empty($data['category'])) {
                    $data['Category_err'] = 'Please Select the category';
                }
            }
            if (empty($data['Name_err']) && empty($data['Category_err'])) {
                if ($this->subCategoryModel->updateSubCategory($data)) {
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in updating the SubCategory';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong in updating the SubCategory';
            }
        } else {
            $data = [
                'subCategoryName' => '',
                'category' => '',
            ];
        }
        echo json_encode($output);
        die();
    }
    public function deleteSubCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->subCategoryModel->deleteSubCat($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'SubCategory deleted successfully';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in deleting the subcategory';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the subcategory';
        }
    }
    public function getSubCategory()
    {
        /*  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $row = $this->subCategoryModel->getSubCategoryById($id);
                if (isset($row)) {
                    $output['status'] = 'success';
                    $output['data'] = $row;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'No Category Found with this id';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'No Category Found with this id';
        } */
    }
}
