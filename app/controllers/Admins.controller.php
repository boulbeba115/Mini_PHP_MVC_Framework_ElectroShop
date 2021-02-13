<?php
class Admins extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->adminModel = $this->model('Admin');
    }
    public function index()
    {
        $data = [
            "admins" => $this->adminModel->getAllAdmins()
        ];
        $this->view('admin.users.admins', $data);
    }
    public function create()
    {
        $output = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_name' => trim($_POST['userName']),
                'password' => trim($_POST['password']),
            ];
            if (empty($data['user_name'])) {
                $data['user_name_err'] = 'Please enter userName';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }
            if (empty($data['user_name_err']) && empty($data['password_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $ext = $this->adminModel->addAdmin($data);
                if ($ext) {
                    if ($ext > 0)
                        $data['id'] = $ext;
                    unset($data['password']);
                    $output['status'] = 'success';
                    $output['data'] = $data;
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong';
                }
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Something went wrong';
            }
        } else {
            $data = [
                'user_name' => '',
                'password' => '',
            ];
        }
        echo json_encode($output);
        die();
    }
    public function delete()
    {
        $output = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isAdminLoggedIn()) {
                if (isset($_SESSION['is_master']) && $_SESSION['is_master']) {
                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                        if ($id == $_SESSION['admin_id']) {
                            $output['status'] = 'error';
                            $output['message'] = "You can't delete your own account";
                            echo json_encode($output);
                            die();
                        }
                        if ($this->adminModel->deleteAdmin($id)) {
                            $output['status'] = 'success';
                            $output['message'] = 'Deleted successfully';
                        } else {
                            $output['status'] = 'error';
                            $output['message'] = 'Something went wrong';
                        }
                    }
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'You dont have access to do this action';
                    echo json_encode($output);
                    die();
                }
            } else {
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'You dont have access to do this action';
        }
        echo json_encode($output);
        die();
    }
}
