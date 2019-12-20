<!DOCTYPE html>
<html lang="{{ locale }}" dir="{{ direction }}" class="{{ checkout_html_classes }}">
  <head>
    <!-- ManyChat -->
	<script src="//widget.manychat.com/353289601541902.js" async="async"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0">
    <meta name="referrer" content="origin">

    <title>{{ page_title }}</title>

    {{ content_for_header }}

    {{ checkout_stylesheets }}
    {{ checkout_scripts }}
<!--     <script src="//code.jquery.com/jquery-3.3.1.min.js"></script> -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script> --}}
    
<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
        
<style type="text/css">
	.modal {
  		visibility: inherit !important;
	}
  .blocker {
    z-index: 999;
  }
/*  
span.small-text {
  display:none !important;
}
  
  
.checkbox-container {
  padding-top: 1.5em;
}
.checkbox-container label {
  cursor: pointer;
  padding-top: 1.5em;
}

.og_btn {
  display: inline-block;
  border-radius: 4px;
  font-weight: 500;
  padding: 1.4em 1.7em;
  box-sizing: border-box;
  text-align: center;
  cursor: pointer;
  transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
  background: red;
  color: white;
}
  
.og_btn:hover {
  background: #042904;
  color: white;
}
.hidden_button {
  display:none;
}
.message_error {
  color: red;
}
.message_warning {
  color: #ffc107!important;
}
.message_info {
  color: #17a2b8!important;
}
  
.message_success {
  color: green;
}
*/

</style>
    
<noscript><meta http-equiv="refresh" content="0;url=https://agechecker.net/noscript"></noscript>
<script>
(function(w,d) {
  var config = {
    key: "X0J9XxagEIa20SJiC0DhJSXrmrLRIVsP",
    name: "{{shop.name}}",
    element: "div[data-step=payment_method] form .step__footer button",
    ignore_fields: true,
    data: {
      first_name: "{{checkout.shipping_address.first_name}}",
      last_name: "{{checkout.shipping_address.last_name}}",
      address: "{{checkout.shipping_address.address1}}",
      zip: "{{checkout.shipping_address.zip}}",
      country: "{{checkout.shipping_address.country_code}}",
      state: "{{checkout.shipping_address.province_code}}",
      city: "{{checkout.shipping_address.city}}"
    }
  };
 
  let customer_email = "{{checkout.email}}";
 
  //if(config.data.state == "CA" || config.data.state == "IL")
  { 
    if (customer_email != "Zack1mx@gmail.com" ) {
      w.AgeCheckerConfig=config;if(config.path&&(w.location.pathname+w.location.search).indexOf(config.path)) return;
      var h=d.getElementsByTagName("head")[0];var a=d.createElement("script");a.src="https://cdn.agechecker.net/static/popup/v1/popup.js";a.crossOrigin="anonymous";
      a.onerror=function(a){w.location.href="https://agechecker.net/loaderror";};h.insertBefore(a,h.firstChild);
    }
  }
  
})(window, document);
</script>
    
  
  {% include 'shogun-head' %}
{% include 'booster-common' %}
</head>
  <body>
    <div id="ban-alert" class="modal">
      <p>
      	<h2 style="color: #fa0065;">Internet Sales Vape Ban Alert</h2>
      </p>  
	  <p>
        <b>Arkansas, Massachusetts, Washington, Rhode Island and Utah Ban Internet Sales of Nicotine Products</b><br><br>
        Due to recent rules and regulation changes for many states, we are no longer able to process orders from the states of Arkansas, Massachusetts and Utah. We apologize for this inconvenience, and appreciate the continued support.
      </p>  

      <p>
        In conclusion: All sales of nicotine products are not permitted to any Arkansas, Massachusetts & Utah residents through internet, phone, fax or email.
      </p>
		<br>

      <b>Rhode Island & Washington: All Flavored Nicotine Items Banned</b>
		<br>
      <p>All Flavors Banned. We are only allowed to sell Regular Tobacco flavor to these states.</p>
		<br>

      <p>*We will update this notice as we receive any new information. The information listed on these pages are of our opinion and may not be the latest information. We do not guarantee the accuracy of any of the gathered information provided on this page though we will follow these guidelines until further notice.</p>
      <br>
      <a href="#" rel="modal:close">Close</a>
    </div>
    
    {{ skip_to_content_link }}

    <div class="banner" data-header>
      <div class="wrap">
        {{ content_for_logo }}
      </div>
    </div>

    {{ order_summary_toggle }}

    <div class="content" data-content>
      <div class="wrap">
        <div class="main" role="main">
          <div class="main__header">
            {{ content_for_logo }}
            {{ breadcrumb }}
            {{ alternative_payment_methods }}
          </div>
          <div class="main__content">
            {{ content_for_layout }}     
          </div>
                   
          <div class="main__footer">
            {{ content_for_footer }}
          </div>
        </div>
        <div class="sidebar" role="complementary">
          <div class="sidebar__header">
            {{ content_for_logo }}
          </div>
          <div class="sidebar__content">
            {{ content_for_order_summary }}
          </div>
        </div>
      </div>
      
