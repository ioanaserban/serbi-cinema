<?php
include 'DbConnect.php';

class DbManipulator extends DbConnect
{
    public function getCategories()
    {
        return $this->_db->query('SELECT * FROM categorii')->fetchAll(PDO::FETCH_ASSOC);
    }

}

$dbManipulator = new DbManipulator();
