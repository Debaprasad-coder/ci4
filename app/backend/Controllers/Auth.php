<?php 
namespace App\Controllers;
use App\Models\UserModel as User;

class Auth extends BaseController
{
	function __construct()
	{
		//perform defined operation before calling below function
		$this->user = new User(); //create user instance
		
	}
	public function index()
	{
		// echo'<pre>';
		// print_r($this->session->get());
		// exit;
		if($this->session->has('adminData') && ($this->session->get('adminData')['logged_in']!= Null) && ($this->session->get('adminData')['role_id'] == 1) ){
			return redirect()->to('http://localhost/ci4/resource/dashboard');
		}
		$this->data['header'] = view('common/header');
		$this->data['footer'] = view('common/footer');
		$this->data['title'] = 'Admin Login';
		return view('auth/login',$this->data);
	}

	//post login
	public function login()
	{		
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
            // var_dump($response);
            // exit;
            if($response){
            	$verify = password_verify($this->request->getVar('password'), $response['password']);
	            if($verify && $response['role_id'] == 1){
	            	$userData = [
	            		'username' => $response['username'],
	            		'email' => $response['email'],
	            		'role_id' => $response['role_id'],
	            		'logged_in' => TRUE
	            	];
	            	$this->session->set('adminData',$userData);
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
	//logout
	public function logout()
	{
		$this->session->remove('adminData');
		return redirect()->to(base_url());
	}

}
