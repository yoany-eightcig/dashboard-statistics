
<div class="row">
  <div class="col-md-6">
    <h4 class="text-white text-center">Retail</h4 >
    <canvas id="canvas_pick_retail"></canvas>
  </div>
  <div class="col-md-6">
    <h4 class="text-white text-center">Wholesale</h4 >
    <canvas id="canvas_pick_whole_sales"></canvas>
  </div>
</div>

<script>
  //pie
  var chart_r = document.getElementById("canvas_pick_retail").getContext('2d');
  var chart_w = document.getElementById("canvas_pick_whole_sales").getContext('2d');

  let _pickLabels = [
    @php
      foreach ($pick['r'] as $key => $value) {  echo "'$key',"; }
    @endphp
  ];

  let _pickData = [
    @php 
      foreach ($pick['r'] as $key => $value) { echo $value.","; }
    @endphp
  ];

  let _pickBackgroundColor = [
    @php 
      foreach ($pickBackgroundColor as $key => $value) { echo ("'$value',"); }  
    @endphp
  ];

  var chart_r_pick = new Chart(chart_r, {
    type: 'horizontalBar',
    data: {
      labels: _pickLabels,
      datasets: [{
        label: "",
        data: _pickData,
        backgroundColor: _pickBackgroundColor,
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

  let _pickLabels_w = [
    @php
      foreach ($pick['w'] as $key => $value) {  echo "'$key',"; }
    @endphp
  ];

  let _pickData_w = [
    @php 
      foreach ($pick['w'] as $key => $value) { echo $value.","; }
    @endphp
  ];

  let _pickBackgroundColor_w = [
    @php 
      foreach ($pickBackgroundColor as $key => $value) { echo ("'$value',"); }  
    @endphp
  ];

  var chart_w_pick = new Chart(chart_w, {
    type: 'horizontalBar',
    data: {
      labels: _pickLabels_w,
      datasets: [{
        label: "",
        data: _pickData_w,
        backgroundColor: _pickBackgroundColor_w,
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