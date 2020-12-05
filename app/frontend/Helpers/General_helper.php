<?php
    /*
    *-----------------------------------------------------
    * isLoggedIn() checks has userData
    *-----------------------------------------------------
    */
	if(!function_exists('isLoggedIn')) {
	    function isLoggedIn(){	 	       		
    	   	if(session()->has('userData')){
    	   		
    	   		return true;
    	   	}else{
    	   		return false;
    	   	}
	    }
	}	
?>