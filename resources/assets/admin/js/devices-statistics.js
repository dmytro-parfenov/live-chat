//functions
function drawStatistic(name, values, idElement) {
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(values);

        var options = {
            title: name,
            pieHole: 0.4
        };

        var chart = new google.visualization.PieChart(document.getElementById(idElement));
        chart.draw(data, options);
    }
}

$(document).ready(function(){

    $.ajax({
        type: "GET",
        url: "/master/devices-statistics/values",
        success: function (response) {
            if (response[0].length > 0) {
                var devicesType = [['Name', 'Value']];
                for (i = 0; i < response[0].length; i++){
                    devicesType.push([response[0][i].device_type, parseInt(response[0][i].count)]);
                }
                drawStatistic('Devices type statistics', devicesType, 'donutchart-device');
            }
            if (response[1].length > 0) {
                var devicesOs = [['Name', 'Value']];
                for (i = 0; i < response[1].length; i++){
                    devicesOs.push([response[1][i].device_os, parseInt(response[1][i].count)]);
                }
                drawStatistic('Devices OS statistics', devicesOs, 'donutchart-os');
            }
        }
    });


});

$(window).on('load', function(){


});