//functions
function drawStatistic(name, values) {
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Work',     11],
            ['Eat',      2],
            ['Commute',  2],
            ['Watch TV', 2],
            ['Sleep',    7]
        ]);

        var options = {
            title: name,
            pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart-device'));
        chart.draw(data, options);
    }
}

$(document).ready(function(){

    $.ajax({
        type: "GET",
        url: "/master/devices-statistics/values",
        success: function (response) {
            if (response[0].length > 0) {
                console.log(response[0]);
            }
            if (response[1].length > 0) {
                console.log(response[1]);
            }
        }
    });

    drawStatistic('Devices statistics');

});

$(window).on('load', function(){


});