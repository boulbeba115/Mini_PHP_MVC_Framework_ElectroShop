<?php
class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAdminByUserName($username)
    {
        $this->db->query('SELECT id , user_name , is_owner FROM `admins` WHERE user_name like :user_name ;');
        $this->db->bind(':user_name', $username);
        $row = $this->db->single();
        return $row;
    }
    public function getAllAdmins()
    {
        $this->db->query("SELECT id , user_name , is_owner FROM admins ");
        $results = $this->db->resultset();
        return $results;
    }
    public function login($userName, $password)
    {
        $this->db->query("SELECT * FROM admins WHERE user_name = :user_name");
        $this->db->bind(':user_name', $userName);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }

    public function addAdmin($data)
    {
        $this->db->query('INSERT INTO admins (user_name, password, is_owner) VALUES (:user_name , :password , :is_owner);');
        $this->db->bind(':user_name', $data['user_name']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':is_owner', false);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    public function deleteAdmin($id)
    {
        $this->db->query('DELETE FROM admins WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
