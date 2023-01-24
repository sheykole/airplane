<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Employee_m extends My_Model{

    function __construct() {
        parent::__construct();
		$this->table = 'employee';
    }

}