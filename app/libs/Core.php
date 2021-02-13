<?php
class Core
{
    private $currentController = "Index";
    private $notFound = "ErrorPage";
    private $currentMethod = "index";
    private $params = [];
    private $lastindex = 0;
    private $inAdmin = false;
    public function __construct()
    {
        $url = $this->getUrl();
        $url = $this->getController($url);
        $url = $this->getMethod($url);
        $this->params = $url ? array_values($url) : [];
        if (isset($this->currentMethod)) {
            try {
                call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
            } catch (Exception $e) {
                echo $e;
            }
        }
    }
    public function __toString()
    {
        return (string) $this->currentMethod;
    }
    //get Url 
    public function getUrl()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"]);
            $url = trim($url, "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
    }
    //get controller
    public function getController($url)
    {
        try {
            $fullUrl = $url;
            if (isset($fullUrl[0])) {
                if (isset($fullUrl[1]) && strtolower($fullUrl[0]) == "dashborad") {
                    if(!isAdminLoggedIn()){
                        redirect('auth/logAdminDash');
                        die();
                    }
                    if (file_exists('../app/controllers/' . $fullUrl[1] . '.controller.php')) {
                        $this->currentController = $fullUrl[1];
                        unset($fullUrl[0]);
                        unset($fullUrl[1]);
                        $this->lastindex = 1;
                        $this->inAdmin = true;
                    } else {
                        unset($fullUrl[0]);
                        unset($fullUrl[1]);
                        $this->currentController = $this->notFound;
                        $this->currentMethod = "notFound";
                    }
                } else if (isset($fullUrl[1]) == false && strtolower($fullUrl[0]) == "dashborad") {
                    if(!isAdminLoggedIn()){
                        redirect('auth/logAdminDash');
                        die();
                    }
                    if (file_exists('../app/controllers/' . $fullUrl[0] . '.controller.php')) {
                        $this->currentController = $fullUrl[0];
                        unset($fullUrl[0]);
                        $this->lastindex = 0;
                        $this->inAdmin = true;
                    }
                } else if (strtolower($fullUrl[0]) != "dashborad") {
                    if (file_exists('../app/controllers/' . $fullUrl[0] . '.controller.php')) {
                        $this->currentController = $fullUrl[0];
                        unset($fullUrl[0]);
                        $this->lastindex = 0;
                    } else {
                        $this->currentController = $this->notFound;
                        $this->lastindex = 0;
                    }
                } else {
                    $this->currentController = $this->notFound;
                    $this->lastindex = 0;
                }
            }
            require_once('../app/controllers/' . $this->currentController . '.controller.php');
            $this->currentController = new  $this->currentController;
            return $fullUrl;
        } catch (Exception $e) {
            echo "</br> <span style='color:red'>No Page Found </span>";
        }
    }
    //get method
    public function getMethod($url)
    {
        try {
            if (isset($url[++$this->lastindex])) {
                if (method_exists($this->currentController, $url[$this->lastindex])) {
                    $this->currentMethod = $url[$this->lastindex];
                    unset($url[$this->lastindex]);
                } else {
                    if ($this->inAdmin)
                        $this->currentMethod = "adminErrorRedirect";
                    else
                        $this->currentMethod = "errorRedirect";
                }
                return $url;
            }
        } catch (Exception $e) {
            echo "</br> <span style='color:red'>No Method Found </span>";
        }
    }
}
