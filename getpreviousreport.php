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
        // throw new Exception($httpCode . ' - ' . $response);
        echo ($httpCode . ' - ' . $response);
        return false;
    }
}

function getYesterdayReport($sessionToken) 
{
    set_time_limit(0);
    ini_set('max_execution_time', 0);
    /*

    $report_name = "Sales Order Dashboard";
    echo $report_name. "\n";
    $report_id = 629;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        "api_key" => "1a2ff66d04d8179333029bdcc28a21d2",
        'listofpicks' => 0,
        'daterange' => 'Current Day',  
        'daterange2' => 'Current Day', 
        'format'=>'csv'
    ));

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/sales_order_today.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";
    }

    
    $report_name = "Pick Statistics";
    echo $report_name. "\n";
    $report_id = 627;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        "api_key" => "1a2ff66d04d8179333029bdcc28a21d2",
        'formatassinglepage' => 1,
        'listofpicks' => 0,
        'picktime' => 1,
        'pickcompleted' => 'Current Day',  
        'pickcompleted2' => 'Current Day', 
        'format'=>'csv'
    ));

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/pick_today.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";
    }

    $report_name = "Pack Statistics";
    echo $report_name. "\n";
    $report_id = 636;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        "api_key" => "1a2ff66d04d8179333029bdcc28a21d2",
        'formatassinglepage' => 1,
        'listofpicks' => 0,
        'picktime' => 1,
        'packcompleted' => 'Current Day',  
        'packcompleted2' => 'Current Day', 
        'format'=>'csv'
    ));

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/pack_today.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";
    }
    */

    ////////////////////////////////////////////////////////////////////////////////////
    $report_name = "Sales Order Dashboard";
    echo $report_name. "\n";
    $report_id = 629;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'listofpicks' => 0,
        'daterange' => 'Previous Day',  
        'daterange2' => 'Previous Day', 
        'format'=>'csv')
    );

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/sales_order_previous.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";
    }

    $report_name = "Pick Statistics";
    echo $report_name. "\n";
    $report_id = 627;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'formatassinglepage' => 1,
        'listofpicks' => 0,
        'picktime' => 1,
        'pickcompleted' => 'Previous Day',  
        'pickcompleted2' => 'Previous Day', 
        'format'=>'csv')
    );

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/pick_previous.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";
    }


    $report_name = "Pack Statistics";
    echo $report_name. "\n";
    $report_id = 636;

    $response = locateRequest('GET', "/report/".$report_id."/run", $sessionToken, array(
        'formatassinglepage' => 1,
        'listofpicks' => 0,
        'picktime' => 1,
        'packcompleted' => 'Previous Day',  
        'packcompleted2' => 'Previous Day', 
        'format'=>'csv')
    );

    if ($response) {
        $result = file_put_contents(dirname(__FILE__).'/storage/pack_previous.csv', $response);
        echo var_dump($result);
        echo "Downloaded \n";        
    }
}

$locate_base_url = "https://magma.locateinv.com";
$locate_username = "dashboard@eightcig.com";
$locate_password = "Vape1234";

// Login
$loginRequest = array(
    'email' => $locate_username,
    'password' => $locate_password,
);

$loginResponse = locateRequest('POST', '/login', null, $loginRequest);
$sessionToken = $loginResponse->session_token;

echo "Session Token: ".$sessionToken."\n";
echo "Getting Yesterday Reports: \n";
getYesterdayReport($sessionToken);
echo "Done  \n";

?>