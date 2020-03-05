<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
	protected $group_retail_pick = [
        "David Gallegos",
        "Hongxi Feng",   
        "Agustin Gelista",
        "Cedrick Holloway",
        "Janice Cruz",
        "Jesus Gaona",
        "William Cervantes",
        "zhiqiang zhou",
        //"Michael Sommermeyer",
        //"Bakari Criss",
        //"Ricky Espinosa",
        //"Marlai Gborkorquellie"
	];

    protected $group_retail_pack = [
        "Hongxi Feng",
        "Claudia Ponce",
        //"Ferdinand Furino",
        //"Shulin Lu",
        "xinli wu",
        //"Yan Foster",
        //"yanchun li",
        "Zhong Li",
        "Daniela Vega",
        "qingdong liu",
        "yanling Zhang"
    ];


	protected $group_wholesale_pick = [
        "Chee Leong",
        "Amy Radigan",
        "Annie Wang",
        "Betty Peng",
        "Bo Lai",
        //"Chuck Zhang",
        "Francisco Rosario",
        //"Joccelyn Favela",
        "Keen Lam",
        //"Peng Goldstein",
        "Simon Wu",
        "Vincent Cuaresma",
        "wenlong yan",
        "irving hernandez",
        "yanchun li"
	];


	protected $group_wholesale_pack = [
        "Chee Leong",
        "Amy Radigan",
        "Annie Wang",
        "Betty Peng",
        "Bo Lai",
        //"Chuck Zhang",
        "Francisco Rosario",
        //"Joccelyn Favela",
        "Keen Lam",
        //"Peng Goldstein",
        "Simon Wu",
        "Vincent Cuaresma",
        "wenlong yan",
        "irving hernandez",
        "yanchun li",
        "yanling Zhang"
	];

    public function __construct()
    {
        parent::__construct();
        // $this->middleware('guest');
        $this->group_retail_pick = array_map('strtolower', $this->group_retail_pick);
        $this->group_wholesale_pick = array_map('strtolower', $this->group_wholesale_pick);
        $this->group_retail_pack = array_map('strtolower', $this->group_retail_pack);
        $this->group_wholesale_pack = array_map('strtolower', $this->group_wholesale_pack);
    }

    public function getSalesOrderReport () {
        $csv = [];
        if (file_exists(storage_path().'/sales_order_today.csv')) {
            $csv = array_map('str_getcsv', file(storage_path().'/sales_order_today.csv'));
        }
    	

    	$read = false;
    	$sales = array();
    	foreach ($csv as $key => $line) {	
    		if (count($line) == 10 ) {
    			if ($line[6] <> '' && $line[6] <> 'Line Status' && $line[6] <> 'Voided') {
	    			if ($read) {
	    				$_status = ($line[6] == "Fulfilled" || $line[6] == "Ready for Pickup") ? "Fulfilled" : $line[6] ;
		    			$sales[$_status][] = 1;
	    			}
	    			if (!$read) $read = true;
    			}
    		}
    	}

    	return $sales;
    }

    public function getPackReport() {
        $csv = [];
        if (file_exists(storage_path().'/pack_today.csv')) {
            $csv = array_map('str_getcsv', file(storage_path().'/pack_today.csv'));    
        }
    	
    	$read = false;

    	$userCount = 0;
    	$groups_data = [];
        $groups_data['r'] = [];

        foreach ($this->group_retail_pack as $_name) {
            $groups_data['r'][ucwords($_name).":"] = 0;
        }

        $groups_data['w'] = [];

        foreach ($this->group_wholesale_pack as $_name) {
            $groups_data['w'][ucwords($_name).":"] = 0;
        }

    	foreach ($csv as $key => $line) {	
    		if (count($line) == 6 ) {
    			if ($line[0] <> '' && $line[1] == '') {
	    			$_name = $line[0];
	    			$max_length = 20;
	    			$_name = ucwords(strtolower($_name));
	    			if (strlen($_name) > $max_length) {
	    				$_name = substr($_name, 0, $max_length).'...';
	    			}

	    			if (in_array((strtolower($line[0])), $this->group_retail_pack)) {
	    				$groups_data['r'][$_name.":"] = $line[2];
	    			}
	    			if (in_array((strtolower($line[0])), $this->group_wholesale_pack)) {
	    				$groups_data['w'][$_name.":"] = $line[4];
	    			}	    			
    			}
    		}
    	}

        if (count($groups_data['r'])) { 
        	// arsort($groups_data['r']);
        	// $groups_data['r'] = array_splice($groups_data['r'], 0, 7);
        	// $this->shuffle_assoc($groups_data['r']);
        } 

        if (count($groups_data['w'])) { 
        	// arsort($groups_data['w']);
        	// $groups_data['w'] = array_splice($groups_data['w'], 0, 7);
        	// $this->shuffle_assoc($groups_data['w']);
        }

    	return $groups_data;
    }

    public function shuffle_assoc(&$array) {
        $keys = array_keys($array);

        shuffle($keys);

        foreach($keys as $key) {
            $new[$key] = $array[$key];
        }

        $array = $new;

        return true;
    }    

    public function getPickReport() {
        $csv = [];
        if (file_exists(storage_path().'/pick_today.csv')) {
            $csv = array_map('str_getcsv', file(storage_path().'/pick_today.csv'));    
        }
    	
    	$pick = [];
    	$read = false;

    	$userCount = 0;
        $groups_data = [];
        $groups_data['r'] = [];
        foreach ($this->group_retail_pick as $_name) {
            $groups_data['r'][ucwords($_name).":"] = 0;
        }

        $groups_data['w'] = [];
        foreach ($this->group_wholesale_pick as $_name) {
            $groups_data['w'][ucwords($_name).":"] = 0;
        }

        $w = [];
    	foreach ($csv as $key => $line) {	
    		if (count($line) == 6 ) {
    			if ($line[0] <> '' && $line[1] == '') {
    				$_name = $line[0];
    				$max_length = 20;
    				$_name = ucwords(strtolower($_name));

	    			$pick[$_name] = $line[2];
	    			if (in_array((strtolower($line[0])), $this->group_retail_pick)) {
	    				$groups_data['r'][$_name.":"] = $line[2];
	    			}
	    			if (in_array((strtolower($line[0])), $this->group_wholesale_pick)) {
	    				$groups_data['w'][$_name.":"] = $line[3];
	    			}
    			}
    		}
    	}

        // dd($pick, $this->group_retail_pick);

        if (count($groups_data['r'])) {
            // arsort($groups_data['r']);
            // $groups_data['r'] = array_splice($groups_data['r'], 0, 7);
            // $this->shuffle_assoc($groups_data['r']);

        }

        if (count($groups_data['w'])) {
        	// arsort($groups_data['w']);
        	// $groups_data['w'] = array_splice($groups_data['w'], 0, 7);
        	// $this->shuffle_assoc($groups_data['w']);
        }
        
    	return $groups_data;
    }

    public function dashboard () {
    	$sales = [];
    	$sales = $this->getSalesOrderReport();

    	// dd($sales);
    	$salesBackgroundColor = [];
    	foreach ($sales as $key => $value) {
    		if ($key == 'Fulfilled') $salesBackgroundColor[] = '#e74c3c';
    		if ($key == 'Ready to Pick') $salesBackgroundColor[] = '#f1c40f';
    		if ($key == 'Ready to Ship') $salesBackgroundColor[] = '#9b59b6';
    		if ($key == 'Ready for Pickup') $salesBackgroundColor[] = '#2980b9';
    		if ($key == 'Ready to Pack') $salesBackgroundColor[] = '#2ecc71';
    		if ($key == 'Voided') $salesBackgroundColor[] = '#3498db';
    	}
    	// $salesBackgroundColor = ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#3498db", "#9b59b6", "#f1c40f", "#e67e22", "#e67e22"];

    	$pack = [];
    	$pack = $this->getPackReport();
    	$packBackgroundColor = ["#27ae60", "#e67e22", "#3498db", "#f1c40f", "#c0392b", "#ecf0f1", "#1abc9c",
            "#1abc9c", 
            "#2ecc71", 
            "#3498db", 
            "#9b59b6", 
            "#34495e", 
            "#16a085", 
            "#27ae60",
            "#2980b9",
            "#8e44ad",
            "#2c3e50",
            "#f1c40f",
            "#e67e22",
            "#e74c3c",
            "#ecf0f1",
            "#95a5a6",
            "#f39c12",
            "#d35400",
            "#c0392b",
            "#bdc3c7",
    ];

    	$pick = [];
    	$pick = $this->getPickReport();
    	$pickBackgroundColor = [
    		"#1abc9c", 
    		"#2ecc71", 
    		"#3498db", 
    		"#9b59b6", 
    		"#34495e", 
    		"#16a085", 
            "#27ae60",
            "#2980b9",
            "#8e44ad",
            "#2c3e50",
            "#f1c40f",
            "#e67e22",
            "#e74c3c",
            "#ecf0f1",
            "#95a5a6",
            "#f39c12",
            "#d35400",
            "#c0392b",
            "#bdc3c7",
    	];

        $previous_top_pack = $this->getYesterdayTopPackReport();
        $previous_top_pick = $this->getYesterdayTopPickReport();

    	return view('welcome')->with([
    		//Sales Order Statistics
    		"sales" => $sales, 
    		"salesBackgroundColor" => $salesBackgroundColor,
    		//Pack Statistics
    		"pack" => $pack,
    		"packBackgroundColor" => $packBackgroundColor,
    		//Pick Statistics
    		"pick" => $pick,
    		"pickBackgroundColor" => $pickBackgroundColor,
            "previous_top_pick" => $previous_top_pick,
            "previous_top_pack" => $previous_top_pack,

    	]);	
    }

    public function updateCurrentData() {
        set_time_limit(0);
        ini_set('max_execution_time', 0);
        
        /*
        $response = $this->locateRequest('GET', "/notification/1864", $this->sessionToken, array());
        dd($response);
        exit;
        */

    	$report_name = "Sales Order Dashboard";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 629;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'listofpicks' => 0,
    		'daterange' => 'Current Day',  
    		'daterange2' => 'Current Day', 
    		'format'=>'csv'
        ));

    	$result = file_put_contents(storage_path().'/sales_order_today.csv', $response);

    	$report_name = "Pack Statistics";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 636;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'formatassinglepage' => 0,
    		'listofpicks' => 0,
    		'picktime' => 1,
    		'packcompleted' => 'Current Day',  
    		'packcompleted2' => 'Current Day', 
    		'format'=>'csv'
        ));

    	$result = file_put_contents(storage_path().'/pack_today.csv', $response);

    	$report_name = "Pick Statistics";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 627;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'formatassinglepage' => 1,
    		'listofpicks' => 0,
    		'picktime' => 1,
    		'pickcompleted' => 'Current Day',  
    		'pickcompleted2' => 'Current Day', 
    		'format'=>'csv'
        ));

    	$result = file_put_contents(storage_path().'/pick_today.csv', $response);

    	return response()->json(['status' => 'updated']);
    }

    public function getYesterdayData() {
        set_time_limit(0);
        ini_set('max_execution_time', 0);

    	$report_name = "Sales Order Dashboard";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 629;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'listofpicks' => 0,
    		'daterange' => 'Previous Day',  
    		'daterange2' => 'Previous Day', 
    		'format'=>'csv')
    	);

    	$result = file_put_contents(storage_path().'/sales_order_previous.csv', $response);

    	$report_name = "Pack Statistics";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 636;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'formatassinglepage' => 1,
    		'listofpicks' => 0,
    		'picktime' => 1,
    		'packcompleted' => 'Previous Day',  
    		'packcompleted2' => 'Previous Day', 
    		'format'=>'csv')
    	);

    	$result = file_put_contents(storage_path().'/pack_previous.csv', $response);

    	$report_name = "Pick Statistics";
    	// $report = $this->locateRequest('GET', '/report?name='.urlencode($report_name), $this->sessionToken);
    	// $report_id = $report->data[0]->id;
    	$report_id = 627;

    	$response = $this->locateRequest('GET', "/report/".$report_id."/run", $this->sessionToken, array(
    		'formatassinglepage' => 1,
    		'listofpicks' => 0,
    		'picktime' => 1,
    		'pickcompleted' => 'Previous Day',  
    		'pickcompleted2' => 'Previous Day', 
    		'format'=>'csv')
    	);

    	$result = file_put_contents(storage_path().'/pick_previous.csv', $response);    
    	return response()->json(['status' => 'OK']);	
    }

    public function getYesterdayTopPackReport() {
        $csv = [];

        if (file_exists(storage_path().'/pack_previous.csv')) {
            $csv = array_map('str_getcsv', file(storage_path().'/pack_previous.csv'));    
        }
        
        $read = false;

        $userCount = 0;
        $groups_data = [];
        $groups_data['r'] = [];
        $groups_data['w'] = [];

        foreach ($csv as $key => $line) {   
            if (count($line) == 6 ) {
                if ($line[0] <> '' && $line[1] == '') {
                    $_name = $line[0];
                    $max_length = 20;
                    $_name = ucwords(strtolower($_name));
                    if (strlen($_name) > $max_length) {
                        $_name = substr($_name, 0, $max_length).'...';
                    }

                    if (in_array((strtolower($line[0])), $this->group_retail_pack)) {
                        if (intval($line[2]) >= 300 ) {
                            $groups_data['r'][$_name.": [$line[2]]"] = $line[2];
                        }
                    }

                    if (in_array((strtolower($line[0])), $this->group_wholesale_pack)) {
                        if (intval($line[4]) >= 350 ) {
                            $groups_data['w'][$_name.": [$line[4]]"] = $line[4];
                        }
                    }                   
                }
            }
        }

        if (count($groups_data['r'])) {
            arsort($groups_data['r']);
            // $groups_data['r'] = array_splice($groups_data['r'], 0, 7);
            // $this->shuffle_assoc($groups_data['r']);
        }

        if (count($groups_data['w'])) {
            arsort($groups_data['w']);
            // $groups_data['w'] = array_splice($groups_data['w'], 0, 7);
            // $this->shuffle_assoc($groups_data['w']);                
        }

        return $groups_data;
    }

    public function getYesterdayTopPickReport() {

        $csv = [];

        if (file_exists(storage_path().'/pick_previous.csv')) {
            $csv = array_map('str_getcsv', file(storage_path().'/pick_previous.csv'));    
        }
        
        $pick = [];
        $read = false;

        $userCount = 0;
        $groups_data = [];
        $groups_data['r'] = [];
        $groups_data['w'] = [];

        foreach ($csv as $key => $line) {   
            if (count($line) == 6 ) {
                if ($line[0] <> '' && $line[1] == '') {
                    $_name = $line[0];
                    $max_length = 20;
                    $_name = ucwords(strtolower($_name));
                    if (strlen($_name) > $max_length) {
                        $_name = substr($_name, 0, $max_length).'...';
                    }

                    $pick[$_name] = $line[2];
                    if (in_array((strtolower($line[0])), $this->group_retail_pick)) {
                        if (intval($line[2]) >= 12) {
                            $groups_data['r'][$_name.": [$line[2]]"] = $line[2];
                        }
                    }
                    if (in_array((strtolower($line[0])), $this->group_wholesale_pick)) {
                        if (intval($line[3]) >= 350) {
                            $groups_data['w'][$_name.": [$line[3]]"] = $line[3];
                        }
                    }
                }
            }
        }

        if (count($groups_data['r'])) {
            arsort($groups_data['r']);
            $groups_data['r'] = array_splice($groups_data['r'], 0, 7);
            $this->shuffle_assoc($groups_data['r']);
        }

        if (count($groups_data['w'])) {
            arsort($groups_data['w']);
            $groups_data['w'] = array_splice($groups_data['w'], 0, 7);
            $this->shuffle_assoc($groups_data['w']);
        }

        return $groups_data;
    }

}

// https://test_eightcig.locateinv.com/report/237/run?formatassinglepage=0&listofpicks=1&picktime=1&packcompleted=Current+Year&packcompleted2=Current+Year&format=csv&api_key=aa2ea1cc0da72be4b4410dd68fb14573