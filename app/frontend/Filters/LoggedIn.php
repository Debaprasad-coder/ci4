<?php
/**
 *	LoggedIn filters used to check whether the user is logged in or not
 *	here @before & @after method calling from route & execute simultaneously
 *	@before checks loggedin
 *	@after checks role
 */
namespace App\Filters;
use CodeIgniter\Filters\FilterInterFace;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class LoggedIn implements FilterInterFace
{
	public function before(RequestInterface $request,$arguments = null)
	{
		$session = Services::session();
	   	//echo '<pre>';print_r($session->get('userData')['logged_in']);exit;
	   	if( $session->has('userData') && ($session->get('userData')['logged_in'] != NULL) ){

			return true;
		}
		$session->setFlashdata('error','Please Login!');
		return redirect()->to(base_url());
	    
	}

	public function after(RequestInterface $request,ResponseInterface $response,$arguments = null)
	{
		// $session = Services::session();
		// //echo '<pre>';print_r($session->get('userData'));exit;
		// if( $session->has('userData') && $session->get('userData')['role_id'] == 2 ){

		// 	return true;
		// }
		// $session->setFlashdata('error','Unauthorizes Acces!');
		// return redirect()->to(base_url());
	}
}