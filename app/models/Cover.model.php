<?php
class Cover
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCovers()
    {
        $this->db->query("SELECT * from prodcover ");

        $results = $this->db->resultset();

        return $results;
    }
    public function addCover($data)
    {
        $this->db->query('INSERT INTO `prodcover` (`cover_href`, `cover_img`, `cover_title`, `cover_sub_title`, `status`)' .
            'VALUES (:cover_href,:cover_img,:cover_title,:cover_sub_title,:status);');
        $this->db->bind(':cover_href', $data['cover_href']);
        $this->db->bind(':cover_img', $data['cover_img']);
        $this->db->bind(':cover_title', $data['cover_title']);
        $this->db->bind(':cover_sub_title', $data['cover_sub_title']);
        $this->db->bind(':status', $data['status']);
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    public function deleteCover($id)
    {
        $this->db->query('DELETE FROM prodcover WHERE cover_id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function changeState($id, $stat)
    {
        $this->db->query('UPDATE prodcover SET status = :status  WHERE cover_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $stat);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCoverById($id)
    {
        $this->db->query("SELECT * FROM prodcover WHERE cover_id = :id");

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }
    public function editCover($data, $defaultImg)
    {
        if (!$defaultImg) {
            $this->db->query('UPDATE prodcover SET cover_title = :cover_title , cover_sub_title = :cover_sub_title,' .
                'cover_href = :cover_href ,cover_img = :cover_img , status = :status  WHERE cover_id = :id');
            $this->db->bind(':cover_img', $data['cover_img']);
        } else
            $this->db->query('UPDATE prodcover SET cover_title = :cover_title , cover_sub_title = :cover_sub_title,' .
                'cover_href = :cover_href , status = :status  WHERE cover_id = :id');

        $this->db->bind(':id', $data['cover_id']);
        $this->db->bind(':cover_href', $data['cover_href']);
        $this->db->bind(':cover_title', $data['cover_title']);
        $this->db->bind(':cover_sub_title', $data['cover_sub_title']);
        $this->db->bind(':status', $data['status']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
