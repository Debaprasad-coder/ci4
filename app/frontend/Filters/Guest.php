<?php
/**
 *	Guest filters used to check whether the user is logged in or not
 *	here @before & @after method calling from route & execute simultaneously
 *	@before checks loggedin
 *	@after checks ____
 */
namespace App\Filters;
use CodeIgniter\Filters\FilterInterFace;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class Guest implements FilterInterFace
{
	public function before(RequestInterface $request,$arguments = null)
	{
		$session = Services::session();
	   	//echo '<pre>';print_r($session->get('userData')['logged_in']);exit;
	   	if( $session->has('userData') && ($session->get('userData')['logged_in'] != NULL) ){

			return redirect()->to(base_url('/dashboard'));
		}		
	    
	}

	public function after(RequestInterface $request,ResponseInterface $response,$arguments = null)
	{
		
	}
}