<?php
class Trend
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get All Trends
    public function getTrends()
    {
        $this->db->query("SELECT p.* , c.id  , c.category_name  , sc.sub_category_name ,ssc.sub_sub_category_name , pim.*
        from products p LEFT JOIN subsubcategories ssc 
        on p.sub_sub_cat = ssc.id
        join subcategories sc 
        on p.sub_cat = sc.id
        join categories c 
        on sc.id_cat = c.id
        join productimages pim on p.prod_refer = pim.prod_ref
        where p.is_trend
        GROUP by p.prod_id
        order by p.prod_id     
        ");

        $results = $this->db->resultset();

        return $results;
    }
    // Remove Trends
    public function removeTrend($ref)
    {
        $this->db->query('UPDATE `products` SET `is_trend` = 0 WHERE prod_refer = :ref');
        $this->db->bind(':ref', $ref);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function setTrend($ref)
    {
        $this->db->query('UPDATE `products` SET `is_trend` = 1 WHERE prod_refer = :ref');
        $this->db->bind(':ref', $ref);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
