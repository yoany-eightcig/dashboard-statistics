<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   	public $locate_username = '';
   	public $locate_password = '';

    public $sessionToken = null;

    public function __construct() {

    	// Login
    	$loginRequest = array(
    	    'email' => LOCATE_USERNAME,
    	    'password' => LOCATE_PASSWORD
    	);

    	$loginResponse = $this->locateRequest('POST', '/login', null, $loginRequest);
    	$this->sessionToken = $loginResponse->session_token;

    	return;
    }

    public function locateRequest($curlRequestType, $endpoint, $sessionToken = null, $postData = null) {

        // Create CURL Request
        $curlRequest = curl_init();

        // Set CURL Options
        curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, $curlRequestType);
        curl_setopt($curlRequest, CURLOPT_URL, LOCATE_BASE_URL . $endpoint);
        curl_setopt($curlRequest, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
        curl_setopt($curlRequest, CURLOPT_RETURNTRANSFER, true);

        // Check for POST Data
        if($postData !== null) {
            curl_setopt($curlRequest, CURLOPT_POSTFIELDS, json_encode($postData));
        }

        // BASIC Auth
        if($sessionToken !== null) {
            curl_setopt($curlRequest, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curlRequest, CURLOPT_USERPWD, $sessionToken);
        }
        // Execute CURL Request
        $response = curl_exec($curlRequest);	
        $httpCode = curl_getinfo($curlRequest, CURLINFO_HTTP_CODE);

        // Check HTTP Status Code
        if($httpCode == 200 || $httpCode == 201) {
        	$json_object = json_decode($response);
        	if ($json_object) {
        		return $json_object;
        	} else {
				return $response;        		
        	}
        }
        else {
            //throw new Exception($httpCode . ' - ' . $response);
            dd($response);
        }
    }
}
