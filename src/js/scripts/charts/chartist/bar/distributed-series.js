/*=========================================================================================
    File Name: distributed-series.js
    Description: Chartist distributed series chart
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/

// Distributed series chart
// ------------------------------
$(window).on("load", function(){

    new Chartist.Bar('#distributed-series', {
        labels: ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'],
        series: [20, 60, 120, 200, 180, 20, 10]
    }, {
        distributeSeries: true
    });
});