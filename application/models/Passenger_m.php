<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    

class Passenger_m extends My_Model{
   
    function __construct() {
        parent::__construct();
		$this->table = 'passenger';
    }

}