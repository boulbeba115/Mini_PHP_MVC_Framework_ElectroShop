<?php
class Auth extends Controller
{
    public function __construct()
    {
        $this->subCategoryModel = $this->model('SubCategory');
        $this->subSubCategoryModel = $this->model('SubSubCategory');
        $this->categoryModel = $this->model('Category');
        $this->userModel = $this->model('User');
        $this->adminModel = $this->model('Admin');

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
        $this->login();
    }
    public function login()
    {
        if ($this->isLoggedIn()) {
            redirect('');
        }
        $data = [
            "categories" => $this->cate,
        ];
        $this->view('front.login', $data);
    }
    public function register()
    {
        if ($this->isLoggedIn()) {
            redirect('');
        }
        $data = [
            "categories" => $this->cate,
        ];
        $this->view('front.register', $data);
    }
    public function signIn()
    {
        if ($this->isLoggedIn()) {
            redirect('');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                "categories" => $this->cate,
            ];

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email.';
            }

            $row = $this->userModel->findUserByEmail($data['email']);
            if (empty($row)) {
                $data['email_err'] = 'This email is not registered.';
            }

            if (empty($data['email_err']) && empty($data['password_err'])) {

                $validLogin = $this->userModel->login($data['email'], $data['password']);
                if ($validLogin) {
                    $this->createUserSession($row);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('front.login', $data);
                }
            } else {
                // Load View
                $this->view('front.login', $data);
            }
        } else {
            // If NOT a POST

            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load View
            $this->view('users/login', $data);
        }
    }
    public function registerCustomer()
    {
        $errorCount = 0;
        if ($this->isLoggedIn()) {
            redirect('');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'first_name' => trim($_POST['firstName']),
                'last_name' => trim($_POST['lastName']),
                'cin' => trim($_POST['cin']),
                'email' => trim($_POST['email']),
                'adress' => trim($_POST['adress']),
                'phone_number' => trim($_POST['phone']),
                'password' => trim($_POST['pass']),
                "categories" => $this->cate,
            ];

            // Validate email
            if (empty($data['first_name'])) {
                $data['first_name_err'] = 'Please enter FirstName';
                $errorCount++;
            }
            if (empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter LastName';
                $errorCount++;
            }
            if (empty($data['cin'])) {
                $data['cin_err'] = 'Please enter cin Number';
                $errorCount++;
            } else if (!is_numeric($data['cin'])) {
                $data['phone_err'] = 'The Cin number must be numeric';
                $errorCount++;
            }
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email';
                $errorCount++;
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                    $errorCount++;
                }
            }
            if (empty($data['adress'])) {
                $data['adress_err'] = 'Please enter Adress';
                $errorCount++;
            }
            if (empty($data['phone_number'])) {
                $data['phone_err'] = 'Please enter phone Number';
                $errorCount++;
            } else if (!is_numeric($data['phone_number'])) {
                $data['phone_err'] = 'The phone number must be numeric';
                $errorCount++;
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
                $errorCount++;
            } else {
                if (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must have at least 6 characters';
                    $errorCount++;
                }
            }

            if ($errorCount < 1) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                //Execute
                if ($this->userModel->registerUser($data)) {
                    flash('register_success', 'You are now registered and can log in');
                    redirect('auth/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load View
                $this->view('front.register', $data);
            }
        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'cin' => '',
                'email' => '',
                'adress' => '',
                'phone_number' => '',
                'password' => '',
                "categories" => $this->cate,
            ];
            $this->view('users/register', $data);
        }
    }

    public function logAdminDash()
    {
        if ($this->isAdminLoggedIn()) {
            redirect('dashborad');
        }
        $this->view("admin.users.login");
    }
    public function authticateAdmin()
    {
        if ($this->isAdminLoggedIn()) {
            redirect('dashborad');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_name' => trim($_POST['username']),
                'password' => trim($_POST['password']),
            ];

            if (empty($data['user_name'])) {
                $data['username_err'] = 'Please enter username.';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password.';
            }
            $row = $this->adminModel->getAdminByUserName($data['user_name']);
            if (empty($row)) {
                $data['username_err'] = 'Invalid UserName';
            }
            if (empty($data['username_err']) && empty($data['password_err'])) {
                $validLogin = $this->adminModel->login($data['user_name'], $data['password']);
                if ($validLogin) {
                    $this->createAdminSession($row);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('admin.users.login', $data);
                }
            } else {
                $this->view('admin.users.login', $data);
            }
        } else {
            $data = [];
            $this->view('admin.users.login', $data);
        }
    }

    // Check Logged In
    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
    // Check Logged In
    public function isAdminLoggedIn()
    {
        if (isset($_SESSION['admin_id'])) {
            return true;
        } else {
            return false;
        }
    }
    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['first_name'] = $user->first_name;
        $_SESSION['last_name'] = $user->last_name;
        redirect('');
    }
    public function createAdminSession($admin)
    {
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['admin_name'] = $admin->user_name;
        $_SESSION['is_master'] = $admin->is_owner;
        redirect('/dashborad');
    }
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last_name']);
        session_destroy();
        redirect('auth/login');
    }
    public function disconnect()
    {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        unset($_SESSION['is_master']);
        session_destroy();
        redirect('auth/logAdminDash');
    }
    public function UpdateCustomer()
    {
        $errorCount = 0;
        $changepass = false;
        if (!($this->isLoggedIn())) {
            redirect('auth/login');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $user = [
                'first_name' => trim($_POST['firstName']),
                'last_name' => trim($_POST['lastName']),
                'adress' => trim($_POST['adress']),
                'cin' => trim($_POST['cin']),
                'email' => trim($_POST['email']),
                'phone_number' => trim($_POST['phone']),
            ];
            $data = [
                'user' => $user,
                "categories" => $this->cate,
                "isLogged" => $this->isLoggedIn(),
                "afterUp" => true
            ];
            $oldpass = (!empty($_POST['oldpass'])) ? $_POST['oldpass'] : "";
            $newpass = (!empty($_POST['newpass'])) ? $_POST['newpass'] : "";
            if (!empty($newpass))
                $changepass = true;
            if (empty($user['first_name'])) {
                $data['first_name_err'] = 'Please enter FirstName';
                $errorCount++;
            }
            if (empty($user['last_name'])) {
                $data['last_name_err'] = 'Please enter LastName';
                $errorCount++;
            }

            if (empty($user['adress'])) {
                $data['adress_err'] = 'Please enter Adress';
                $errorCount++;
            }
            if (empty($user['phone_number'])) {
                $data['phone_err'] = 'Please enter phone Number';
                $errorCount++;
            } else if (!is_numeric($user['phone_number'])) {
                $data['phone_err'] = 'The phone number must be numeric';
                $errorCount++;
            }
            if (empty($oldpass)) {
                $data['old_pass_err'] = 'Plz enter your current password';
                $errorCount++;
            }
            if ($changepass) {
                if (strlen($newpass) < 6) {
                    $data['new_pass_err'] = 'Password must have at least 6 characters';
                    $errorCount++;
                }
            }
            if ($errorCount < 1) {
                $validLogin = $this->userModel->login($user['email'], $oldpass);
                if (!$validLogin) {
                    $data['old_pass_err'] = 'Password incorrect';
                    $this->view('front.myAcount', $data);
                }
                $user['id'] = $_SESSION["user_id"];
                if (!$changepass) {
                    if ($this->userModel->updateBUser($user)) {
                        flash('update_success', 'Account updated Successfully');
                        $this->view("front.myAcount", $data);
                    } else {
                        die();
                    }
                } else {
                    $user['password'] = password_hash($newpass, PASSWORD_DEFAULT);
                    if ($this->userModel->updateUser($user)) {
                        flash('update_success', 'Password Changed connect with your new password');
                        $this->logout();
                        $this->view("front.login", $data);
                    } else {
                        die();
                    }
                }
            } else {
                $this->view('front.myAcount', $data);
            }
        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'cin' => '',
                'email' => '',
                'adress' => '',
                'phone_number' => '',
                'password' => '',
                "categories" => $this->cate,
            ];
            $this->view('', $data);
        }
    }
}
