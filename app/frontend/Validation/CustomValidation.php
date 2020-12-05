<?php
namespace App\Validation;

use CodeIgniter\HTTP\RequestInterFace;
use Config\Services;
use App\Models\User;

class CustomValidation{
	private $request;

	public function __construct(RequestInterFace  $request = null){
		if(is_null($request)){
			$request = Services::request();
		}
		$this->request = $request;
	}
	//verify old password
	public function varifyOldPass($password)
	{
		$userObj = new User();
		$user = $userObj->find(session()->get('userData')['id']);		
		if(password_verify($password, $user['password'])){
			return true;
		}else{
			return false;
		}

	}
}

