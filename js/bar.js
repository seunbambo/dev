$(document).ready(function() {
  $.ajax({
    url: "models/trans-data.php",
    method: "POST",
    success: function(data) {
      //data = data.transactionAmount;
      //console.log(data);
      var transactionAmount = [];
      var transactionInfo = [];

      for (var i in data) {
        transactionInfo.push(data[i].transactionInfo);
        transactionAmount.push(data[i].transactionAmount);
      }
      var chartdata = {
        labels: transactionInfo,
        datasets: [
          {
            label: "Transaction",
            backgroundColor: "rgba(40, 109, 126, 0.3)",
            borderColor: "rgba(40, 109, 126, 0.932)",
            hoverBackgroundColor: "rgba(40, 109, 126, 0.7)",
            hoverBorderColor: "rgba(40, 109, 126, 1)",
            borderWidth: 1.5,
            barThickness: 2,
            data: transactionAmount
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

      //document.write(data(entityId));

      var ctx = $("#mycanvas");

      ctx.height(100);

      var barGraph = new Chart(ctx, {
        type: "bar",
        data: chartdata,
        options: options
      });
    },
    error: function(data) {
      //console.log(data);
      console.clear();
    }
  });
});
