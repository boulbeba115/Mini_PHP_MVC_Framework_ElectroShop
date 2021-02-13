<?php
class SubSubCategory
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    //Add Sub Category
    public function addSubSubCategory($data)
    {
        $this->db->query('INSERT INTO subsubcategories (sub_sub_category_name, id_sub_cat) 
      VALUES (:name, :idsubcat)');
        $this->db->bind(':name', $data['subSubCategoryName']);
        $this->db->bind(':idsubcat', $data['subcategory']);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Get All subCategories
    public function getSubSubCategories()
    {
        $this->db->query("SELECT ssc.id , ssc.sub_sub_category_name ,c.category_name,sc.sub_category_name 
        from subsubcategories ssc join subcategories sc 
        on ssc.id_sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id        
        ORDER BY sc.id
        ");

        $results = $this->db->resultset();

        return $results;
    }
    // Get subCategory By Id
    public function getSubSubCategoryById($id)
    {
        $this->db->query("SELECT ssc.id , ssc.sub_sub_category_name ,c.category_name,sc.sub_category_name 
        from subsubcategories ssc join subcategories sc 
        on ssc.id_sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id        
        ORDER BY sc.id
        WHERE id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    // Update subSubCategory
    public function updateSubSubCategory($data)
    {

        $this->db->query('UPDATE subsubcategories SET sub_sub_category_name = :subsubcategoryName, id_sub_cat = :idsubcat WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':subsubcategoryName', $data['subSubCategoryName']);
        $this->db->bind(':idsubcat', $data['subcategory']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // delete SubCategory
    public function deleteSubSubCat($id)
    {
        $this->db->query('DELETE FROM subsubcategories WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
