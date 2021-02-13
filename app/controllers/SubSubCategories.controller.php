<?php
class SubSubCategories extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
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
            'ssCategories' => $ssCategoryModel,
            'subcategories' => $subCategories,
            'categories' => $categories
        ];
        $this->view("admin.subsubCategorys.subSubCategories", $data);
    }
    // Add subsubCategory
    public function add()
    {
        $output = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'subSubCategoryName' => trim($_POST['subsubName']),
                'subcategory' => trim($_POST['subCatid']),
            ];
            if (empty($data['subSubCategoryName'])) {
                $data['Name_err'] = 'Please enter Sub-Sub Category name';
                if (empty($data['subcategory'])) {
                    $data['Category_err'] = 'Please Select the Subcategory';
                }
            }

            if (empty($data['Name_err']) && empty($data['Category_err'])) {
                $ext = $this->subSubCategoryModel->addSubSubCategory($data);
                if ($ext) {
                    if ($ext > 0)
                        $data['id'] = $ext;
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in adding the Sub-Sub Category';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong in adding the Sub-Sub Category';
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
                'subSubCategoryName' => trim($_POST['subsubName']),
                'subcategory' => trim($_POST['subCatid']),
            ];
            if (empty($data['subSubCategoryName'])) {
                $data['Name_err'] = 'Please enter Sub-Sub Category name';
                if (empty($data['subcategory'])) {
                    $data['Category_err'] = 'Please Select the Subcategory';
                }
            }

            if (empty($data['Name_err']) && empty($data['Category_err'])) {
                $ext = $this->subSubCategoryModel->updateSubSubCategory($data);
                if ($ext) {
                    if ($ext > 0)
                        $data['id'] = $ext;
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in updating the Sub-Sub Category';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong in updating the Sub-Sub Category';
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
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->subSubCategoryModel->deleteSubSubCat($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'Sub-Sub Category deleted successfully';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in deleting the Sub-Sub Category';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the Sub-Sub Category';
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
