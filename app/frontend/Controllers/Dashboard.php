<?php 
namespace App\Controllers;
use App\Models\User;

class Dashboard extends BaseController
{
	private $user;

	public function __construct()
	{
		//do stuff accessing all the function
		
		$this->user = new User();
		
	}
	public function index()
	{			
		//var_dump(isLoggedIn());	exit;
		$this->data['title'] = 'Dashboard';
		return view('user/dashboard',$this->data);
	}
	//user profile
	public function userProfile()
	{
		$this->data['profile'] = $this->db->table('profile')
		->select('profile_id,profile_img,profile_contact,created_at,updated_at')
		->where(
			[
			'profile_id'=>session()->get('userData')['id']
			]
		)->get(1)
		->getRowArray();		
		$this->data['title'] = 'Profile';
		return view('user/profile',$this->data);
	}
	//changeProfile
	public function changeProfile()
	{
		$result = $this->validate(
			[	    	
		    	'contact_number' => [
	    			'label' => 'Contact Number',
	    			'rules' => 'required|integer|min_length[10]|max_length[12]',    			
	    		],
	    		'profile_image' => [
	    			'label' => 'Profile Image',
	    			'rules' => 'uploaded[profile_image]|ext_in[profile_image,png,jpg,gif]', 
	    			'errors' => [
	    				'uploaded' => '{field} is required',
	    				'mime_in' => 'Not an image, Do upload a valid image file'."</br>". '&#10004;jpg'."</br>".'&#10004;png'
	    			]   			
	    		]
			]
		);
		if (!$result) {  
			//error			                   
      		return redirect()->back()->withInput();
        }else{
        	// echo '<pre>';
        	// print_r($this->request->getPost());
        	// exit;
        	//update profile
	        $file =  $this->request->getFile('profile_image');			
			$image = session()->get('userData')['id'].'.'.$file->getClientExtension();
			//start transaction
			$this->db->transBegin();
			$this->db->table('profile')->update(
				[
					'profile_contact' =>$this->request->getPost('contact_number'),
					'profile_img' => $image
				],
				[
					'profile_id' => session()->get('userData')['id']
				]
			);
			//remove old file
			if(file_exists(WRITEPATH.'../template/assets/frontend/profile/'.$image)){
				unlink(WRITEPATH.'../template/assets/frontend/profile/'.$image);
			}
			//uplod file
			if($file->move(WRITEPATH.'../template/assets/frontend/profile', $image)){
				//file upload successfull
				$this->db->transCommit();
					$this->session->setFlashdata('success','&#128540; Profile Updated Successfully ');
			}else{
				//file not uploaded
				$this->db->transRollback();
				$this->session->setFlashdata('error','&#128540; Failed to Update Profile ,Try Again Later ');
			}
			return redirect()->back();		

        }
	}
	//changePassword
	public function changePassword()
	{
		// echo "<pre>";
		// print_r($this->request->getPost());
		// die();
		$result = $this->validate(
		[	    	
	    	'password' => [
    			'label' => 'Password',
    			'rules' => 'required|varifyOldPass',  
    			'errors' =>[
    				'varifyOldPass' => 'Old password doesn\'t matched',
    			]  			
    		],
    		'new_password' => [
    			'label' => 'New Password',
    			//'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{6,15}$/]|matches[Confirm_new_password]', 
    			'rules' => 'required|matches[Confirm_new_password]', 
    			'errors' => [
                	'regex_match' => '{field} must contains'. "</br>". '&#10004; a digit ,'."</br>".'&#10004; a lower case letter,'."</br>". ' &#10004; an upper case letter, '."</br>". '&#10004; no space, '."</br>". '&#10004; between 6 to 15 characters'
            	]   			
    		],
    		'Confirm_new_password' => [
    			'label' => 'Confirm Password',
    			'rules' => 'required',    			
    		],
    		
		]);
		if (!$result) {  
			//error			                   
      		return redirect()->back()->withInput();
        }else{   			
			//update user password
			$id = session()->get('userData')['id'];
			if(!$this->user->update($id,['password'=>$this->request->getPost('new_password')])){
				$this->session->setFlashdata('error','&#128540; Failed To Update Password Try Again.');	
			}else{
				$this->session->setFlashdata('success','&#128540; Password Updated Successfully');
			}			
			return redirect()->back();	
        }
	}
	

}
