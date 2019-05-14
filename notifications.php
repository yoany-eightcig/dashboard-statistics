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


		if (strpos($filename, "PackStatistics") !== false) {
			$filename = "pack_today.csv";
			$response = file_get_contents($url);
			$result = file_put_contents('storage/'.$filename, $response);

			$response = locateRequest('POST', "/notification/delete", $sessionToken, array(
				"notification_ids" => [$notification->id],
			));
			echo var_dump($response). "\n";
		} else if (strpos($filename, "OrderDashboard") !== false) {
			$filename = "sales_order_today.csv";
			$response = file_get_contents($url);
			$result = file_put_contents('storage/'.$filename, $response);

			$response = locateRequest('POST', "/notification/delete", $sessionToken, array(
				"notification_ids" => [$notification->id],
			));
			echo var_dump($response). "\n";
		}

	}

	return $result;
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
echo "Getting Notification List \n";
getNotifications($sessionToken);
echo "Done  \n";
