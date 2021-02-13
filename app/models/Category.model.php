<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    //Add Category
    public function addCategory($data)
    {
        $this->db->query('INSERT INTO categories (category_name, category_description) 
      VALUES (:name, :description)');
        $this->db->bind(':name', $data['category']);
        $this->db->bind(':description', $data['description']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get All Categories
    public function getCategories()
    {
        $this->db->query("SELECT * from categories");

        $results = $this->db->resultset();

        return $results;
    }
    // Get Category By Id
    public function getCategoryById($id)
    {
        $this->db->query("SELECT * FROM categories WHERE id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    // Update Category
    public function updateCat($data)
    {

        $this->db->query('UPDATE categories SET category_name = :categoryName, category_description = :categoryDesc WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':categoryName', $data['category']);
        $this->db->bind(':categoryDesc', $data['description']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // delete Category
    public function deleteCat($id)
    {
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
