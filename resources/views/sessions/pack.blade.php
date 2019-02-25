
<div class="row">
  <div class="col-md-6">
    <h4 class="text-white text-center">Retail</h4 >
    <canvas id="canvas_pack_retail"></canvas>
  </div>
  <div class="col-md-6">
    <h4 class="text-white text-center">Wholesale</h4 >
    <canvas id="canvas_pack_whole_sales"></canvas>
  </div>
</div>

<script>
  //pie
  var chart_r = document.getElementById("canvas_pack_retail").getContext('2d');
  var chart_w = document.getElementById("canvas_pack_whole_sales").getContext('2d');

  let _packLabels = [
    @php
      foreach ($pack['r'] as $key => $value) {  echo "'$key',"; }
    @endphp
  ];

  let _packData = [
    @php 
      foreach ($pack['r'] as $key => $value) { echo $value.","; }
    @endphp
  ];

  let _packBackgroundColor = [
    @php 
      foreach ($packBackgroundColor as $key => $value) { echo ("'$value',"); }  
    @endphp
  ];

  Chart.defaults.global.defaultFontColor = '#CFD8DC';

  var chart_r_pack = new Chart(chart_r, {
    type: 'horizontalBar',
    data: {
      labels: _packLabels,
      datasets: [{
        label: "",
        data: _packData,
        backgroundColor: _packBackgroundColor,
        borderWidth: 1,
      }]
    },
    options: {
      legend: {
        display: false
      },        
      responsive: true,
      scales: {
          xAxes: [{
              ticks: {
                  beginAtZero:true
              }
          }]
      },

    }
  });

  let _packLabels_w = [
    @php
      foreach ($pack['w'] as $key => $value) {  echo "'$key',"; }
    @endphp
  ];

  let _packData_w = [
    @php 
      foreach ($pack['w'] as $key => $value) { echo $value.","; }
    @endphp
  ];

  let _packBackgroundColor_w = [
    @php 
      foreach ($packBackgroundColor as $key => $value) { echo ("'$value',"); }  
    @endphp
  ];

  var chart_w_pack = new Chart(chart_w, {
    type: 'horizontalBar',
    data: {
      labels: _packLabels_w,
      datasets: [{
        label: "",
        data: _packData_w,
        backgroundColor: _packBackgroundColor_w,
        borderWidth: 1,
      }]
    },
    options: {
      legend: {
        display: false
      },        
      responsive: true,
      scales: {
          xAxes: [{
              ticks: {
                  beginAtZero:true
              }
          }]
      },

    }
  });

</script>