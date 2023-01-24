<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH.'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Pdf extends Dompdf
{
 public function __construct()
 {
   parent::__construct();
   $pdf = new DOMPDF(array('enable_remote' => true)); 
   $CI = & get_instance();
	$CI->dompdf = $pdf; 

 } 
}

?>