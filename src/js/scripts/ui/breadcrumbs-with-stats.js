/*=========================================================================================
    File Name: breadcrumbs-with-stats.js
    Description: Breadcrumbs with statastics
    ----------------------------------------------------------------------------------------
    Item Name: Ai2Gi Admin - Clean Bootstrap 4 Dashboard HTML Template
    Author: Ai2Gi
    Author URL: http://www.themeforest.net/user/Ai2Gi
==========================================================================================*/
(function(window, document, $) {
	'use strict';
    $("#sp-bar-total-sales").sparkline([5,6,7,8,9,10,12,13,15,14,13,12,10,9,8,10,12,14,15,16,17,14,12,11,10,8], {
        type: 'bar',
        width: '100%',
        height: '30px',
        barWidth: 2,
        barSpacing: 4,
        barColor: '#00BCD4'
    });
})(window, document, jQuery);