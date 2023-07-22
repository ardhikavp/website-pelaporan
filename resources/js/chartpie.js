var pieChartClass;
(function($) {
  $(document).ready(function() {
    var ctx = document.getElementById("pieChart").getContext('2d');
    pieChartClass.ChartData(ctx, chartData); // Pass 'chartData' as an argument to the function
  });

  pieChartClass = {
    ChartData: function(ctx, chartData) {
      var labels = chartData.map(item => item.label);
      var data = chartData.map(item => item.data);
      var backgroundColor = chartData.map(item => item.backgroundColor);

      new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: data,
            backgroundColor: backgroundColor,
          }]
        },
      });
    }
  }
})(jQuery);