<div class="mcwidget-checkbox" data-widget-id="6367001"></div>

<!--
<div class="checkbox-container hidden_button" data-address-verification-html>
  <h2 class="section__title" style="margin-bottom: 1em">Address Verification</h2>
  <p>Please validate your address in order to continue.</p><br>
  <div id="messages" class="container_messages"></div>
  <div class="searching hidden_button">
    <img src="{{ 'ajax-load.gif' | asset_url }}"/>
  </div>
  <div class="checkbox-container">
    <div class="og_btn address-verify">Validate Your Address</div>
  </div>
</div>
-->      
    </div>

    {{ tracking_code }}
    
    
  {% include 'booster-discounts' %}
<!--   <div id="vsscript_59632_599318"></div><script async type="text/javascript" src="https://app.viralsweep.com/vsa-lightbox-b3104a-59632.js?sid=59632_599318"></script> -->
</body>
  
<script>
  
  let previous_step = document.getElementById("previous_step").value;
  console.log(previous_step);
  
  if (previous_step == 'payment_method' ) {

    let country = "{{checkout.shipping_address.country_code}}";
    let state = "{{checkout.shipping_address.province_code}}";
    console.log(country);
    console.log(state);
    if (country == "US") {
      switch(state) {
        //case "ME": //Maine
        //case "SD": //South Dakota
        //case "VT": //Vermont
        case "AR": //Arkansas
        case "UT": //Utah, 
          $(".step__footer__continue-btn").hide();
          $('#ban-alert').modal({
            fadeDuration: 250,
            escapeClose: false,
            clickClose: false,
			//showClose: false            
          });
          break;
        case "MA": //Massachusetts
       	case "RI":
        case "WA": //Washington
          let skus = '';
          {% for line in checkout.line_items %}
          	skus += '{{line.sku%}}';
          {% endfor %}
            
          if (skus.includes('J')) {
            $(".step__footer__continue-btn").hide();
            $('#ban-alert').modal({
              fadeDuration: 250,
              escapeClose: false,
              clickClose: false,
              //showClose: false            
            });
          }
          break;
      }
    }
  }
    
  
  
