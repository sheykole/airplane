<?php 
Class MY_Model extends CI_Model{
	
	public $table;
	public function __construct()
	{
		parent::__construct();
	}
	function insert_csv($data) {
        $this->db->insert($this->table, $data);
        return true;
    }
	function getLastId($s,$i)
	{
		$this->db->select($s);
		$this->db->order_by($i,'DESC');
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		return $query;
	}
	function get_sum($s,$d=null)
	{
		$this->db->select_sum($s);
		if($d!= null)
			$this->db->where($d);
		$result = $this->db->get($this->table);
		if($result->num_rows() > 0 )
		{
			return $result->result();
		}
	}
	function update($data,$whr)
	{
		$this->db->where($whr);
		$this->db->update($this->table,$data);
		return $this->db->affected_rows();
		
	}
	function saveorder($customer,$loc,$menu,$address,$mode,$dtime,$paymentmode)
	{
		$this->db->trans_begin();
		//get the last inserted ID
		$d = array('order_date'=>date('Y-m-d'),'order_time'=>date('H:i:s'),'customer_id'=>$customer,'order_status'=>'processing','location_id'=>$loc,'address'=>$address,'mode'=>$mode,'paymentmode'=>$paymentmode,'preferred_time'=>$dtime);
		$m = dbInfo('mode_m','id',$mode,'name');
		if(strtolower($m) == 'shop' || strtolower($m) == 'call')
		{
			$d['processed_by'] = $this->session->userdata('username');
			$d['order_status'] = 'delivered';
		}
			
		 $this->db->insert($this->table,$d);
		//$id = $this->db->insert_id();
		$this->db->select('id');
		$this->db->order_by('id','DESC');
		$this->db->limit(1);
		$query = ($this->db->get($this->table))->row();
		// echo $query->id;die();
		$result='';
		$pre='';
		//generate order ID
		//var_dump($query);
		$s = ''.($query->id);
		//echo $s;die();
		$len = 6 - strlen($s);
		//echo $len;
		for($i=0; $i<$len;$i++)
		{
			$pre .= 0;
		}
		$result = str_pad($query->id,6, $pre, STR_PAD_LEFT);
		//echo $result;die();
		$this->db->where(array('id'=>$query->id));
		$this->db->update($this->table,array('order_no'=>$result));
		//print_r($menu);
		foreach ($menu as $key) {
			$d2 = array('order_id'=>$result,'menu_id'=>$key['menu'],'no_of_serving'=>$key['serving'],'total_amount'=>(getMenu($key['menu'],'price')*$key['serving']));
			$this->orderdetails_m->save($d2);

		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			
		}
		else
		{
			$this->db->trans_commit();
			return $result;
		}
		
	}
	function save($data,$whr = null)
	{
		//update
		if($whr != null)
		{
			$this->db->where($whr);
			$this->db->update($this->table,$data);
			return true;
		}
		//insert
		else
		{
			$this->db->insert($this->table,$data);
			return true;
		}
	}
	//
	function transPayment($data,$whr,$update)
	{
		$this->db->trans_begin();
		$this->db->insert($this->table,$data);
		$this->db->where($whr);
		$this->db->update('transaction',$update);		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	// to return the insert ID
	function insert($data,$whr = null)
	{
		//update
		if($whr != null)
		{
			$this->db->where($whr);
			$this->db->update($this->table,$data);
			return true;
		}
		//insert
		else
		{
			$this->db->insert($this->table,$data);
			return $this->db->insert_id();
		}
	}
	function get_distinct($s,$d=null)
	{
		$this->db->select($s);
		$this->db->distinct();
		if($d!= null)
			$this->db->where($d);
		$result = $this->db->get($this->table);
		if($result->num_rows() > 0 )
		{
			return $result->result();
		}
	}
	function get($d = NULL,$single=false)
	{
		if($d == NULL)
		{
			$r = $this->db->get($this->table);
			if($r->num_rows() > 0 )
			{
				return $r->result();
			}
		}
		elseif($single == true){
			
			$this->db->where($d);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->row();
			}
		}
		else
		{
			$this->db->where($d);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->result();
			}
		}
	}

	function get_limit($d = NULL,$n)
	{
		if($d == NULL)
		{
			$this->db->limit($n);
			$r = $this->db->get($this->table);
			if($r->num_rows() > 0 )
			{
				return $r->result();
			}
		}		
		else
		{

			$this->db->where($d);
			$this->db->limit($n);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->result();
			}
		}
	}
	function get_Random($d = null,$single=false,$s=NULL,$ss=NULL,$a='ASC',$limit)
	{
		if($d == null)
		{
			$this->db->select($s);
			$this->db->order_by($ss,$a);
			$this->db->limit($limit);
			$r = $this->db->get($this->table);
			if($r->num_rows() > 0 )
			{
				return $r->result();
			}
		}
		elseif($single == true){
			$this->db->select($s);
			$this->db->where($d);
			$this->db->limit($limit);			
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->row();
			}
		}
		else
		{
			$this->db->select($s);
			$this->db->where($d);
			$this->db->limit($limit);			
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->result();
			}
		}
	}
	function get_few($d = null,$single=false,$s=NULL,$ss=NULL,$a='ASC')
	{
		if($d == null)
		{
			$this->db->select($s);
			$this->db->order_by($ss,$a);
			$r = $this->db->get($this->table);
			if($r->num_rows() > 0 )
			{
				return $r->result();
			}
		}
		elseif($single == true){
			$this->db->select($s);
			$this->db->where($d);
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->row();
			}
		}
		else
		{
			$this->db->select($s);
			$this->db->where($d);
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->result();
			}
		}
	}
	function get_few2($d = null,$single=false,$s=NULL,$ss=NULL,$a='ASC')
	{
		if($d == null)
		{
			$this->db->select($s);
			$this->db->order_by($ss,$a);
			$r = $this->db->get($this->table);
			if($r->num_rows() > 0 )
			{
				return $r->result();
			}
		}
		elseif($single == true){
			$this->db->select($s);
			$this->db->where($d);
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->row();
			}
		}
		else
		{
			$this->db->select($s);
			$this->db->where($d);
			$this->db->order_by($ss,$a);
			$result = $this->db->get($this->table);
			if($result->num_rows() > 0 )
			{
				return $result->result();
			}
		}
	}
	function delete($id)
	{
		$this->db->where($id);
		$this->db->delete($this->table);
		return true;
	}
	function delete_trans($id,$tab)
	{
		$this->db->where($id);
		$this->db->delete($tab);
	}
	function join_q($w,$s,$a,$b,$c=false)
	{
		$this->db->select($s);
		$this->db->where($w);
		$this->db->join($a,$b);
		$query = $this->db->get($this->table);
		if($c == false)
		{
			return $query->result();
		}
		else
		{
			return $query->row();
		}
	}
	
	function count_all($a)
	{
		$this->db->where($a);
		//$this->db->like($a);
		$this->db->from($this->table);
		return $this->db->count_all_results();		
	}
	function count_employee($a)
	{
		//$this->db->or_where($a);
		$this->db->or_like('firstname',$a['firstname']);
		$this->db->or_like('lastname',$a['lastname']);
		$this->db->or_like('middlename',$a['middlename']);
		$this->db->where('unit',$a['unit']);
		$this->db->where('employee_id',$a['employee_id']);
		$this->db->where('employee_status',$a['employee_status']);
		$query = $this->db->get($this->table);
		 return $query->result();
		//return $this->db->count_all_results();		
	}
	function record_count($w = NULL) {
		if($w != NULL)
		{
			$this->db->where($w);
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		else
		{
			return $this->db->count_all($this->table);
		}
    }
	public function fetch_employee($limit, $start,$sort=NULL,$by='ASC') {
        $this->db->order_by($sort,$by);
		$this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
   public function fetch($w,$s,$limit, $start,$sort=NULL,$by='ASC') {
	    $this->db->select($s);
		$this->db->where($w);
		$this->db->order_by($sort,$by);
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	public function show_data_by_date($date,$c,$data) 
	{
		$condition = $date." BETWEEN " . "'" . $data['from'] . "'" . " AND " . "'" . $data['to'] . "'";
		$this->db->select('*');
		$this->db->where($c);
		$this->db->where($condition);
		$this->db->order_by($date,'DESC');
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) 
		{
			return $query->result();
		} 
		else 
		{
			return false;
		}
	}
	private function _get_datatables_query($search)
    {
         
        $this->db->from($this->tab);
 
        $i = 0;
     
        foreach ($search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($search,$whr=null)
    {
        $this->_get_datatables_query($search);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
    	if($whr != null)		
			$this->db->where($whr);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($search,$whr=null)
    {
        $this->_get_datatables_query($search);
        if($whr != null)
        	$this->db->where($whr);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_al()
    {
        $this->db->from($this->tab);
        return $this->db->count_all_results();
    }
	
	

	
}