<?php
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    //Add Category
    public function addProduct($data)
    {
        $this->db->query('INSERT INTO `products` (`prod_refer`, `prod_name`, `prod_short_desc`, `prod_long_desc`,' .
            '`brand`, `qt_stock`, `prod_price`, `sub_cat`, `sub_sub_cat` , `is_trend`)' .
            'VALUES (:prod_refer, :prod_name, :prod_short_desc, :prod_long_desc, :brand ,:qt_stock, :prod_price, :sub_cat, :sub_sub_cat, :is_trend);');
        $this->db->bind(':prod_refer', $data['ProdReference']);
        $this->db->bind(':prod_name', $data['ProdName']);
        $this->db->bind(':prod_short_desc', $data['shortDesc']);
        $this->db->bind(':prod_long_desc', $data['longDesc']);
        $this->db->bind(':brand', $data['ProdBrand']);
        $this->db->bind(':qt_stock', $data['qtStock']);
        $this->db->bind(':prod_price', $data['prix']);
        $this->db->bind(':sub_cat', $data['subcategory']);
        $this->db->bind(':is_trend', $data['is_trend']);
        if ($data["withSubSub"]) {
            $this->db->bind(':sub_sub_cat', $data['subsubcategory']);
        } else
            $this->db->bind(':sub_sub_cat', 0);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function saveImages($data)
    {
        $this->db->query("INSERT INTO `productimages` (`src`, `alt`,`prod_ref`) VALUES (:src , :alt, :ref);");
        $this->db->bind(':src', $data['src']);
        $this->db->bind(':alt', $data['alt']);
        $this->db->bind(':ref', $data['ref']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function findByReference($reference)
    {
        $this->db->query("SELECT * FROM products WHERE prod_refer like :reference");

        $this->db->bind(':reference', $reference);

        $row = $this->db->single();

        return $row;
    }
    // Get All Porducts
    public function getProducts()
    {
        $this->db->query("SELECT p.* , c.id as cat_id  , c.category_name , sc.sub_category_name ,ssc.sub_sub_category_name  
        from products p LEFT JOIN subsubcategories ssc 
        on p.sub_sub_cat = ssc.id
        join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id   
        order by p.prod_id  
        ");

        $results = $this->db->resultset();

        return $results;
    }

    //Get Products By category
    public function getTrends($catName)
    {
        $this->db->query("SELECT p.* , c.id  , c.category_name  , sc.sub_category_name ,ssc.sub_sub_category_name , pim.*
        from products p LEFT JOIN subsubcategories ssc 
        on p.sub_sub_cat = ssc.id
        join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where LOWER(c.category_name)  like LOWER(:catName)
        GROUP by p.prod_id
        order by p.prod_price     
        ");

        $results = $this->db->resultset();

        return $results;
    }
    //Get Products By category
    public function byCategory($catName)
    {
        $this->db->query("SELECT  p.prod_id , p.prod_refer, p.prod_name, p.brand, p.qt_stock,p.prod_price, c.id  , c.category_name  , sc.sub_category_name , pim.*
        from products p join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where LOWER(replace(c.category_name ,' ', '') )  like LOWER(:catName)
        GROUP by p.prod_id
        order by p.prod_price     
        ");
        $this->db->bind(':catName', $catName);
        $results = $this->db->resultset();

        return $results;
    }
    //Get Products By SubCategory
    public function bySubCategory($subCatName)
    {
        $this->db->query("SELECT p.prod_id , p.prod_refer, p.prod_name, p.brand, p.qt_stock,p.prod_price, c.id  , c.category_name  , sc.sub_category_name , pim.*
        from products p join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where LOWER(replace(sc.sub_category_name ,' ', '') )  like LOWER(:subCatName)
        GROUP by p.prod_id
        order by p.prod_price     
        ");
        $this->db->bind(':subCatName', $subCatName);
        $results = $this->db->resultset();

        return $results;
    }
    //Get Products By SubSubCategory
    public function bySubSubCategory($subSubCatName)
    {
        $this->db->query("SELECT p.prod_id , p.prod_refer, p.prod_name, p.brand, p.qt_stock,p.prod_price, c.id  , c.category_name  , sc.sub_category_name ,ssc.sub_sub_category_name , pim.*
        from products p join subsubcategories ssc 
        on p.sub_sub_cat = ssc.id
        join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where LOWER(replace(ssc.sub_sub_category_name,' ', '') )  like LOWER(:subSubCatName)
        GROUP by p.prod_id
        order by p.prod_price  
        ");
        $this->db->bind(':subSubCatName', $subSubCatName);
        $results = $this->db->resultset();

        return $results;
    }
    //get product by reference
    public function byReference($reference)
    {
        $this->db->query("SELECT p.* , c.id  , c.category_name  , sc.sub_category_name ,ssc.sub_sub_category_name , pim.*
        from products p LEFT JOIN subsubcategories ssc 
        on p.sub_sub_cat = ssc.id
        join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where replace(p.prod_refer,' ', '')   like :reference
        order by p.prod_price  
        ");
        $this->db->bind(':reference', $reference);
        $results = $this->db->resultset();

        return $results;
    }
    public function getStkQte($reference)
    {
        $this->db->query("SELECT qt_stock FROM products WHERE prod_refer like :reference");

        $this->db->bind(':reference', $reference);

        $row = $this->db->single();

        return $row;
    }
    public function updateStockQuantity($data)
    {
        $this->db->query("UPDATE `products` SET `qt_stock` = :qt_stock WHERE prod_refer = :reference;");
        $this->db->bind(':reference', $data['ref']);
        $this->db->bind(':qt_stock', $data['qt']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
