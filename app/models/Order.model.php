<?php
class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function addOrder($data)
    {
        $this->db->query('INSERT INTO `orders` (`order_refer`, `payment_method`, `status` , `customer_id`) VALUES (:order_refer , :payment_method , :status , :customer_id );');
        $this->db->bind(':order_refer', $data['order_refer']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':status', 0);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    public function addOrderLine($data)
    {
        $this->db->query('INSERT INTO `orders_line` (`prod_ref`, `cmd_ref`, `quantity`) VALUES (:prod_ref , :cmd_ref , :quantity);');
        $this->db->bind(':prod_ref', $data['prod_ref']);
        $this->db->bind(':cmd_ref', $data['cmd_ref']);
        $this->db->bind(':quantity', $data['quantity']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserOrder($id)
    {
        $this->db->query("SELECT o.* , count(*) as numberitem from orders o join users u on u.id = o.customer_id
                        join orders_line ol on ol.cmd_ref = o.order_refer
                        where u.id = :id 
                        GROUP by o.order_refer;");

        $this->db->bind(':id', $id);
        $results = $this->db->resultset();
        return $results;
    }
    public function getOrderItems($ref)
    {
        $this->db->query("SELECT * from orders o join users u 
        on u.id = o.customer_id join orders_line ol on ol.cmd_ref = o.order_refer 
        join products p on p.prod_refer = ol.prod_ref
        where o.order_refer = :ref ");
        $this->db->bind(':ref', $ref);
        $results = $this->db->resultset();
        return $results;
    }
    public function getAllOrders()
    {
        $this->db->query("SELECT o.*,o.status as order_stat , u.*, count(*) as numberitem from orders o join users u on u.id = o.customer_id
                        join orders_line ol on ol.cmd_ref = o.order_refer
                        GROUP by o.order_refer;");
        $results = $this->db->resultset();
        return $results;
    }
    public function confirmOrder($ref)
    {
        $this->db->query('UPDATE orders SET `status` = 1 WHERE order_refer = :ref ;');
        $this->db->bind(':ref', $ref);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
