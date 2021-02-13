<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function findUserByEmail($email)
    {
        $this->db->query('SELECT id , email , first_name , last_name , `status` FROM `users` WHERE email like :email ;');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        return $row;
    }
    public function getUserById($id)
    {
        $this->db->query('SELECT id , email , first_name, last_name,cin, adress , phone_number , `status` FROM `users` WHERE id like :id ;');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    public function registerUser($data)
    {
        $this->db->query("INSERT INTO `users` (`first_name`, `last_name`, `cin`, `email`, `adress`, `phone_number`, `password`, `status`)
        VALUES (:first_name, :last_name, :cin, :email, :adress, :phone_number, :password, 0);");
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':cin', $data['cin']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':adress', $data['adress']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function login($email, $password)
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
    public function getAllUsers()
    {
        $this->db->query('SELECT id , email , first_name, last_name,cin, adress , phone_number , `status` FROM `users`;');
        $results = $this->db->resultset();
        return $results;
    }
    public function getUsersWithOrders()
    {
        $this->db->query('SELECT u.id , u.first_name , u.last_name , u.cin ,u.email , u.phone_number ,u.adress , u.status , o.order_refer, count(o.order_refer) as nbOrders
        FROM users u LEFT join orders o on o.customer_id = u.id
        GROUP by u.id;');
        $results = $this->db->resultset();
        return $results;
    }

    public function updateBUser($data)
    {
        $this->db->query('UPDATE users SET first_name = :first_name, last_name = :last_name, adress = :adress, phone_number = :phone_number WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':adress', $data['adress']);
        $this->db->bind(':phone_number', $data['phone_number']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUser($data)
    {
        $this->db->query('UPDATE users SET first_name = :first_name, last_name = :last_name, adress = :adress, phone_number = :phone_number , password = :password WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':adress', $data['adress']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function setUserState($status, $id)
    {
        $this->db->query('UPDATE `users` SET `status` = :status WHERE id = :id ;');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
