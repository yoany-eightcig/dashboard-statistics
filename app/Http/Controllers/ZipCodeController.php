<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    //
	public function check(Request $request, $zipcode)
	{

		$filePath = "/zipcodes.csv";
        $csv = [];
        if (file_exists(storage_path().$filePath)) {
            $csv = array_map('str_getcsv', file(storage_path().$filePath));
        }

		$key = array_search($zipcode, array_column($csv, 0));

		$result = [
			"zipcode" => $zipcode,
			"ready" => ($key) ? true : false,
		];


	    return response()->json($result, 200);
	}

}
