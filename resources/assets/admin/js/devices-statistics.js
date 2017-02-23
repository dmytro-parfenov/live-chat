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

    //get data of devices an OS values
    $.ajax({
        type: "GET",
        url: "/master/devices-statistics/values",
        success: function (response) {
            if (response[0].length > 0) {
                var devicesType = [['Name', 'Value']];
                for (i = 0; i < response[0].length; i++){
                    devicesType.push([response[0][i].device_type, parseInt(response[0][i].count)]);
                }
                $('#donutchart-device').fadeIn(500);
                drawStatistic('Devices type statistics', devicesType, 'donutchart-device');
            } else {
                $('#donutchart-device-none').text('No devices types');
            }
            if (response[1].length > 0) {
                var devicesOs = [['Name', 'Value']];
                for (i = 0; i < response[1].length; i++){
                    devicesOs.push([response[1][i].device_os, parseInt(response[1][i].count)]);
                }
                $('#donutchart-os').fadeIn(500);
                drawStatistic('Devices OS statistics', devicesOs, 'donutchart-os');
            } else {
                $('#donutchart-os-none').text('No devices OS');
            }
        }
    });


});

$(window).on('load', function(){


});