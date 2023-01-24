<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('func_helper');
		$this->is_logged_in();
		$this->priviledge();
		loadModel('admin_m');	
		$this->load->helper('form');
	}
	
	function is_logged_in()
	{
		$is_loged_in = $this->session->userdata('is_logged_in');
		if (!isset($is_loged_in) || $is_loged_in < 0)
		{
			redirect('login','refresh');
		}
	}	
	function priviledge()
	{		
		$usertype = $this->session->userdata('user_type');
		
		if (strtolower($usertype) !='admin' )
		{
			redirect('login','refresh');
		}
	}
	function index()
	{		
		//echo 'here';
		loadModel('passenger_m');
		loadModel('airplane_m');
		loadModel('employee_m');
		loadModel('flight_m');
		loadModel('admin_m');
		$data['passenger'] = $this->passenger_m->record_count();	
		$data['airplane'] = $this->airplane_m->record_count();	
		$data['employee'] = $this->employee_m->record_count();	
		$data['flight'] = $this->flight_m->record_count();	
		$data['admin'] = $this->admin_m->record_count();	
		$data['title'] = 'Dashboard';
		$data['subview']='admin/dashboard';
		$this->load->view('admin/layout',$data);
	}
	function administrators()
	{
		$data['title'] = 'Administrators';		
		$data['admin'] = $this->admin_m->get();	
		$data['subview']='admin/admin';
		$this->load->view('admin/layout',$data);
	}
	function user_edit($id)
	{
		loadModel('admin_m');
		if(intval($id))
		{
			$whr = array('id'=>$id);
			$data = $this->admin_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function user_update()
	{
		//print_r($_POST);die();
		$this->load->model('admin_m');
		$this->_validateUser();
		$data = array(
				'name' => $this->input->post('name_user'),
				'username' => $this->input->post('username_user'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('pno'),
				'status' =>$this->input->post('status')

			);
		if($this->input->post('id') != '')
			$this->admin_m->save($this->security->xss_clean($data),array('id' => $this->security->xss_clean($this->input->post('id')) ));
		else
			$this->admin_m->save($data);
		echo json_encode(array("status" => TRUE));
	}
	
	function user_password()
	{
		//print_r($_POST);die();
		$this->load->model('admin_m');
		$this->_validatePassword();
		$data = array(
				'password' => hash_pass($this->input->post('pass'))
			);
		if($this->input->post('idPass') != '')
			$this->admin_m->save($data,array('id' => $this->input->post('idPass')) );
		
		echo json_encode(array("status" => TRUE));
	}
	private function _validatePassword()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('pass') == '')
		{
			$data['inputerror'][] = 'pass';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('conpass') == '')
		{
			$data['inputerror'][] = 'conpass';
			$data['error_string'][] = 'Confirm Password is required';
			$data['status'] = FALSE;
		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	private function _validateUser()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('name_user') == '')
		{
			$data['inputerror'][] = 'name_user';
			$data['error_string'][] = 'Name is required';
			$data['status'] = FALSE;
		}
	
		if($this->input->post('username_user') == '')
		{
			$data['inputerror'][] = 'username_user';
			$data['error_string'][] = 'Username is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('email') == '')
		{
			$data['inputerror'][] = 'email';
			$data['error_string'][] = 'Email is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('pno') == '')
		{
			$data['inputerror'][] = 'pno';
			$data['error_string'][] = 'Phone Number is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	/////////////////////////////Airplane Type//////////////////
	function airplaneType()
	{
		loadModel('type_m');
		$data['title'] = 'Airplane Type';		
		$data['types'] = $this->type_m->get();	
		$data['subview']='admin/type';
		$this->load->view('admin/layout',$data);
	}
	function type_edit($id)
	{
		loadModel('type_m');
		if(intval($id))
		{
			$whr = array('typeid'=>$id);
			$data = $this->type_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function type_update()
	{
		//print_r($_POST);die();
		$this->load->model('type_m');
		$this->_validateLocation();
		$data = array(
				'name' => $this->security->xss_clean($this->input->post('name'))
			);
		if($this->input->post('id') != '')
			$this->type_m->save($data,array('typeid' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->type_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	private function _validateLocation()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Name is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	function airplanes()
	{
		loadModel('type_m');
		loadModel('airplane_m');
		$data['title'] = 'Airplanes';		
		$data['types'] = $this->type_m->get();	
		$data['airplanes'] = $this->airplane_m->get();	
		$data['subview']='admin/airplanes';
		$this->load->view('admin/layout',$data);
	}
	function airplane_edit($id)
	{
		loadModel('airplane_m');
		if(intval($id))
		{
			$whr = array('numser'=>$id);
			$data = $this->airplane_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function airplane_update()
	{
		//print_r($_POST);die();
		$this->load->model('airplane_m');
		$data = array(
				'manufacturer' => $this->security->xss_clean($this->input->post('manufacturer')),
				'model' => $this->security->xss_clean($this->input->post('model')),
				'aircraft_type' => $this->security->xss_clean($this->input->post('type')),
			);
		if($this->input->post('id') != '')
			$this->airplane_m->save($data,array('numser' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->airplane_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	function airplane_pilot($type =null)
	{
		loadModel('rating_m');
		loadModel('employee_m');
		$rate = $this->rating_m->get(array('aircraft_type'=>$type),false);
		$emp = array();
		if($rate)
		{
			
			foreach ($rate as $key ) {			
				
				$t = $this->employee_m->get(array('ratingid'=>$key->ratno),false);
				if($t)
				{
					foreach ($t as $value) {
						$emp[] = $value->empnum;
					}
				}

				
			}			
			
		}
		$data['title'] = 'Eligible';	
		$data['result'] = $emp;
		$data['subview']='admin/airplane_pilot';
		$this->load->view('admin/layout',$data);

	}
	function passenger_booking($type =null)
	{
		loadModel('book_m');	
		$data['title'] = 'List of Bookings';	
		$data['result'] = $this->book_m->get(array('passID'=>$type),false);	
		$data['subview']='admin/passenger_booking';
		$this->load->view('admin/layout',$data);

	}
	function pilot_working_hourse()
	{
		loadModel('employee_m');	
		$data['title'] = 'List of Pilot Working Hours';	
		$data['result'] = $this->employee_m->get(array('type'=>'Pilot'),false);	
		$data['subview']='admin/pilot_working_hourse';
		$this->load->view('admin/layout',$data);

	}
	function ratings()
	{
		loadModel('type_m');
		loadModel('rating_m');
		$data['title'] = 'Rating';		
		$data['types'] = $this->type_m->get();	
		$data['result'] = $this->rating_m->get();	
		$data['subview']='admin/rating';
		$this->load->view('admin/layout',$data);
	}
	function rating_edit($id)
	{
		loadModel('rating_m');
		if(intval($id))
		{
			$whr = array('ratno'=>$id);
			$data = $this->rating_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function rating_update()
	{
		//print_r($_POST);die();
		$this->load->model('rating_m');
		$data = array(
				'name' => $this->security->xss_clean($this->input->post('name')),
				'aircraft_type' => $this->security->xss_clean($this->input->post('type')),
			);
		if($this->input->post('id') != '')
			$this->rating_m->save($data,array('ratno' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->rating_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	function employees()
	{
		loadModel('employee_m');
		loadModel('rating_m');
		$data['title'] = 'Employees';		
		$data['result'] = $this->employee_m->get();	
		$data['rating'] = $this->rating_m->get();	
		$data['subview']='admin/employees';
		$this->load->view('admin/layout',$data);
	}
	function employee_edit($id)
	{
		loadModel('employee_m');
		if(intval($id))
		{
			$whr = array('empnum'=>$id);
			$data = $this->employee_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function employee_update()
	{
		//print_r($_POST);die();
		$this->load->model('employee_m');
		if($this->security->xss_clean($this->input->post('ratingid')))
			$rat = $this->security->xss_clean($this->input->post('ratingid'));
		else
			$rat = null;
		$data = array(
				'surname' => $this->security->xss_clean($this->input->post('surname')),
				'name' => $this->security->xss_clean($this->input->post('name')),
				'address' => $this->security->xss_clean($this->input->post('address')),
				'phone' => $this->security->xss_clean($this->input->post('phone')),
				'salary' => $this->security->xss_clean($this->input->post('salary')),
				'ratingid' => $rat,
				'type' => $this->security->xss_clean($this->input->post('type')),
				'age' => $this->security->xss_clean($this->input->post('age')),
				'surname' => $this->security->xss_clean($this->input->post('surname')),
				'working_hour' => $this->security->xss_clean($this->input->post('working_hour')),
			);
		if($this->input->post('id') != '')
			$this->employee_m->save($data,array('empnum' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->employee_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	
	function schedules()
	{
		loadModel('schedule_m');
		loadModel('flight_m');
		loadModel('airplane_m');
		$data['title'] = 'Schedules';		
		$data['result'] = $this->schedule_m->get();	
		$data['flight'] = $this->flight_m->get();	
		$data['airplane'] = $this->airplane_m->get();	
		$data['subview']='admin/schedules';
		$this->load->view('admin/layout',$data);
	}
	function schedule_edit($id)
	{
		loadModel('schedule_m');
		if(($id))
		{
			$whr = array('schedulenum'=>$id);
			$data = $this->schedule_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function schedule_update()
	{
		//print_r($_POST);die();
		$this->load->model('schedule_m');
		$data = array(
				'flightnum' => $this->security->xss_clean($this->input->post('flightnum')),
				'arr_time' => $this->security->xss_clean($this->input->post('arr_time')),
				'dep_time' => $this->security->xss_clean($this->input->post('dep_time')),
				'arr' => $this->security->xss_clean($this->input->post('arr')),
				'des' => $this->security->xss_clean($this->input->post('des')),
				'airplaneid' => $this->security->xss_clean($this->input->post('airplaneid')),
				'capacity' => $this->security->xss_clean($this->input->post('capacity'))
			);
		if($this->input->post('id') != '')
			$this->schedule_m->save($data,array('schedulenum' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->schedule_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	
	function flights()
	{
		loadModel('flight_m');
		loadModel('book_m');
		$data['title'] = 'Flights';		
		$data['flight'] = $this->flight_m->get();	
		$data['subview']='admin/flight';
		$this->load->view('admin/layout',$data);
	}
	function flight_edit($id)
	{
		loadModel('flight_m');
		if(($id))
		{
			$whr = array('flightnum'=>$id);
			$data = $this->flight_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function flight_update()
	{
		//print_r($_POST);die();
		$this->load->model('flight_m');
		$data = array(
				// 'flightnum' => $this->security->xss_clean($this->input->post('flightnum')),
				'flightdate' => date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('flightdate')))),
				'origin' => $this->security->xss_clean($this->input->post('origin')),
				'amount' => $this->security->xss_clean($this->input->post('amount')),
				'status' => $this->security->xss_clean($this->input->post('status')),
				'destination' => $this->security->xss_clean($this->input->post('destination'))
			);
		if($this->input->post('id') != '')
			$this->flight_m->save($data,array('flightnum' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->flight_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	function crews()
	{
		loadModel('crew_m');
		loadModel('employee_m');
		loadModel('schedule_m');
		$data['title'] = 'Flight Crew';		
		$data['crew'] = $this->crew_m->get();	
		$data['schedule'] = $this->schedule_m->get();	
		$data['employee'] = $this->employee_m->get();	
		$data['subview']='admin/crew';
		$this->load->view('admin/layout',$data);
	}
	function crew_edit($id)
	{
		loadModel('crew_m');
		if(($id))
		{
			$whr = array('crewid'=>$id);
			$data = $this->crew_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function crew_update()
	{
		//print_r($_POST);die();
		$this->load->model('crew_m');
		$data = array(
				// 'flightnum' => $this->security->xss_clean($this->input->post('flightnum')),
				'empnum' => $this->security->xss_clean($this->input->post('empnum')),
				'scheduleid' => $this->security->xss_clean($this->input->post('scheduleid')),
				'role' => $this->security->xss_clean($this->input->post('role')),
			);
		if($this->input->post('id') != '')
			$this->crew_m->save($data,array('crewid' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->crew_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	function passengers()
	{
		loadModel('passenger_m');
		$data['title'] = 'Passengers';		
		$data['result'] = $this->passenger_m->get();	
		$data['subview']='admin/passenger';
		$this->load->view('admin/layout',$data);
	}
	function passenger_edit($id)
	{
		loadModel('passenger_m');
		if(intval($id))
		{
			$whr = array('pasID'=>$id);
			$data = $this->passenger_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function passenger_update()
	{
		//print_r($_POST);die();
		$this->load->model('passenger_m');
		if($this->security->xss_clean($this->input->post('ratingid')))
			$rat = $this->security->xss_clean($this->input->post('ratingid'));
		else
			$rat = null;
		$data = array(
				'surname' => $this->security->xss_clean($this->input->post('surname')),
				'othername' => $this->security->xss_clean($this->input->post('othername')),
				'address' => $this->security->xss_clean($this->input->post('address')),
				'phone' => $this->security->xss_clean($this->input->post('phone')),
				'email' => $this->security->xss_clean($this->input->post('email')),
				'gender' => $this->security->xss_clean($this->input->post('gender')),
				'dob' => date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('dob'))))
			);
		if($this->input->post('id') != '')
			$this->passenger_m->save($data,array('pasID' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->passenger_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	function booking()
	{
		loadModel('passenger_m');
		loadModel('flight_m');
		loadModel('book_m');
		$data['title'] = 'Bookings';		
		$data['result'] = $this->book_m->get();	
		$data['passenger'] = $this->passenger_m->get();	
		$data['flight'] = $this->flight_m->get();	
		$data['subview']='admin/bookings';
		$this->load->view('admin/layout',$data);
	}
	function booking_edit($id)
	{
		loadModel('book_m');
		if(intval($id))
		{
			$whr = array('bookid'=>$id);
			$data = $this->book_m->get($whr,true);
			echo json_encode($data);
		}
		else
		{
			return false;
		}
	}
	
	function booking_update()
	{
		//print_r($_POST);die();
		$this->load->model('book_m');
		$data = array(
				'bookid' => genRef(),
				'flightnum' => $this->security->xss_clean($this->input->post('flightnum')),
				'passID' => $this->security->xss_clean($this->input->post('passID')),
				'book_date' => date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('book_date'))))
			);
		if($this->input->post('id') != '')
			$this->book_m->save($data,array('bookid' => $this->security->xss_clean($this->input->post('id')) ));
		else		
			$this->book_m->save($data);
		
		echo json_encode(array("status" => TRUE));
	}
	












	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
