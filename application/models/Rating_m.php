<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rating_m extends My_Model{

    function __construct() {
        parent::__construct();
		$this->table = 'rating';
    }

}