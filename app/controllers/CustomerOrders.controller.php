<?php
class CustomerOrders extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->orderModel = $this->model('Order');
    }
    public function index()
    {
        $data = [
            "orders" => $this->orderModel->getAllOrders()
        ];
        $this->view('admin.orders.orders', $data);
    }
    public function details($ref = "")
    {
        if (empty($ref)) {
            redirect("CustomerOrders");
        }
        $data = [
            "orders" => $this->orderModel->getOrderItems($ref),
        ];
        $this->view("admin.orders.OrderDetails", $data);
    }
    public function confirm()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $ref = $_POST['id'];
                if ($this->orderModel->confirmOrder($ref)) {
                    $output['status'] = 'success';
                    $output['message'] = 'changed';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong When changing status';
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
