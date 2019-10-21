$(document).ready(function() {
  /**
   * call the data.php file to fetch the result from db table.
   */
  $.ajax({
    url: "models/trans-data.php",
    type: "GET",
    success: function(data) {
      //console.log(data);

      var transactionAmount = [];
      var transactionDate = [];
      var len = data.length;

      for (var i = 0; i < len; i++) {
        transactionAmount.push(data[i].transactionAmount);
        transactionDate.push(data[i].transactionDate);
      }

      //get canvas
      var ctx = $("#line-chartcanvas2");

      var data = {
        labels: transactionAmount,
        datasets: [
          {
            label: "Transaction",
            data: transactionAmount,
            backgroundColor: "rgba(40, 109, 126, 0.3)",
            borderColor: "rgba(40, 109, 126, 1)",
            fill: true,
            lineTension: 0.4,
            borderWidth: 1.5,
            pointRadius: 3
          }
        ]
      };

      var options = {
        title: {
          display: false,
          position: "top",
          text: "Line Graph",
          fontSize: 18,
          fontColor: "#111"
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              gridLines: {
                display: true
              }
            }
          ]
        },
        legend: {
          display: false
        }
      };

      var chart = new Chart(ctx, {
        type: "line",
        data: data,
        options: options
      });
    },
    error: function(data) {
      console.log(data);
      console.clear();
    }
  });
});
