<?php
class Dashborad extends Controller
{
    public function __construct()
    {
        if (!isAdminLoggedIn()) {
            redirect('auth/logAdminDash');
        }
    }
    public function index()
    {
        $this->view("admin.home");
    }
}
