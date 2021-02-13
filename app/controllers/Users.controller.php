<?php
class Users extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        $data = [
            "users" => $this->userModel->getUsersWithOrders()
        ];
        $this->view("admin.users.users", $data);
    }
    public function userState($state)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($state == 1 || $state == 0) {
                    if ($this->userModel->setUserState($state, $id)) {
                        $output['status'] = 'success';
                        $output['message'] = 'changed';
                    } else {
                        $output['status'] = 'error';
                        $output['message'] = 'Something went wrong When changing status';
                    }
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Not Authorized Action';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong When changing status';
            echo json_encode($output);
            die();
        }
    }
}
