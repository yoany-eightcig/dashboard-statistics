<h4 class="text-right text-white">Pick Statistics</h4>
<div class="row">
	<div class="col-md-6">
		<h4 class="text-white">Retail</h4>
		<ul>
	  		@foreach ($previous_top_pick['r'] as $key => $value)
	  			<li class="text-success">{{ $key }}</li>
	  		@endforeach
  		</ul>
  		@if (!count($previous_top_pick['r']))
  			<span class="text-white">Empty</span><br>
  		@endif
	</div>
	<div class="col-md-6">
		<h4 class="text-white">Wholesale</h4>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		  	<div class="carousel-inner">
				<ul>
			  		@foreach ($previous_top_pick['w'] as $key => $value)
			  			<li class="text-success">{{ $key }}</li>
			  		@endforeach
		  		</ul>
		  		@if (!count($previous_top_pick['w']))
		  			<span class="text-white">Empty</span><br>
		  		@endif
		  	</div>
		</div>
	</div>
</div>

<h4 class="text-right text-white">Pack Statistics</h4>
<div class="row">
	<div class="col-md-6">
		<h4 class="text-white">Retail</h4>
		<ul>
	  		@foreach ($previous_top_pack['r'] as $key => $value)
	  			<li class="text-success">{{ $key }}</li>
	  		@endforeach
  		</ul>
  		@if (!count($previous_top_pack['r']))
  			<span class="text-white">Empty</span><br>
  		@endif
	</div>
	<div class="col-md-6">
		<h4 class="text-white">Wholesale</h4>
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
		  	<div class="carousel-inner">
				<ul>
			  		@foreach ($previous_top_pack['w'] as $key => $value)
			  			<li class="text-success">{{ $key }}</li>
			  		@endforeach
		  		</ul>
		  		@if (!count($previous_top_pack['w']))
		  			<span class="text-white">Empty</span><br>
		  		@endif
		  	</div>
		</div>
	</div>
</div>