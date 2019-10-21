$(document).ready(function () {
    $.ajax({
        url: "http://localhost/edostate/api/bar-data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var sum = [];
            var lga = [];

            for (var i in data) {
                lga.push(data[i].lga);
                sum.push(data[i].sum);
            }

            var chartdata = {
                labels: lga,
                datasets: [
                    {
                        label: 'Transactions',
                        backgroundColor: 'rgba(50, 150, 150, 0.2)',
                        borderColor: 'rgba(50, 150, 150, 1)',
                        hoverBackgroundColor: 'rgba(50, 150, 150, 0.7)',
                        hoverBorderColor: 'rgba(50, 150, 150, 1)',
                        borderWidth: 2,
                        data: sum
                    }
                ]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
});