/*
if(typeof Checkout === 'object'){
  if(typeof Checkout.$ === 'function'){
	let $ = Checkout.$;
    
    function cleanComp() {
      $(".step__footer__continue-btn").addClass("hidden_button");
      $("#messages").html( "" );
      $("#messages").removeClass("message_error");
      $("#messages").removeClass("message_success");
       
    }
    
    let previous_step = document.getElementById("previous_step").value;
    if (previous_step == 'contact_information' ) {
      $(".step__footer__continue-btn").addClass("hidden_button");
      $(".checkbox-container").removeClass("hidden_button");
      
      if ($('.section--shipping-address').length) {
        $('[data-address-verification-html]').appendTo($('.step__sections'));
      }
      
      $("#checkout_shipping_address_address1").change(function() {
		cleanComp();
      });
      $("#checkout_shipping_address_address2").change(function() {
		cleanComp();
      });
      $("#checkout_shipping_address_country").change(function() {
		cleanComp();
      });
      $("#checkout_shipping_address_province").change(function() {
		cleanComp();
      });
      $("#checkout_shipping_address_zip").change(function() {
		cleanComp();
      });

      
      $('.address-verify').on('click', function() {
		$(".searching").removeClass("hidden_button");   
        cleanComp();
        
        var firtname = $("input#checkout_shipping_address_first_name.field__input").val() ;
        var lastname = $("#checkout_shipping_address_last_name").val();

        var address1 = $("#checkout_shipping_address_address1").prop('value');
        var address2 = $("#checkout_shipping_address_address2").val();
        var city = $("#checkout_shipping_address_city").val();

        var country = $("#checkout_shipping_address_country").find(':selected').attr('data-code');
        var province = $("#checkout_shipping_address_province").val();

        var zip = $("#checkout_shipping_address_zip").val();
        var phone = $("#checkout_shipping_address_phone").val();
        var company = $("#checkout_shipping_address_company").val();
        
        let data = {
              name: firtname+" "+lastname,
              phone: phone,
              company_name: company,
              address_line1: address1,
              address_line2: address2,
              city_locality: city,
              state_province: province,
              postal_code: zip,
              country_code: country
        	};
        
        let url = "https://address-verification-eightcig.herokuapp.com/";
        
		$.get( url, data, function(response) {
          let data = JSON.parse(response);
          console.log(data);
          $(".searching").addClass("hidden_button");
          
          if (data.status == "verified") {
            $( "#messages" ).append( "<h2>Info</h2>" );
            let has_error = false;
            let has_warning = false;
            
            if (data.messages.length > 0 ) {
              for (i = 0; i < data.messages.length; i++) {
                console.log(data.messages[i]);
                if (data.messages[i].type == "error") {
                  $( "#messages" ).append( "<p class='message_error'>["+data.messages[i].type+"] "+data.messages[i].message+"</p>" );
                  has_error = true;
                }
                
                if (data.messages[i].type == "warning") {
                	$( "#messages" ).append( "<p class='message_warning'>["+data.messages[i].type+"] "+data.messages[i].message+"</p>" );
                  	has_warning = true;
                }
                
                if (data.messages[i].type == "info") {
                	$( "#messages" ).append( "<p class='message_info'>["+data.messages[i].type+"] "+data.messages[i].message+"</p>" );
                  	has_warning = true;
                }
              }
            }
            
            $( "#messages" ).addClass("message_success");
            $( "#messages" ).append( "<p>Your address was verified successfully.</p>" );

            $(".address-verify").addClass("og_btn_success");
            
            if (!has_error && has_warning){
              $(".step__footer__continue-btn").removeClass("hidden_button");
            } else if (!has_error && !has_warning) {
              $(".step__footer__continue-btn").removeClass("hidden_button");
              //$(".step__footer__continue-btn").trigger( "click" );
            }
            
          }
          
          if (data.status == "error") {
            $( "#messages" ).addClass("message_error");
            $( "#messages" ).append( "<h2>Error</h2>" );
            for (i = 0; i < data.messages.length; i++) {
              console.log(data.messages[i]);
              $( "#messages" ).append( "<p>"+data.messages[i].message+"</p>" );
            }
          }

          if (data.status == "unverified") {
            $( "#messages" ).addClass("message_error");
            $( "#messages" ).append( "<h2>Error</h2>" );
            for (i = 0; i < data.messages.length; i++) {
              console.log(data.messages[i]);
              $( "#messages" ).append( "<p>"+data.messages[i].message+"</p>" );
            }
          }
          
        });
        
      });
      
    }
  }
}
*/

</script>
  
</html>
