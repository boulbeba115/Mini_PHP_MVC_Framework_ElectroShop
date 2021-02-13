<?php
class HomePage extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
        $this->coverModel = $this->model('Cover');
        $this->trendModel = $this->model('Trend');
        $this->subCategoryModel = $this->model('SubCategory');
        $this->categoryModel = $this->model('Category');
    }
    public function trends()
    {
        $data = [
            'trends' => $this->trendModel->getTrends(),
            'subCats' => $this->subCategoryModel->getSubCategories(),
            'categories' => $this->categoryModel->getCategories()
        ];
        $this->view("admin.home.trends", $data);
    }
    public function covers()
    {
        $data = [
            'covers' => $this->coverModel->getCovers()
        ];
        $this->view("admin.home.cover", $data);
    }
    public function addToTrend()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->trendModel->setTrend($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'Product added to trends';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong ';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the cover';
        }
    }
    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->trendModel->removeTrend($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'Product removed from trends';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in removing the Product';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the cover';
        }
    }
    public function create()
    {
        $this->view("admin.home.create");
    }
    public function addCover()
    {
        $errorCount = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'cover_title' => trim($_POST['coverTitle']),
                'cover_sub_title' => trim($_POST['CoverSubTitle']),
                'cover_href' => trim($_POST['coverLink']),
            ];
            $target = APPROOT . '\public\assets\covers\\';
            $src = uploadImg($_FILES, $target, "imgCov");
            if ($src) {
                $data["cover_img"] = $src;
            }
            if (isset($_POST['coversatus'])) {
                $data["status"] = 1;
            } else
                $data["status"] = 0;

            if (empty($data['cover_title'])) {
                $data['cover_title_err'] = 'Please enter the cover title ';
                $errorCount++;
            }
            if (empty($data['cover_sub_title'])) {
                $data['cover_sub_title_err'] = 'Please enter the cover sub-title';
                $errorCount++;
            }
            if (empty($data['cover_href'])) {
                $data['cover_href_err'] = 'Please enter the Link (url) of the cover';
                $errorCount++;
            }
            if (!$src) {
                $data['cover_img_err'] = 'Please pick an image';
                $errorCount++;
            }
            if ($errorCount < 1) {
                if ($this->coverModel->addCover($data)) {
                    flash('cover_added', 'Cover Added');
                    redirect('Dashborad/HomePage/covers');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('admin.home.create', $data);
            }
        }
    }
    public function deleteCover()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->coverModel->deleteCover($id)) {
                    $output['status'] = 'success';
                    $output['message'] = 'cover deleted successfully';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong in deleting the cover';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong in deleting the cover';
        }
    }
    public function changeStat($parm)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                if ($this->coverModel->changeState($id, $parm)) {
                    $output['status'] = 'success';
                    $output['message'] = 'cover changed successfully';
                } else {
                    $output['status'] = 'error';
                    $output['message'] = 'Something went wrong';
                }
                echo json_encode($output);
                die();
            }
        } else {
            $output['status'] = 'error';
            $output['message'] = 'Something went wrong ';
        }
    }
    public function editCovers($id)
    {
        $data = $this->coverModel->getCoverById($id);
        $this->view("admin.home.edit", $data);
    }
    public function updateCover($id)
    {
        $errorCount = 0;
        $defaultImg = false;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'cover_id' => $id,
                'cover_title' => trim($_POST['coverTitle']),
                'cover_sub_title' => trim($_POST['CoverSubTitle']),
                'cover_href' => trim($_POST['coverLink']),
            ];
            $target = APPROOT . '\public\assets\covers\\';
            if (count($_FILES) > 0) {
                $src = uploadImg($_FILES, $target, "imgCov");
                if ($src) {
                    $data["cover_img"] = $src;
                } else {
                    $defaultImg = true;
                }
            } else
                $defaultImg = true;

            if (isset($_POST['coversatus'])) {
                $data["status"] = 1;
            } else
                $data["status"] = 0;

            if (empty($data['cover_title'])) {
                $data['cover_title_err'] = 'Please enter the cover title ';
                $errorCount++;
            }
            if (empty($data['cover_sub_title'])) {
                $data['cover_sub_title_err'] = 'Please enter the cover sub-title';
                $errorCount++;
            }
            if (empty($data['cover_href'])) {
                $data['cover_href_err'] = 'Please enter the Link (url) of the cover';
                $errorCount++;
            }
            if ($errorCount < 1) {
                if ($this->coverModel->editCover($data, $defaultImg)) {
                    flash('cover_added', 'Cover Edited');
                    redirect('Dashborad/HomePage/covers');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view("admin.home.edit", $data);
            }
        }
    }
}
