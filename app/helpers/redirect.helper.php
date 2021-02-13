<?php
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}
function isLoggedIn()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}
function isAdminLoggedIn()
{
    if (isset($_SESSION['admin_id'])) {
        return true;
    } else {
        return false;
    }
}
