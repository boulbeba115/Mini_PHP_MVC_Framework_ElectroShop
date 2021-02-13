<?php
class CheckOut extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('auth/login');
        }
        $this->categoryModel = $this->model('Category');
        $this->subSubCategoryModel = $this->model('SubSubCategory');
        $this->subCategoryModel = $this->model('SubCategory');
        $this->isLogged = isLoggedIn();
        $this->userModel = $this->model('User');
        $this->ordersModel = $this->model('Order');
        $this->productModel = $this->model('Product');

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
            "categories" => $this->cate,
            "isLogged" => $this->isLogged,
        ];
        if (!($this->isLogged)) {
            $this->view('front.login', $data);
            die();
        }
        $data["user"] = $this->userModel->getUserById($_SESSION['user_id']);

        $this->view('front.checkout', $data);
    }
    public function placeOrder()
    {
        $output = [];
        $changes = 0;
        $orderLinesError = 0;
        $data = [
            "categories" => $this->cate,
            "isLogged" => $this->isLogged,
        ];
        if (!($this->isLogged)) {
            $this->view('front.login', $data);
            die();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (count($_POST['orderline']) < 1) {
                $output['status'] = 'error';
                $output['message'] = 'No Items in the ShoppingCard';
                echo (json_encode($output));
                die();
            }

            $client = $_POST['user'];
            $dbclient = $this->userModel->getUserById($_SESSION['user_id']);

            if (empty($client['first_name'])) {
                $client['first_name'] = $dbclient->first_name;
            }
            if (empty($client['last_name'])) {
                $client['last_name'] = $dbclient->last_name;
            }
            if (empty($client['adress'])) {
                $client['adress'] = $dbclient->adress;
            }
            if (empty($client['phone_number'])) {
                $client['phone_number'] = $dbclient->phone_number;
            }
            if (!is_null($dbclient)) {
                if ($dbclient->first_name != $client['first_name']) {
                    $changes++;
                }
                if ($dbclient->last_name != $client['last_name']) {
                    $changes++;
                }
                if ($dbclient->adress != $client['adress']) {
                    $changes++;
                }
                if ($dbclient->phone_number != $client['phone_number']) {
                    $changes++;
                }
            }
            if ($changes > 0) {
                $client['id'] = $_SESSION['user_id'];
                $this->userModel->updateBUser($client);
            }
            $order = [
                'order_refer' => generateRandomString(5) . '_' . 'client_' . $_SESSION['user_id'],
            ];

            if (isset($_POST['payment_method']) && ($_POST['payment_method'] >= 0 && $_POST['payment_method'] < 3)) {
                $order['payment_method'] = $_POST['payment_method'];
            }
            $order['customer_id'] = $_SESSION['user_id'];
            if ($this->ordersModel->addOrder($order)) {
                foreach ($_POST['orderline'] as $line) {
                    $items = [
                        'prod_ref' => $line['reference'],
                        'cmd_ref'  => $order['order_refer'],
                        'quantity' => $line['quantity'],
                    ];
                    if (!($this->ordersModel->addOrderLine($items))) {
                        $orderLinesError++;
                    } else {
                        $qtstock = $this->productModel->getStkQte($items['prod_ref'])->qt_stock;
                        if ($qtstock - $line['quantity'] >= 0) {
                            $qtstock = $qtstock - $line['quantity'];
                            $row = [
                                'ref' => $line['reference'],
                                'qt' => $qtstock
                            ];
                            $this->productModel->updateStockQuantity($row);
                        } else {
                            $output['status'] = 'error';
                            $output['message'] = 'Not Enough Quantity for Product ' . $line['name'];
                            echo (json_encode($output));
                            die();
                        }
                    }
                }
                if ($orderLinesError > 0) {
                    $output['status'] = 'error';
                    $output['message'] = 'Error While Inserting Order';
                    echo (json_encode($output));
                    die();
                }
                $output['status'] = 'Success';
                $output['message'] = 'Order Added Successfully';
                echo (json_encode($output));
                die();
            } else {
                $output['status'] = 'error';
                $output['message'] = 'Error While Inserting Order';
                echo (json_encode($output));
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Not Authorized Action';
            echo (json_encode($output));
            die();
        }
    }
}
