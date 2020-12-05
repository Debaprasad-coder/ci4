<?php 
namespace App\Controllers;


use App\Models\User;
use Config\Services;
class Auth extends BaseController
{
	function __construct()
	{
		
		$this->user = new User(); //create user instance
		
		
	}

	//get login
	public function index()
	{		
		
		$data = ['title' => 'User Login'];
		return view('auth/login',$data);
	}

	//post login
	public function login()
	{		
		
		//throtller
		$throttler = Services::throttler();		
        // Restrict an IP address to no more
        // than 1 request per second across the
        // entire site.       
        if ($throttler->check($this->request->getIPAddress(), 3, MINUTE) === false)
        {
            //echo 'halt';exit;
            //return Services::response()->setStatusCode(429);
            $this->session->setFlashdata('error','EXCEEDLOGINATTEMPT');
	        return redirect()->to(base_url());
        }
		$result = $this->validate([
		    'email' => 'required|valid_email',
    		'password' => 'required|min_length[3]|max_length[8]'
		]);
		if (!$result) {  
			//error                     
      		return redirect()->back()->withInput();
        } else {
        	//input is ok check from db            
            $response = $this->user->where(['email'=>$this->request->getVar('email')])->first();
            // echo '<pre>';
            // print_r($response);
            // echo password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
            // var_dump(password_verify($this->request->getVar('password'), $response['password']));
            // exit;
            if($response){
            	$verify = password_verify($this->request->getVar('password'), $response['password']);
	            if($verify && $response['role_id'] == 2){
	            	$userData = [
	            		'username' => $response['username'],
	            		'email' => $response['email'],
	            		'role_id' => $response['role_id'],
	            		'logged_in' => TRUE,
	            		'id' => $response['id']
	            	];
	            	$this->session->set('userData',$userData);
	            	return redirect()->to(base_url('/dashboard'));
	            }else{
	            	$this->session->setFlashdata('error','In-valid Creddentials,Please Try With Correct One ');
	            	return redirect()->to(base_url());
	            }            	
            }else{
            	$this->session->setFlashdata('error','In-valid Creddentials,Please Try With Correct One ');
            	
	            return redirect()->to(base_url());
            }
        }
	}

	//get register 
	public function showRegister()
	{
		/*
		$this->data['header'] =  view('common/header');
		$this->data['footer'] =  view('common/footer');
		return view('auth/_register',$this->data);
		*/
		$data = ['title' => 'User Registration'];
		return view('auth/register',$data); //use master layout concept
	}
	
	//post register
	public function postRegister()
	{
		//print_r($_POST);die();		
		$result = $this->validate(
			[
		    	'name' => 'required|alpha_space',
		    	'email' => 'required|valid_email|is_unique[users.email]',
    			'password' => 'required|min_length[3]|max_length[8]|matches[confirmPassword]',
    			'confirmPassword' => 'required|min_length[3]|max_length[8]',
			]);
		if (!$result) {  
			//error			                   
      		return redirect()->back()->withInput();
        } else {
        	//input is ok inser to db  
        	$this->db->transBegin();                     
            $response_1 = $this->user->insert([
                'username' => $this->request->getVar('name'),
                'email'  => $this->request->getVar('email'),
                'password'  => $this->request->getVar('password'),
            ]);
            $InsertId = $this->user->InsertId();
            // var_dump($this->user->InsertId());
            // var_dump($response);exit;
            $response_2 = $this->db->table('profile')->insert([
            	'profile_id' => $InsertId,
            	
            ]);
            if($response_1 && $response_2){
            	$this->db->transCommit();
            	$this->session->setFlashdata('success','Registration Succesfully Done,Please Login your Creddentials');
            	return redirect()->to(base_url());
            }else{
            	$this->db->transRollback();
            	$this->session->setFlashdata('error','Registration not Done,Please Try Again');
            	return redirect()->back();
            }
          
        }
	}

	//log out
	public function logout()
	{
		$this->session->remove('userData');
		$this->session->setFlashdata('success','Logged Out Succesfully');
		return redirect()->to(base_url());
	}
	
}
