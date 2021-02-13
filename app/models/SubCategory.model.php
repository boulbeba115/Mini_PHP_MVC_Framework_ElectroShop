<?php
class SubCategory
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    //Add Sub Category
    public function addSubCategory($data)
    {
        $this->db->query('INSERT INTO subcategories (sub_category_name, id_cat) 
      VALUES (:name, :idcat)');
        $this->db->bind(':name', $data['subCategoryName']);
        $this->db->bind(':idcat', $data['category']);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Get All subCategories
    public function getSubCategories()
    {
        $this->db->query("SELECT sc.id , sc.sub_category_name , c.category_name 
        from subcategories sc join categories c 
        on sc.id_cat = c.id ORDER BY sc.id_cat
        ");

        $results = $this->db->resultset();

        return $results;
    }
    // Get subCategory By Id
    public function getSubCategoryById($id)
    {
        $this->db->query("SELECT * FROM subcategories sc join categories c on sc.id_cat = c.id WHERE id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    // Update subCategory
    public function updateSubCategory($data)
    {

        $this->db->query('UPDATE subcategories SET sub_category_name = :categoryName, id_cat = :idCat WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':categoryName', $data['subCategoryName']);
        $this->db->bind(':idCat', $data['category']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // delete Category
    public function deleteSubCat($id)
    {
        $this->db->query('DELETE FROM subcategories WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
