<?php
   function hash_pass($pass)
   {
       return hash('sha256', $pass . SALT);
   }

   function genRef()
   {
      $CI = get_instance();
      //Under the string $Caracteres you write all the characters you want to be used to randomly generate the code.
      $Caracteres = '0123456789';
      $QuantidadeCaracteres = strlen($Caracteres);
      $QuantidadeCaracteres--;   
      $Hash=NULL;
      for($x=1;$x<=10;$x++){
         $Posicao = rand(0,$QuantidadeCaracteres);
         $Hash .= substr($Caracteres,$Posicao,1);
      }
      return $Hash;
   }
   function genRefStr($len)
   {
      $CI = get_instance();
      $CI->load->helper('string');
      return random_string('alnum',$len);
   }
   function loadModel($db)
   {
      $CI = get_instance();
       $CI->load->model($db);
   }
function BtnStatus($value)
{
   if($value == 'active')
      echo '<button class="btn btn-primary btn-xs">'.$value.'</button>';
   else if($value == 'inactive')
       echo '<button class="btn btn-danger btn-xs">'.$value.'</button>';
}
function locationName($id)
{
   $CI = get_instance();
   $CI->load->model('location_m');
   $r = $CI->location_m->get(array('id'=>$id),true);
   if($r)
      return $r->name;
     else
     return '';
}
function dbInfo($model,$key,$value,$param=null)
{
   $CI = get_instance();
   loadModel($model);
   $std = $CI->$model->get(array($key=>$value),true);
   if($std)
   {
      if($param == null)
         return $std;
      else
         return $std->$param;
   }
   else
      return '';
}