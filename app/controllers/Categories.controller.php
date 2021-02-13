<?php
class Categories extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->categoryModel = $this->model('Category');
    }
    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        $data = [
            'categories' => $categories
        ];
        $this->view("admin.category.categories", $data);
    }
    public function create()
    {
        $this->view("admin.category.create");
    }
    public function test()
    {
        $this->view("admin.category.testing");
    }
    // Add Category
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category' => trim($_POST['categoryName']),
                'description' => trim($_POST['categoryDesc']),
            ];

            if (empty($data['category'])) {
                $data['Name_err'] = 'Please enter name';
                if (empty($data['description'])) {
                    $data['Description_err'] = 'Please enter the description of the category';
                }
            }

            if (empty($data['Name_err']) && empty($data['Description_err'])) {

                if ($this->categoryModel->addCategory($data)) {
                    // Redirect to login
                    flash('category_added', 'Category Added');
                    redirect('Dashborad/Categories');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('admin.category.create', $data);
            }
        } else {
            $data = [
                'category' => '',
                'description' => '',
            ];

            $this->view('admin.category.create', $data);
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $output = [];
            $data = [
                'id' => trim($_POST['id']),
                'category' => trim($_POST['categoryName']),
                'description' => trim($_POST['categoryDesc']),
            ];

            if (empty($data['category'])) {
                $output['status'] = 'error';
                $output['Name_err'] = 'Please enter category name';
            } 
            if (empty($data['description'])) {
                $output['status'] = 'error';
                $output['Description_err'] = 'Please enter the description of the category';
            }
            if (empty($output['Description_err']) && empty($output['Name_err'])) {
                if ($this->categoryModel->updateCat($data)) {
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in updating the category';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong in updating the category';
            }
        } else {
            $data = [
                'category' => '',
                'description' => '',
            ];
        }
        echo json_encode($output);
        die();
    }
    public function deleteCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->categoryModel->deleteCat($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'Category deleted successfully';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in deleting the category';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the category';
        }
    }
    public function getCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $row = $this->categoryModel->getCategoryById($id);
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
        }
    }
}
