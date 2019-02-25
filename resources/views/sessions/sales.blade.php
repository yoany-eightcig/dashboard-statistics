<canvas id="canvas_sales"></canvas>

<script>
  //pie
    var ctx = document.getElementById("canvas_sales").getContext('2d');

    var myChart = new Chart(ctx, {
     type: 'line',
     data: {
         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
         datasets: [{
             label: '',
             data: [12, 7, 3, 5, 2, 3],
             backgroundColor: ["#594a2d","#660057","#6e8cff","#3d0c4e","#9ce6ae","#009e78","#001f8f","#ff7852","#ebff26","#0073e6","#f05eff","#00decc"],
             // backgroundColor: [
             //     'rgba(255, 99, 132, 0.2)',
             //     'rgba(54, 162, 235, 0.2)',
             //     'rgba(255, 206, 86, 0.2)',
             //     'rgba(75, 192, 192, 0.2)',
             //     'rgba(153, 102, 255, 0.2)',
             //     'rgba(255, 159, 64, 0.2)'
             // ],
             // borderColor: [
             //     'rgba(255,99,132,1)',
             //     'rgba(54, 162, 235, 1)',
             //     'rgba(255, 206, 86, 1)',
             //     'rgba(75, 192, 192, 1)',
             //     'rgba(153, 102, 255, 1)',
             //     'rgba(255, 159, 64, 1)'
             // ],
             borderWidth: 1
         }]
     },
     options: {
         scales: {
             yAxes: [{
                 ticks: {
                     beginAtZero:true
                 }
             }]
         }
     }
 });
 
</script>