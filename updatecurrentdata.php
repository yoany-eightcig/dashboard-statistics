<?php 

function locateRequest($curlRequestType, $endpoint, $sessionToken = null, $postData = null) {
    global $locate_base_url;
    // Create CURL Request
    $curlRequest = curl_init();

    // Set CURL Options
    curl_setopt($curlRequest, CURLOPT_CUSTOMREQUEST, $curlRequestType);
    curl_setopt($curlRequest, CURLOPT_URL, $locate_base_url . $endpoint);
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
        throw new Exception($httpCode . ' - ' . $response);
    }
}

function updateCurrentData($sessionToken) 
{
    set_time_limit(0);
    ini_set('max_execution_time', 0);
    
    $report_name = "Sales Order Dashboard";
    $report_id = 629;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'listofpicks' => 0,
        'daterange' => 'Current Day',  
        'daterange2' => 'Current Day', 
        'format'=>'csv'
    ));

    $result = file_put_contents('storage/app/public/sales_order_today.csv', $response);
    
    $report_name = "Pack Statistics";
    $report_id = 636;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'formatassinglepage' => 0,
        'listofpicks' => 0,
        'picktime' => 1,
        'packcompleted' => 'Current Day',  
        'packcompleted2' => 'Current Day', 
        'format'=>'csv'
    ));

    $result = file_put_contents('storage/app/public/pack_today.csv', $response);
    
    $report_name = "Pick Statistics";
    $report_id = 627;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'formatassinglepage' => 1,
        'listofpicks' => 0,
        'picktime' => 1,
        'pickcompleted' => 'Current Day',  
        'pickcompleted2' => 'Current Day', 
        'format'=>'csv'
    ));

    $result = file_put_contents('storage/app/public/pick_today.csv', $response);

}

$locate_base_url = "https://magma.locateinv.com";
$locate_username = "yoany@eightcig.com";
$locate_password = "CopxerKiller8001";

// Login
$loginRequest = array(
    'email' => $locate_username,
    'password' => $locate_password,
);

$loginResponse = locateRequest('POST', '/login', null, $loginRequest);
$sessionToken = $loginResponse->session_token;

echo "Session Token: ".$sessionToken."\n";
echo "updating: \n";

echo "Done";

?>