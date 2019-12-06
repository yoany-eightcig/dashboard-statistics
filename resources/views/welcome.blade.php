@extends('layouts.app')


@php
	date_default_timezone_set('America/Los_Angeles');
	$date = date('m/d/Y h:i:s a', time());
	$timeout = (1000 * 60 * 10);
	set_time_limit($timeout);
@endphp

@section('content')
<style type="text/css">
	.logo_info p {
		margin: 0;
		line-height: 1rem;
	}	
</style>
 <div class="container-fluid">
 	<div class="row ">
		<div class="col-md-3">
			<div class="text-white clearfix mb-3">
				<div class="float-left mr-3">
					<img height="120px" src="/images/eightcig-logo-red.png">
				</div>
				<div class="float-left logo_info">
					<h4 class="text-white">EightCig</h4>
					<p>3010 E Alexander Rd</p>
					<p>Ste #1002</p>
					<p>North Las Vegas, NV 89030</p>
					<p><a href="tel:702-415-5263">(702) 415-5263</a></p>
					<p>info@eightcig.com</p>
				</div>
			</div>

		{{-- 	<div>
				<h4 class="text-white">(Yesterday) Top Performance</h4>
				@include('sessions.top_performer', ['previous_top_pick' => $previous_top_pick, "previous_top_pack" => $previous_top_pack])
			</div>
		 --}}	
			<div>
				<h4 class="text-white">Sales Order Dashboard</h4>
				@include('sessions.sales_order_statistics', ['sales' => $sales, "salesBackgroundColor" => $salesBackgroundColor])		
			</div>
		</div>

		<div class="col-md-8">
			<div class="row flex-column">
				<div class="col-md">
					<div class="text-center">
						<h4 class="text-white mb-0">Pick Statistics</h4>
						<p class="text-white mb-0">Date: {{ $date }}</p>
					</div>
				    @include('sessions.pick', ['pick' => $pick, "pickBackgroundColor" => $pickBackgroundColor])
				</div>
				<div class="col-md">
					<div class="text-center">
				    	<h4 class="text-white">Pack Statistics</h4>
				    	<p class="text-white mb-0">Date: {{ $date }}</p>
					</div>
				    @include('sessions.pack', ['pack' => $pack, "packBackgroundColor" => $packBackgroundColor])
				</div>
				
			</div>
		</div>
 		
 	</div>
</div>

<script>

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function showOnceInADay() {
    var user = getCookie("getyesterdaydata");
    if (user != "") {
    } else {
		// setInterval(function() {
	  		getyesterdaydata();
		// }, (1000 * 60 * 5));

       $("#index9").fadeIn('slow');       
       setCookie("getyesterdaydata", 1, 1);
    }
}

$(document).ready(function() {

  	setInterval(function() {
    	refresh_page();
  	}, (1000 * 60 * 10));

  	var d = new Date();
  	var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

	if (d.getDay() != 1) {
		showOnceInADay();
  	}
});

function refresh_page() {
	/*
	$.ajax ({
		method: 'GET',
	    url: '/updatecurrentdata',
	    // dataType: "json",
	    // contentType: "application/json",
	    timeout: {{ $timeout }},
	    success: function (jsonData) {
	        // Success callback
	        window.location.reload(true);
	    },
	    error: function(e) {
	        //any error to be handled
	        window.location.reload(true);
	        console.error(e);
	    }
	 });	
	 */
	 window.location.reload(true);
}	

function getyesterdaydata() {
	$.ajax ({
		method: 'GET',
	    url: '/getyesterdaydata',
	    // dataType: "json",
	    // contentType: "application/json",
	    timeout: {{ $timeout }},
	    success: function (jsonData) {
	        // Success callback
	        console.log('yesterdaydata updated');
	    },
	    error: function(e) {
	        //any error to be handled
	        window.location.reload(true);
	        console.error(e);
	    }
	 });	
}	


</script>
@endsection