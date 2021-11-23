<?php

class DbConnect
{
    protected $_db;

    public function __construct() {
        $this->_db = new PDO('mysql:host=localhost;dbname=aplicatie_cinema', 'root', 'password');
        $this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}