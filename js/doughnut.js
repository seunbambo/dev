$(document).ready(function() {
  var link = window.location.hostname;

  $.ajax({
    url: "models/doughnut.php",
    type: "GET",
    success: function(data) {
      //console.log(data);

      var curBalance = {
        walletType: []
      };

      //var len = data.length;

      for (var i = 0; i < 3; i++) {
        if (data[i].entityId) {
          curBalance.walletType.push(data[i].curBalance);
        }
      }

      var ctx1 = $("#doughnut-chartcanvas-1");

      var data1 = {
        labels: ["Primary Wallet", "Stock Wallet"],
        datasets: [
          {
            label: "Wallet Balance",
            data: curBalance.walletType,
            backgroundColor: [
              "rgba(40, 109, 126, 0.9)",
              "rgba(40, 109, 126, 0.3)"
            ],
            borderColor: [
              "rgba(40, 109, 126, 0.9)",
              "rgba(rgba(40, 109, 126, 0.3)"
            ],
            hoverBackgroundColor: "rgba(40, 109, 126, 0.6)",
            hoverBorderColor: "rgba(40, 109, 126, 0.6)",
            borderWidth: [1, 1, 1, 1, 1]
          }
        ]
      };

      var options = {
        title: {
          display: false,
          position: "top",
          text: "Chart",
          fontSize: 18,
          fontColor: "#111"
        },
        legend: {
          display: true,
          position: "bottom"
        },
        cutoutPercentage: 80
      };

      var chart1 = new Chart(ctx1, {
        type: "doughnut",
        data: data1,
        options: options
      });
    },
    error: function(data) {
      console.log(data);
      console.clear();
    }
  });
});
