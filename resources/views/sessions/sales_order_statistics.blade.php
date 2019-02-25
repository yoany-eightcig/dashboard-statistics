<canvas id="canvas_shipped"></canvas>

<script>
  //pie
  var ctxP = document.getElementById("canvas_shipped").getContext('2d');

  let _labes = [
  @php
    foreach ($sales as $key => $value) {
      echo "'$key',";
    }
  @endphp ];

  let _data = [
    @php
      foreach ($sales as $key => $value) {
        echo count($value).",";
      }
    @endphp
  ]

  let _salesBackgroundColor = [
    @php
      foreach ($salesBackgroundColor as $key => $value) {
        echo ("'$value',");    
      }  
    @endphp
  ];

  var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
      labels: _labes,
      datasets: [{
        data: _data,
        backgroundColor: _salesBackgroundColor,
      }]
    },
    options: {
      responsive: true
    }
  });

</script>