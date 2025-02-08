/*=========================================================================================
    File Name: pie.js
    Description: Chartist simple pie chart
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

// Pie chart
// ------------------------------
$(window).on("load", function(){

    var data = {
        series: [5, 3, 4]
    };

    var sum = function(a, b) {
        return a + b;
    };

    new Chartist.Pie('#pie-chart', data, {
        labelInterpolationFnc: function(value) {
            return Math.round(value / data.series.reduce(sum) * 100) + '%';
        }
    });
});