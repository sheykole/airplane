<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Book_m extends My_Model{

    function __construct() {
        parent::__construct();
		$this->table = 'booking';
    }

}