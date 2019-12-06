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
    }
}

function saveReport($id, $filename, $sessionToken, $response) 
{
    $result = file_put_contents(dirname(__FILE__).'/storage/'.$filename, $response);

    $response = locateRequest('POST', "/notification/delete", $sessionToken, array(
        "notification_ids" => [$id],
    ));
    echo var_dump($response). "\n";
}

function getReportDate ($basePath, $line, $col)
{
    $csv = array_map('str_getcsv', file($basePath));
    $date = $csv[$line][$col];
    return $date;
}

function getNotifications($sessionToken)
{
	$result = true;
	$response = locateRequest('GET', "/notification", $sessionToken, array());

	echo "Count: ".count($response->data)."\n";

	foreach ($response->data as $notification) {

		echo "Notification ID: {$notification->id}\n";
		preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $notification->message, $url);
		echo ("Link: ".$url['href'][0])."\n";
		$url = $url['href'][0];

		$parts = parse_url($url, PHP_URL_PATH);
		$filename = basename($parts);
		echo "File: $filename \n";

        //save notification file.
        $response = file_get_contents($url);
        $basePath = dirname(__FILE__).'/storage/base.csv';
        $result = file_put_contents($basePath, $response);

        $response = file_get_contents($basePath);

		if (strpos($filename, "PackStatistics") !== false) {
            $date = "today";

            $reportDate = getReportDate($basePath, 6, 3);
            $currentDate = "Date Range: ".date('m/j/Y')." - ".date('m/j/Y');
            $date = ($reportDate == $currentDate) ? "today" : "previous";
            $date = "today";

			$filename = "pack_".$date.".csv";
            saveReport($notification->id, $filename, $sessionToken, $response);
		} 
        else if (strpos($filename, "OrderDashboard") !== false) 
        {
	        $date = "today";

            $reportDate = getReportDate($basePath, 6, 6);
            $currentDate = "Issued Date Range: ".date('m/j/Y')." - ".date('m/j/Y');
            $date = ($reportDate == $currentDate) ? "today" : "previous";
            $date = "today";
            
    		$filename = "sales_order_".$date.".csv";
            saveReport($notification->id, $filename, $sessionToken, $response);
		}

	}

	return $result;
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
echo "Getting Notification List \n";
getNotifications($sessionToken);
echo "Done  \n";
