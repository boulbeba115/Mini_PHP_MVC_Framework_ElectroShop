<?php
class Controller
{
    public function model($model)
    {
        $model = ucwords($model);
        if (file_exists('../app/models/' . $model . '.model.php')) {
            require_once('../app/models/' . $model . '.model.php');
            return new $model();
        } else
            throw new Exception("Model: '" . $model . "' does not Exists");
    }
    public function view($view, $data = [])
    {
        $view= str_replace(".","/",$view);
        if (file_exists('../app/views/' . $view . '.view.php')) {
            require_once('../app/views/' . $view . '.view.php');
        } else
            throw new Exception("View: '" . $view . "' does not Exists");
    }
    public function errorRedirect(){
        $this->view("front.404");
    }
    public function adminErrorRedirect(){
        $this->view("admin.404");
    }
}
