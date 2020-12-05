<?php 
namespace App\Controllers;
use App\Models\UserModel;

class Dashboard extends BaseController
{
	
	public function index()
	{
		// echo'<pre>';
		// print_r($this->session->get());
		// exit;
		if($this->session->has('adminData') == NULL){			
			//if user not logged in then redirect to login
			return redirect()->to(base_url());
			exit;
		}		
		$this->data['title'] ='Admin Dashboard';
		return view('dashboard/dashboard',$this->data);
	}
	//profile
	public function profile()
	{
		if($this->session->has('adminData')== NULL){			
			//if user not logged in then redirect to login
			return redirect()->to(base_url());
			exit;
		}		
		$this->data['title'] ='Admin Dashboard';
		return view('profile',$this->data);
	}
}
