<?php
namespace App\Controllers;
use CodeIgniter\I18n\Time;
class Forgotpassword extends BaseController
{
	public function index()
	{
		$this->data['title'] = 'Forgot Password';
		return view('password/forgotpassword',$this->data);
	}
	//request
	public function request()
	{
		// echo '<pre>';
		// print_r($this->db);
		// echo '<pre>';
		// print_r($this->request->getPost());
		// exit;
		$result = $this->validate([
		    'email' => 'required|valid_email',    		
		]);
		if (!$result) {  
			//error                     
      		return redirect()->back()->withInput();
        }else{
        	//echo '<pre>';print_r($this->request->getPost());
        	$response = $this->db->table('users')->where([
        		'email'=>$this->request->getVar('email'),
        		'role_id'=>2
        		])->get(1)->getResultArray();
        	//echo '<pre>';print_r($response);
        	//echo $this->db->getLastQuery();exit;
        	if(sizeof($response) == 1){
        		//one email has found,insert record using transaction
        		$token = md5($this->getToken());
        		$this->db->transBegin();
        		$this->db->table('password_reset')->insert([
        			'email' => $this->request->getVar('email'),
        			'token'	=> $token
        		]);
        		//echo $this->db->getLastQuery();        		
        		//exit;
        		
        		//send a mail
        		$to = $this->request->getVar('email');
				$subject = "Password Reset Email";
				$link = base_url("/resetpassword/$token");
				$message = "
				<html>
					<head>
					<title>Password Reset</title>
					</head>
					<body>
					<p>Please click the below link to reset your password</p>
					<a href=".$link.">
						<button>Click Here </button>
					</a>
					</br>
					</br>
					</br>
					</br>
					".$link."
					</table>
					</body>
				</html>
				";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: <webmaster@example.com>' . "\r\n";
				$headers .= 'Cc: dmparision@gmail.com' . "\r\n";

				$mailResponse = mail($to,$subject,$message,$headers);
				//echo $link;
				//dd($mailResponse);
				if($mailResponse){
					$this->db->transCommit();
					$this->session->setFlashdata('success','Password reset link sent successfuly,Please ckeck your email');        			
				}else{
					$this->db->transRollback();
					$this->session->setFlashdata('error','Sorry failed to send password reset link,Please try again');        			
				} 				      		
        	}else{
        		//no email address has found
        		$this->session->setFlashdata('error','In-valid Email Address,Please Try With Correct One ');
        		//return redirect()->back();
	            //return redirect()->to(base_url('/forgotpassword'));// both are same
        	}
        	return redirect()->back();

        }
	}
	//reset
	public function reset($token="")
	{
		//echo  $token;
		$response = $this->db->table('password_reset')
			->where([
	    		'token'=>$token,
	    		'status'=> 0,
	    		'reset_at' => NULL        		
	        ])->orderBy('id','DESC')
	    ->get(1)
	    ->getResultArray();		
       	if(sizeof($response) == 1){
       		//consider only single record and token send time[30 mins]
       		$sendTime = Time::parse($response[0]['send_at']);
			$currentTime    = Time::parse(new Time('now'));		
			//$diff = $sendTime->difference($currentTime)->getMinutes();
       		if($sendTime->difference($currentTime)->getMinutes() <= 30 ){
       			//token is valid       			
       			$data['title'] = 'Reset Password';
       			return view('password/resetpassword',$data);
       		}else{
       			//token expired
       			$data['title'] = 'Reset Password';
       			$data['message']= 'Token has been expired Request new one .';
       			return view('password/resetpassworderror',$data);
       		}
       	}else{
       		//invalid token
       		$data['title'] = 'Reset Password';
       		$data['message']= 'Invalid token .';
       		return view('password/resetpassworderror',$data);
       	}

	}
	//reset password
	public function resetPassword()
	{
		//dd($this->request->getPost());
		$result = $this->validate([							    
    		'password' => [
    			'label' => 'Password',
    			'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{6,15}$/]|matches[confirm_password]',
    			'errors' => [
                	'regex_match' => '{field} must contains'. "</br>". '&#10004; a digit ,'."</br>".'&#10004; a lower case letter,'."</br>". ' &#10004; an upper case letter, '."</br>". '&#10004; no space, '."</br>". '&#10004; between 6 to 15 characters'
            	]
    		],
    		'confirm_password' => [
    			'label' => 'Confirm Password',
    			'rules' => 'required|min_length[3]|max_length[8]',    			
    		]
		]);
		if (!$result) {  
			//error			                   
      		return redirect()->back()->withInput();
        }else{
        	dd($this->request->getPost());
        }
	}
	//get token 
	protected function getToken($length = 10)
	{
	    $characters = '0123456789@#$%^&*!abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}