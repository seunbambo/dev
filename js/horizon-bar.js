$(document).ready(function () {
    $.ajax({
        url: "http://localhost/edostate/api/horizontal-bar-data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var count = [];
            var category = [];

            for (var i in data) {
                category.push(data[i].category);
                count.push(data[i].count);
            }

            var chartdata = {
                labels: category,
                datasets: [
                    {
                        label: 'Transactions',
                        backgroundColor: 'rgba(50, 150, 150, 0.2)',
                        borderColor: 'rgba(50, 150, 150, 1)',
                        hoverBackgroundColor: 'rgba(50, 150, 150, 0.7)',
                        hoverBorderColor: 'rgba(50, 150, 150, 1)',
                        borderWidth: 2,
                        data: count
                    }
                ]
            };

            var ctx = $("#horizonBar");

            var barGraph = new Chart(ctx, {
                type: 'horizontalBar',
                data: chartdata
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
});